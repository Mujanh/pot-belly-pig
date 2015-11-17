<h4>Svar av <?=$author?></h4>
<?php if(is_array($answers) && !empty($answers)) : ?>
    <table class="userAnswerTable">
    <?php foreach ($answers AS $answer) : ?>
        <?php $title = null;
        //Find the title for the question the answer belongs to
        foreach ($questions AS $question) {
            if($question->id == $answer->questionId) {
                $title = $question->title;
            }
        } ?>
        <tr>
            <?php $time = strtotime($answer->timestamp); ?>
            <td class="userAnswerScore"><span class="nr"><?=$answer->score?></span><br>röster</td>
            <td class="userAnswerTitle"><a href="<?=$this->url->create('question/view/' . $answer->questionId . '#' . $answer->id)?>" title="Se hela frågan och svaret"><?=$title?></a></td>
            <td class="userAnswerTime"><?=strftime("%d %b '%y %H:%M", $time)?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php elseif (empty($questions)) : ?>
    <p>Inga svar ännu</p>
<?php endif; ?>
