<div class="<?=isset($class) ? $class : ''?>">
    <?php if(isset($title)) :?>
        <h1><?=$title?></h1>
    <?php endif; ?>

    <?=$content?>

    <?php if (isset($links)) : ?>
    <ul class="linksList">
        <?php foreach ($links as $link) : ?>
            <li><a href="<?=$link['href']?>" title="<?=isset($link['title']) ? $link['title'] : ''?>"><?=$link['text']?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
