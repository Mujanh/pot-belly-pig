<h3><?=isset($title) ? $title : "Senaste frågorna"?></h3>

<?php if (is_array($questions) && !empty($questions)) : ?>
    <div class='firstpage-questions'>

        <?php foreach ($questions as $id => $question) : ?>

            <!-- Count the nr of answers to question -->
            <?php $count = 0; ?>
            <?php foreach ($answers AS $answer) {
                if($answer->questionId == $question->id) {
                    $count++;
                }
            }?>


            <div class="firstpage-question">

                <!-- Show the score and votes for the question -->
                <div class="firstpage-questionScore">

                    <div class="firstpage-votes">
                        <span class="nr"><?=!is_null($question->qScore) ? $question->qScore : 0?></span><br>
                        <span>röster</span>
                    </div>

                    <div class="firstpage-answers">
                        <span class="nr"><?=$count?></span><br>
                        <span>svar</span>
                    </div>

                </div>

                <!-- Show the question title and related tags -->
                <div class="firstpage-questionContent">

                    <h4 class="questionTitle"><a href="<?=$this->url->create('question/view/' . $question->id )?>" title="Se hela frågan"><?=$question->title?></a></h4>

                    <div class="firstpage-questionTagArea">

                        <?php $tagname = explode(",", $question->tag);
                            $tagid = explode(",", $question->tagId); ?>

                        <?php foreach ($tagname AS $key => $val) :?>
                            <a class="questionTags" href="<?=$this->url->create('tags/view/' . $tagid[$key])?>" title="Se alla frågor i kategorin"><?=$val?></a>
                        <?php endforeach; ?>

                    </div>

                    <!-- Show information about the user who wrote the question -->
                    <div class="questionAuthor">

                        <!-- Calculate time since created -->
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
