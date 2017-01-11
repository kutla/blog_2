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
			'/' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'indexAction',
			],
			'/article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'oneAction',
			],
			'/add_article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'addAction',
			],
			'/edit_article' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'editAction',
			],
			'/login' => [
				'controller' => 'Controller\ArticleController',
				'action' => 'loginAction',
			],
			'/delete_article' => [
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