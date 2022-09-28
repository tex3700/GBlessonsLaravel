<?php include_once 'menu.php'; ?>


        <?php if(!is_null($category)):?>

   <p>
    <?php foreach ($category as $item): ?>

        <a href="<?=route('news.single', $item['id'])?>" ><?=$item['title']?></a><br>

    <?php endforeach; ?>
   </p>

        <?php else:?>
            <p>Нет категории новостей с таким id</p>
        <?php endif;?>

