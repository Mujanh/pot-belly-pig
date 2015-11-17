<?php $class = isset($className) ? $className : ""; ?>
<ul class="<?=$class?>">
<?php foreach ($links as $link) : ?>
    <li><a href="<?=$link['href']?>"><?=$link['text']?></a></li>
<?php endforeach; ?>
</ul>
