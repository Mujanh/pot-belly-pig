
<div class="userprofile">

    <div class="profilePicture">
        <div class="profileGravatar">
            <img src="<?=$user->getProperties()['gravatar']?>" alt="Användar-gravatar">
            <i class="fa fa-star-o"> <?=$reputation?></i>
        </div>
        <?php if ($currentUser == $user->getProperties()['acronym']) :?>
            <a href="<?=$this->url->create('users/update')?>" title="Ändra din profil">Uppdatera din profil</a>
        <?php endif; ?>
    </div>

    <div class="profileStats">
        <h3><?=$user->getProperties()['acronym']?></h3>
        <?php
            $time = strtotime($user->getProperties()['created']);
        ?>
        <div class="memberInfo">

            <p>Medlem sedan: <?=strftime("%d %b %Y", $time)?></p>
            <p>Rykte: <?=$reputation?></p>
        </div>

        <div class="activityStats">
            <div class="questionsStats"><p><strong><?=$activity->getProperties()['questions']?></strong> frågor</p></div>
            <div class="answerStats"><p><strong><?=$activity->getProperties()['answers']?></strong> svar</p></div>
            <div class="commentStats"><p><strong><?=$activity->getProperties()['comments']?></strong> kommentarer</p></div>
            <div class="votesStats"><p><strong><?=$activity->getProperties()['votes']?></strong> röstningar</p></div>

        </div>
    </div>
    <div class="profileDescription">
        <p><?=!is_null($user->getProperties()['profile']) ? $user->getProperties()['profile'] : '<em>Användaren har inte skrivit någon presentation ännu.</em>'?></p>
    </div>



</div>
