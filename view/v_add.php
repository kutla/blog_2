<!doctype html>
<html>
<head>
	<title>Добавление новостей.</title>

</head>
<body>
	<form method="post">
		Название файла<br>
		<input type="text" name="title" value=<?=$title?>><br>
		Содержимое файла<br>
		<textarea name="content" ><?=$content?></textarea><br>
		<input type="submit" value="Сохранить"><br>
	</form>
	<?foreach($msg as $error):?><br>
		<p><?=$error?></p>
	<?endforeach;?>
	<a href="index.php">К списку новостей</a>
	<a href="login.php">Выйти</a>
</body>
</html>