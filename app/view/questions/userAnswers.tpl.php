<hr>

<h2>Frågor</h2>

<?php if (is_array($questions) && !empty($questions)) : ?>
<div class='questions'>
    <?php foreach ($questions as $id => $question) : ?>

        <h4 class="questionTitle"><a href="<?=$this->url->create('question/view/' . $question->id . '#'  . $answerId[$id] )?>" title="Se hela frågan och svaret"><?=$question->title?></a></h4>
        <img src="<?=$question->gravatar?>">
        <?php $tagname = explode(",", $question->tag);
            $tagid = explode(",", $question->tagId); ?>
        <?php foreach ($tagname AS $key => $val) :?>
            <a href="<?=$this->url->create('tags/view/' . $tagid[$key])?>"><?=$val?></a>
        <?php endforeach; ?>

    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php if(!is_array($questions)) : ?>
<p><?=$questions?></p>
<?php endif; ?>
