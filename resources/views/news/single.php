<?php include_once 'menu.php'; ?>

<?php if(!is_null($news)):?>

<h2><?=$news['title']?></h2>
<p><?=$news['text']?></p>

<?php else:?>
<p>Нет новости с таким id</p>
<?php endif;?>

