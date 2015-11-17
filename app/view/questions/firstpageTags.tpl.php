<div class="frontpage-tags">
    <h4><?=$title?></h4>
    <?php if (is_array($tags) && !empty($tags)) : ?>

        <div>
        <?php foreach ($tags as $tag) : ?>

            <div class="frontpage-tag">
                <a href="<?=$this->url->create('tags/view/' . $tag->id)?>" title="Se alla frågor i kategorin"><?=$tag->tag?></a>
                <span> &times; <?=$tag->nrQuestions?></span>
            </div>

        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if(!is_array($tags)) : ?>
    <p><?=$tags?></p>
    <?php endif; ?>

</div>
