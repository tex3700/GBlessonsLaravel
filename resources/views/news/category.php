<?php include_once 'menu.php'; ?>
<p>
<?php foreach ($category as $item): ?>

    <a href="<?=route('news.single', $item['id'])?>" ><?=$item['title']?></a><br>

<?php endforeach; ?>
</p>
