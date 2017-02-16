<!doctype html>
<html>
<head>
	<title>Список новостей</title>
</head>
<body>
	<?foreach ($news as $one): ?>
		<a href="/article?id=<?=$one['id_news']?>"><?=$one['title']?></a><hr>
	<?endforeach;?>
</body>
</html>