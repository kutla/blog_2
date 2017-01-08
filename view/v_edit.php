<!doctype html>
<html>
<head>
	<title>Новость</title>
</head>
<body>	 
	<form method="post">
		Название файла<br>
		<input type="text" name="title" value=<?=$title?>><br>
		Содержимое файла<br>
		<textarea name="content" ><?=$content?></textarea><br>
		<input type="submit" value="Сохранить"><br>
	</form>
	<?if ($errors != ''):?>
		<?foreach ($errors as $error): ?>
			<?=$error?><br>
		<?endforeach;?>
	<?endif;?>
	<a href="/blog_2/">Назад</a>	
</body>
</html>