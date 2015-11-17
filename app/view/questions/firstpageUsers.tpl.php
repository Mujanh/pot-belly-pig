<div class="frontpage-users">
    <h4>Topp 5 aktiva användare</h4>
    <?php if (is_array($users) && !empty($users)) : ?>

        <?php foreach ($users as $user) : ?>
            <?php $score = $user->activityScore + $user->questionScore + $user->answerScore + $user->commentScore;?>

                <div class="frontpage-user">
                    <a href="<?=$this->url->create('users/view/' . $user->id)?>" title="Se användarprofil"><?=$user->acronym?></a>
                    <span> <i class="fa fa-star-o"> <?=$score?></i></span>
                </div>
                
        <?php endforeach; ?>

    <?php endif; ?>

    <?php if(!is_array($users)) : ?>
    <p><?=$users?></p>
    <?php endif; ?>

</div>
