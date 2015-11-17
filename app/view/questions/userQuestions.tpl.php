<h4>Frågor av <?=$author?></h4>
<?php if(is_array($questions) && !empty($questions)) : ?>
    <table class="userQuestionTable">
    <?php foreach ($questions AS $question) : ?>
        <!-- Count the nr of answers the question has -->
        <?php $count = 0;
        foreach ($answers AS $answer) {
            if ($answer->userId == $question->userId) {
                $count++;
            }
        }?>
        <tr>

            <?php $time = strtotime($question->timestamp); ?>
            <td class="userQuestionScore"><span class="nr"><?=is_null($question->qScore) ? 0 : $question->qScore?></span> <br>röster</td>
            <td class="userQuestionAnswers"><span class="nr"><?=$count?></span><br>svar</td>
            <td class="userQuestionTitle"><a href="<?=$this->url->create('question/view/' . $question->id)?>"><?=$question->title?></a><br>

                <!-- Get the related tags -->
                <?php $tagname = explode(",", $question->tag);
                    $tagid = explode(",", $question->tagId); ?>
                <?php foreach ($tagname AS $key => $val) :?>
                    <a class="questionTags" href="<?=$this->url->create('tags/view/' . $tagid[$key])?>" title="Se alla frågor i kategorin"><?=$val?></a>
                <?php endforeach; ?>
            </td>
            <td><?=strftime("%d %b '%y %H:%M", $time)?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php elseif (empty($questions)) : ?>
    <p>Inga frågor ännu</p>
<?php endif; ?>
