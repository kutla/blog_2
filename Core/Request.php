<?php

namespace Core;

class Request
{
	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';

	private $get;
	private $post;
	private $server;
	public $rout;

	public function __construct(array $get, array $post, array $server)
	{
		$this->post = $post;
		$this->server = $server;
		$this->makeParams();
	}

	public function getGet()
	{
		return $this->get;
	}

	public function getPost()
	{
		return $this->post;
	}

	public function getServer()
	{
		return $this->server;
	}
	public function isGet()
	{
		return $this->server['REQUEST_METHOD'] == self::METHOD_GET;
	}

	public function isPost()
	{
		return $this->server['REQUEST_METHOD'] == self::METHOD_POST;
	}

	public function getMethod()
	{
		return $this->server['REQUEST_METHOD'];
	}

	private function makeParams()
	{	
		$get = [];
		$buffer = explode ('?', $this->server['REQUEST_URI']);
		$this->rout = $buffer[0];

		if (isset($buffer[1])) {
			$pairs = explode ('&', $buffer[1]);

			foreach ($pairs as $pair) {
				$buffer = explode ('=', $pair);
				$get[$buffer[0]] = $buffer[1];
			}

		}
		$this->get = $get;
	}
}