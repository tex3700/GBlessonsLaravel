<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
</head>
<header>
    <?php include_once "menu.php"; ?>
</header>
<body>
<h1>Hовости</h1>

<?php foreach ($news as $item): ?>

    <a href="<?=route('news.single', $item['id'])?>" ><?=$item['title']?></a><br>

<?php endforeach; ?>

</body>
</html>

