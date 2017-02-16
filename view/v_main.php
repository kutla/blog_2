<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="banner">
    <h1><?=$title?></h1>
  </div>
  <div class="clear">&nbsp;</div>
  <div id="sidebar">
    <div class="menu">
      <ul>
        <li><a href="/">На главную</a></li>
        
        <?if($auth):?>
         <li><a href="/add_article">Добавить новость</a></li>
        <?endif?>
        
        <li><a href="/login"><?=($auth ? 'Выйти':'Войти')?></a></li>
      </ul>
    </div>
  </div>
  <div id="content"><?=$content?></div>
  <div id="credits"> <a href="#">Homepage</a> | <a href="#">contact</a> | <a href="http://validator.w3.org/check?uri=referer">html</a> | <a href="http://jigsaw.w3.org/css-validator">css</a> | &copy; 2016 | Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a> | This work is licensed under a <a rel="license" target="_blank" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 License</a> </div>
  <div id="footer"> </div>
</div>
</body>
</html>
