
<h3><?=$title?></h3>
<hr>
<div class="readQuestion">

    <!-- Div with question score and voting options -->
    <div class="questionScore read">

        <!-- Check if the user has voted on the same question before -->
        <?php $voted = '';
        if(is_array($votes)) {
            foreach ($votes AS $vote) {
                if($vote->idQuestion == $id) {
                    $voted = 'voted';
                }
            }
        } ?>

        <a class="vote<?=$author == $loggedInUser ? '-owner' : ''?> <?=$voted?>" href="<?=$this->url->create('question/upvote/' . $id)?>" title="Rösta upp"><i class="fa fa-chevron-up fa-2x"></i></a>
        <p class="nr"><?=!is_null($score) ? $score : 0?></p>
        <a class="vote<?=$author == $loggedInUser ? '-owner' : ''?> <?=$voted?>" href="<?=$this->url->create('question/downvote/' . $id)?>" title="Rösta ner"><i class="fa fa-chevron-down fa-2x"></i></a>
    </div>

    <!-- Content of question -->
    <div class="questionContent">
        <?=$content?>

        <!-- Show related tags -->
        <?php if (!is_null($tags)) :?>
            <?php foreach ($tags AS $key => $val): ?>
                <a class="questionTags" href="<?=$this->url->create('tags/view/' . $val->id)?>" title="Se alla frågor i kategorin"><?=$val->tag?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Show info about the user who wrote the question -->
    <div class="questionAuthor">

        <!-- Calculate time since question was created -->
        <?php date_default_timezone_set('Europe/Berlin');
        $datetime1 = strtotime($timestamp);
        $datetime2 = strtotime(date('Y-m-d H:i:s'));
        $difference = abs($datetime2 - $datetime1);
        $res = round($difference / 60 / 60 / 24);

        if ($res > 15) {
            $timeAgo = $timestamp;
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
            $days = $res == 1 ? "dag" : "dagar";
            $timeAgo = $res . " " . $days . " sedan";
        }?>

        <em class="questionTime">frågade <?=$timeAgo?></em><br>
        <a href="<?=$this->url->create('users/view/' . $userid)?>" title="Se användarprofil"><?=$author?></a>
        <img class="questionGravatar" src="<?=$gravatar?>" alt="Gravatar">
    </div>
</div>

    <!-- Comments related to the question -->
    <div class='comments'>
        <?php if (is_array($comments) && !empty($comments)) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="commentLine">

                <!-- The score of comment -->
                <div class="commentScore">
                    <span class="nr"><?=!is_null($comment->score) ? $comment->score : 0?></span>
                </div>

                <div class='commentContent'>

                    <!-- Calculate time since comment was created -->
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

                    <!-- Check if user has voted on the same comment before -->
                    <?php $commentVoted = '';
                    if($votes != "") {
                        foreach ($votes AS $vote) {
                            if($vote->idComment == $comment->id) {
                                $commentVoted = 'voted';
                            }
                        }
                    } ?>

                    <a class="vote<?=$comment->author == $loggedInUser ? '-owner' : ''?> <?=$commentVoted?>" href="<?=$this->url->create('question/upvote/' . $id . '/null/' . $comment->id)?>" title="Rösta upp"><i class="fa fa-thumbs-o-up"></i></a>
                    <a class="vote<?=$comment->author == $loggedInUser ? '-owner' : ''?> <?=$commentVoted?>" href="<?=$this->url->create('question/downvote/' . $id . '/null/' . $comment->id)?>" title="Rösta ner"><i class="fa fa-thumbs-o-down"></i></a>
                    <span class="commentName"> &ndash; <a href="<?=$this->url->create('users/view/' . $comment->userId)?>" title="Se användarprofil"><?=$comment->author?></a></span>
                    <span class="commentTime"><?=$timeAgoComment?></span>
                </div>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>
    <?php if(!is_array($comments)) : ?>
    <div class="comment"><p><?=$comments?></p></div>
    <?php endif; ?>
    <a class="questionComment" href="<?=$this->url->create('question/comment/' . $id)?>" title="Kommentera frågan">kommentera</a>
    </div>
