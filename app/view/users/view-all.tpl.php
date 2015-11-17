<h2><?=$title?></h2>

<table class="usertable">
    <!-- Do this if there are more than 4 users in database -->
    <?php if(count($users) > 4) : ?>
        <?php foreach ($users as $nr => $user) : ?>
            <?php if ($nr === 0) :?>
                <tr>
            <?php endif; ?>

                <td class="gravatarCell"><img src="<?=$user->getProperties()['gravatar']?>" alt="Gravatar"></td>
                <td><a href="<?=$this->url->create('users/view/' . $user->id)?>" title="Se användarprofil"><?=$user->getProperties()['acronym']?></a><br>

                <!-- Calculate reputation for each user -->
                <?php $score = 0;
                foreach ($activities AS $activity) {
                    if ($activity->id == $user->id) {
                        $score = $activity->activityScore + $activity->questionScore + $activity->answerScore + $activity->commentScore;
                    }
                } ?>
                <i class="fa fa-star-o"> <?=$score?></i>
            </td>

            <!-- Create empty cells if less users than cells in table row -->
            <?php if(($nr + 1) == count($users) && count($users) % 4 !== 0) :?>
                <?php $leftOvers = count($users) % 4;
                if ($leftOvers > 0) : ?>
                    <?php for ($i = 0; $i < $leftOvers; $i++) : ?>
                        <td class="gravatarCell"></td>
                        <td></td>
                    <?php endfor; ?>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Add new table row after every fourth cell -->
            <?php if (($nr + 1) % 4 === 0) :?>
                </tr>
                <?php if (($nr + 1) != count($users)) :?>
                    <tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>

    <!-- Do this if less than four users in database -->
    <?php else : ?>
        <tr>
            <?php foreach($users AS $user) : ?>

                <td class="gravatarCell"><img src="<?=$user->getProperties()['gravatar']?>" alt="Gravatar"></td>
                <td><a href="<?=$this->url->create('users/view/' . $user->id)?>" title="Se användarprofil"><?=$user->getProperties()['acronym']?></a><br>

                <!-- Calculate user reputation -->
                <?php $score = 0;
                foreach ($activities AS $activity) {
                    if ($activity->id == $user->id) {
                        $score = $activity->activityScore + $activity->questionScore + $activity->answerScore + $activity->commentScore;
                    }
                } ?>
                <i class="fa fa-star-o"> <?=$score?></i>
            </td>

        <?php endforeach; ?>

        <!-- Create empty cells for each cell missing (out of 4) -->
        <?php $leftOvers = 4 - count($users);
            if($leftOvers > 0) : ?>
                <?php for ($i = 0; $i < $leftOvers; $i++) : ?>
                    <td class="gravatarCell"></td>
                    <td></td>
                <?php endfor; ?>
            <?php endif; ?>
    </tr>

    <?php endif; ?>
</table>
