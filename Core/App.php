<?php

namespace Core;

class App
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function go()
	{
		$params = $this->getRoutByRequest();

		if (!$params) {
			$params = $this->getRoutByParams('default');
		}

		$ctrl = new $params['controller']($this->request);
		$action = $params['action'];

		$ctrl->$action();

		$ctrl->render();

	}

	private function getRoutByRequest()
	{
		return isset($this->routs()[$this->request->rout]) ? $this->routs()[$this->request->rout] : false;
	}

	private function getRoutByParams($rout)
	{
		return isset($this->routs()[$rout]) ? $this->routs()[$rout] : false;
	}

	private function routs()
	{
		return [
			'/blog_2/' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'indexAction',
			],
			'/blog_2/article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'oneAction',
			],
			'/blog_2/add_article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'addAction',
			],
			'/blog_2/edit_article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'editAction',
			],
			'/blog_2/login' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'loginAction',
			],
			'/blog_2/delete_article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'delAction',
			],
			'default' => [
				'controller' => 'Controller\BaseController',
				'action' => 'get404'
			]
		];
	}
}