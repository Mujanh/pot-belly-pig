<div class="loginInfo">
<?php if(isset($title)) :?>
    <h4><?=$title?></h4>
<?php endif; ?>

<?=$content?>

<?php if (isset($links)) : ?>
<ul class="linksList">
<?php foreach ($links as $link) : ?>
<li><a href="<?=$link['href']?>"><?=$link['text']?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>
