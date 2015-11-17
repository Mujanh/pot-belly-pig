<?php if (is_array($tags) && !empty($tags)) : ?>
<div class='tags'>
    <?php foreach ($tags as $id => $tag) : ?>

        <h4 class="tagName"><a href="<?=$this->url->create('question/view/' . $tag->id)?>"><?=$tag->title?></a></h4>

    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if(!is_array($tags) && !empty($tags)) : ?>
    <p><?=$tags?></p>
<?php endif; ?>

<?php if(empty($tags)) : ?>
    <p>There are no tags yet</p>
<?php endif; ?>

<a href="<?=$this->url->create('tags')?>">Tillbaka</a>
