
<div class='answers'>

<?php if (is_array($answers) && !empty($answers)) : ?>

    <!-- div with options to sort answers to question -->
    <div class="answersSorting">
        <strong><?=count($answers)?> svar</strong>
        <div class="answerTabs">
            <a class="<?=$selected == 'latest' ? 'selected' : ''?>" href="<?=$this->url->create('question/view/' . $questionId . '/latest')?>">Senaste</a>
            <a class="<?=$selected == 'oldest' ? 'selected' : ''?>" href="<?=$this->url->create('question/view/' . $questionId . '/oldest')?>">Äldsta</a>
            <a class="<?=$selected == 'rank' ? 'selected' : ''?>" href="<?=$this->url->create('question/view/' . $questionId . '/rank')?>">Rank</a>
        </div>
    </div>

    <!-- Iterate over answers -->
    <?php foreach ($answers as $id => $answer) : ?>

        <div class='answer' id="<?=$answer->id?>">
            <div class="answerBox">

                <!-- div with answer score and voting options -->
                <div class="answerScore">

                    <!-- Check if the user has already voted for the same answer before -->
                    <?php $voted = '';
                    if($usersVotes != "") {
                        foreach ($usersVotes AS $vote) {
                            if($vote->idAnswer == $answer->id) {
                                $voted = 'voted';
                            }
                        }
                    } ?>

                    <a class="vote<?=$answer->author == $loggedInUser ? '-owner' : ''?> <?=$voted?>" href="<?=$this->url->create('question/upvote/' . $answer->questionId . '/' . $answer->id)?>" title="Rösta upp"><i class="fa fa-chevron-up fa-2x"></i></a>
                    <p class="nr"><?=!is_null($answer->score) ? $answer->score : 0?></p>
                    <a class="vote<?=$answer->author == $loggedInUser ? '-owner' : ''?> <?=$voted?>" href="<?=$this->url->create('question/downvote/' . $answer->questionId . '/' . $answer->id)?>" title="Rösta ner"><i class="fa fa-chevron-down fa-2x"></i></a>

                    <!-- Check if the answer is marked as accepted -->
                    <?php if(isset($answer->accepted)): ?>
                        <span class="accepted"><i class="fa fa-check fa-2x"></i></span>
                    <?php endif; ?>

                    <!-- If user is authorised, let it mark answer as accepted if not already marked -->
                    <?php if($canAccept && !$answer->accepted): ?>
                        <a class="notaccepted<?=$answer->author == $loggedInUser ? '-owner' : ''?>" href="<?=$this->url->create('question/accept/' . $answer->questionId . '/' . $answer->id)?>" title="Markera som accepterat"><i class="fa fa-check fa-2x"></i></a>
                    <?php endif; ?>

                </div>

                <!-- The content of the answer, with markdown -->
                <div class="answerContent">
                    <?=$this->textFilter->doFilter($answer->content, "markdown")?>
                </div>

                <!-- Information about the user who wrote the answer -->
                <div class='answerAuthor'>

                    <!-- Calculate time since answer was posted -->
                    <?php date_default_timezone_set('Europe/Berlin');
                    $datetime1 = strtotime($answer->timestamp);
                    $datetime2 = strtotime(date('Y-m-d H:i:s'));
                    $difference = abs($datetime2 - $datetime1);
                    $res = round($difference / 60 / 60 / 24);

                    if ($res > 15) {
                        $timeAgo = $answer->timestamp;
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

                    <em class="answerTime">svarade <?=$timeAgo?></em><br>
                    <a href="<?=$this->url->create('users/view/' . $answer->userId)?>" title="Se användarprofil"><?=$answer->author?></a>
                    <img src="<?=$answer->gravatar?>" alt="Gravatar">
                </div>

                <!-- Show comments to the answer -->
                <div class="comments">

                    <!-- Check if answer has any comments -->
                    <?php foreach ($comments as $comId => $comment) :
                        if ($comment->answerId == $answer->id) : ?>
                        <div class="commentLine">

                            <!-- Display score of comment -->
                            <div class="commentScore">
                                <span class="nr"><?=!is_null($comment->score) ? $comment->score : 0?></span>
                            </div>

                            <!-- Show comment and details about the user who wrote it -->
                            <div class="commentContent">

                                <!-- Calculate time since the comment was made -->
                                <?php date_default_timezone_set('Europe/Berlin');
                                $datetime1 = strtotime($comment->timestamp);
                                $datetime2 = strtotime(date('Y-m-d H:i:s'));
                                $difference = abs($datetime2 - $datetime1);
                                $res = round($difference / 60 / 60 / 24);

                                if ($res > 15) {
                                    $timeAgoComment = $comment->timestamp;
                                } elseif ($res < 1) {
                                    $hours = round($difference / 60 / 60);
                                    $minutes = round($difference / 60) . " minuter sedan";
                                    if ($hours > 0) {
                                        $textHours = $hours == 1 ? " timme" : " timmar";
                                        $timeAgoComment = $hours . $textHours . " sedan";
                                    } else {
                                        $timeAgoComment = $minutes;
                                    }
                                } else {
                                    $days = $res == 1 ? "dag" : "dagar";
                                    $timeAgoComment = $res . " " . $days . " sedan";
                                }?>

                                <?=$this->textFilter->doFilter($comment->content, "markdown")?>

                                <!-- Has the user already voted for the same comment before? -->
                                <?php $commentvoted = '';
                                if($usersVotes != "") {
                                    foreach ($usersVotes AS $vote) {
                                        if($vote->idComment == $comment->id) {
                                            $commentvoted = 'voted';
                                        }
                                    }
                                } ?>

                                <a class="vote<?=$comment->author == $loggedInUser ? '-owner' : ''?> <?=$commentvoted?>" href="<?=$this->url->create('question/upvote/' . $answer->questionId . '/' . $answer->id . '/' . $comment->id)?>" title="Rösta upp"><i class="fa fa-thumbs-o-up"></i></a>
                                <a class="vote<?=$comment->author == $loggedInUser ? '-owner' : ''?> <?=$commentvoted?>" href="<?=$this->url->create('question/downvote/' . $answer->questionId . '/' . $answer->id . '/' . $comment->id)?>" title="Rösta ner"><i class="fa fa-thumbs-o-down"></i></a>
                                <span class="commentName"> &ndash; <a href="<?=$this->url->create('users/view/' . $comment->userId)?>" title="Se användarprofil"><?=$comment->author?></a></span>
                                <span class="commentTime"><?=$timeAgoComment?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <a class="questionComment" href="<?=$this->url->create('question/comment/' . $answer->questionId .'/' . $answer->id)?>" title="Kommentera svaret">kommentera</a>

                </div>
            </div>

        </div>
        <?php endforeach; ?>

    <?php endif; ?>

    <?php if(!is_array($answers) && !empty($answers)) : ?>
        <p><?=$answers?></p>
    <?php endif; ?>

    <?php if(empty($answers)) : ?>
        <p>Inga svar har skrivits än.</p>
    <?php endif; ?>
    
</div>
