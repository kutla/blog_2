<h1><?=$title?></h1><hr>
<p> <?=$content?></p><hr>
<?if($auth):?>
	<a href = "edit_article?id=<?=$id_news?>">Редактировать</a>
	<a href = "delete_article?id=<?=$id_news?>">Удалить</a>
<?endif?>
