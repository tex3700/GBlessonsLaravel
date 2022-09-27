<?php include_once 'menu.php'; ?>
<p>
<?php foreach ($categories as $item): ?>

    <a href="<?=route('news.category.show', $item['id'])?>"><?=$item['title']?></a><br>

<?php endforeach; ?>
</p>
