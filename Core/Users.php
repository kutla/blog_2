<?php
namespace Core;

class Users
{

	public static function isAuth()
	{
		if(!isset($_SESSION['auth'])) {
			if($_COOKIE['login'] == 'admin' and $_COOKIE['password'] == md5('1234')) {
				$_SESSION['auth'] = true;
			}
			else {
				return false;
			}
		}
		return true;		
	}

	public function login($login, $password, $remember)
	{
		if($login == 'admin' and $password == '1234') {
			$_SESSION['auth'] = true;
			
			if($remember) {
				setcookie('login', 'admin', time()+3600);
				setcookie('password', md5('1234'), time()+3600);
			}
		}
		return true;
	}
}
