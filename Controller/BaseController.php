<?php

namespace Controller;

use Core\Users;
use Core\Tmp;
use Core\Request;

class BaseController
{
	protected $title;
	protected $content;
	protected $auth;
	protected $request;

	public function __construct(Request $request)
	{
		$this->title = 'THE BLOG IS MINE';
		$this->auth = Users::isAuth();
		$this->request = $request;
	}
	
	public function get404()
	{
		$this->title = "{$this->title}::404 error";
		$this->content = '<h3>Page Not Found</h3>';
		$this->render();
		die;
	}	
	

	public function render()
	{
		echo $this->tmpGenerate('view/v_main.php', [
			'title' => $this->title, 
			'content' => $this->content, 
			'auth' => $this->auth
			]);
	}

	protected function tmpGenerate($path, $vars = []) {
		ob_start();
		extract($vars);
		include($path);
		$res = ob_get_clean();
		return $res;
	}

	protected function getRedirect($url){
		header("Location: $url");
		die();
	}
}