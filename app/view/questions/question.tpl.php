<?php if(isset($back)) : ?>
    <a class="back-to-tags" href="<?=$this->url->create('tags')?>">Alla taggar</a>
<?php else : ?>
    <div class="addQuestion">
        <a href="<?=$this->url->create('question/add')?>" title="Skapa en ny fråga"><i class="fa fa-pencil"> Ny fråga</i></a>
    </div>
<?php endif; ?>


<?php if (is_array($questions) && !empty($questions)) : ?>
<div class='questions'>

    <?php foreach ($questions as $id => $question) : ?>

        <!-- Count the nr of answers to question -->
        <?php $count = 0; ?>
        <?php foreach ($answers AS $answer) {
            if($answer->questionId == $question->id) {
                $count++;
            }
        }?>

        <div class="question">

            <!-- Div with question score and votings-->
            <div class="questionScore">
                <p class="nr"><?=!is_null($question->qScore) ? $question->qScore : 0?></p>
                <span>röster</span><br>
                <p class="nr"><?=$count?></p>
                <span>svar</span><br>
            </div>

            <!-- Div with preview of content of question -->
            <div class="questionContent">
                <h4 class="questionTitle"><a href="<?=$this->url->create('question/view/' . $question->id )?>" title="Se hela frågan"><?=$question->title?></a></h4>

                <!-- Filter markdown and strip html tags from question content (to prevent weird output in overview) -->
                <?php
                $filteredContent = $this->textFilter->doFilter($question->content, 'markdown');
                $strippedC = strip_tags($filteredContent);

                //Cut the string if longer than 150 chars, try to preserve whole words if possible.
                if (strlen($strippedC) > 150) {

                    $pos = strpos($strippedC, ' ', 140);

                    if($pos !== false) {
                        $content = substr($strippedC,0,$pos ) . "...";
                    }
                    else {
                        $content = substr($strippedC,0,140 ) . "...";
                    }
                } else {
                    $content = $strippedC;
                }?>

                <p><?=$content?></p>

                <!-- Tags related to question -->
                <div class="questionTagArea">
                    <?php $tagname = explode(",", $question->tag);
                        $tagid = explode(",", $question->tagId); ?>
                    <?php foreach ($tagname AS $key => $val) :?>
                        <a class="questionTags" href="<?=$this->url->create('tags/view/' . $tagid[$key])?>" title="Se alla frågor i kategorin"><?=$val?></a>
                    <?php endforeach; ?>
                </div>

                <!-- Info about the user that wrote the question -->
                <div class="questionAuthor">

                    <!-- Calculate the time since the question was written -->
                    <?php date_default_timezone_set('Europe/Berlin');
                    $datetime1 = strtotime($question->timestamp);
                    $datetime2 = strtotime(date('Y-m-d H:i:s'));
                    $difference = abs($datetime2 - $datetime1);
                    $res = round($difference / 60 / 60 / 24);

                    if ($res > 15) {
                        $timeAgo = $question->timestamp;
                    } elseif ($res < 1) {
                        $hours = round($difference / 60 / 60);
                        $minutes = round($difference / 60) . " minuter sedan";
                        if ($hours > 0) {
                            $textHours = $hours == 1 ? " timme" : " timmar";
                            $timeAgo = $hours . $textHours . " sedan";
                        } else {
                            $timeAgo = $minutes;
                        }
                    } else {
                        $timeAgo = $res . " dagar sedan";
                    }?>
                    <em class="questionTime"><?=$timeAgo?></em><br>
                    <img class="questionGravatar" src="<?=$question->gravatar?>" alt="Gravatar">
                    <a href="<?=$this->url->create('users/view/' . $question->userId)?>" title="Se användarprofil"><?=$question->author?></a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if(!is_array($questions)) : ?>
<p><?=$questions?></p>
<?php endif; ?>
