<?php
namespace Controller;

use model\ArticleModel;
use Core\Users;

class ArticleController extends BaseController
{
	public function indexAction()
	{
		$mNews = ArticleModel::Instance();
		$news = $mNews->all();

		$this->content = $this->tmpGenerate('view/v_index.php', [
			'news' => $news
			]);
	}

	public function oneAction()
	{
		if (!isset($this->request->getGet()['id'])) {
			$this->get404();
		}

		$mNew = ArticleModel::Instance()->get($this->request->getGet()['id']);

		$this->content = $this->tmpGenerate('view/v_article.php', [
			'id_news' => $this->request->getGet()['id'],
			'title' => $mNew['title'],
			'content' => $mNew['content'],
			'dt_post' => $mNew['dt_post'],
			'auth' => $this->auth
		]);		
	}

	public function addAction()
	{
		$errors = [];
		$title = '';
		$content = '';

		if (count($this->request->getPost()) > 0) {
			$title = trim(htmlspecialchars($this->request->getPost()['title']));
			$content = trim(htmlspecialchars($this->request->getPost()['content']));
			$addNew = ArticleModel::Instance();
			$errors = $addNew->messages_validate($title, $content);
			
			if (empty($errors)) {
				$new = $addNew->add(['title' => "$title", 'content' => "$content"]);
				if ($new) {
					header("Location: /blog_2/article?id=$new");
					exit();
				}
			}
		}
			
		$this->content = $this->tmpGenerate('view/v_add.php', [
			'title' => $title,
			'content' => $content,
			'msg' => $errors,
			'auth' => $this->auth
			]);
	}
	public function editAction()
	{
		$editNew = 	ArticleModel::Instance();
		if (!$this->auth) {
			$this->getRedirect('/blog_2/');
		}
		
		if (count($this->request->getPost()) > 0) {
			$title = htmlspecialchars(trim($this->request->getPost()['title']));
			$content = htmlspecialchars(trim($this->request->getPost()['content']));
			$id_news = $this->request->getGet()['id'];
			$errors = $editNew->messages_validate($title, $content);
			
			if (empty($errors)){
				$editNew->edit(['title' => $title, 'content' => $content], $id_news);
				if ($editNew) {
					$this->getRedirect('/blog_2/article?id=$id_news');
				}
			}
		}
		else {
			$new = $editNew->get($this->request->getGet()['id']);
			$title = $new['title'];
			$content = $new['content'];
		}	
		$this->content = $this->tmpGenerate('view/v_edit.php', [
			'title' => $title,
			'content' => $content,
			'errors' => $errors,
			'auth' => $this->auth
			]);
	}

	public function  delAction()
	{	
		if (!$this->auth) {
			$this->getRedirect('/blog_2/');
		}
		$delNew = ArticleModel::Instance();
		$id_news = $this->request->getGet()['id'];
		$delNew->delete($id_news);
		$this->getRedirect('/blog_2/');
	}

	public function loginAction()
	{
		if(count($this->request->getPost()) > 0) {
			$login = ($this->request->getPost()['login']);
			$password = ($this->request->getPost()['password']);
			$remember = ($this->request->getPost()['remember']);
			$logIn = new Users();
			if($logIn->login($login, $password, $remember)) {
				$this->getRedirect('/blog_2/');
			}
		}
		else {
			unset($_SESSION['auth']);
			setcookie('login', 'admin', time()-1);
			setcookie('password', md5('1234'), time()-1);
		}
		$this->content = $this->tmpGenerate('view/v_login.php', [
			]);
	}
	
}