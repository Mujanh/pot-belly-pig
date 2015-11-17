<h2>Lämna en kommentar</h2>
<div class="commentThis">
    <h4><?=$answerToTitle?></h4>
    <?=$answerToQuestion?>
    <?php if (!empty($answerToAnswer)) : ?>
        <hr>
    <em><i class="fa fa-reply"></i> <?=$this->textFilter->doFilter($answerToAnswer->content, "markdown")?></em>

<?php endif ?>
</div>
    <p><?=$content?></p>
