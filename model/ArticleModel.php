<?php

namespace model;


class ArticleModel extends BaseModel
{	
	public static $instance;

	public static function Instance()
	{
		if (self::$instance == null) {
			self::$instance = new ArticleModel();
		}
		return self::$instance;
	}

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'news';
		$this->pkey = 'id_news';
	}

	public function messages_validate($title, $content) {
		$msg = [];

		if ($title == '') {
			$msg[] = 'Название не может быть пустым';
		}
		elseif (mb_strlen($title) < 5) {
			$msg[] = 'Название не короче пяти букв';
		}
		if ($content == '') {
			$msg[] = 'Текст не может быть пустым';
		}
		elseif (mb_strlen($content) < 50) {
			$msg[] = 'Текст не короче 50 символов';
		}
		return $msg;
	}
}
?>