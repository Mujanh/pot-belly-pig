<h1><?=$title?></h1>

<?php foreach ($users as $user) : ?>

<p><a href='<?=$this->url->create('users/id/' . $user->id)?>'><?=$user->getProperties()['acronym']?></a></p>
<p><?=$user->getProperties()['email']?></p>
<p><a href='<?=$this->url->create('users/do-activate/' . $user->id)?>'>Aktivera användare</a></p>

<?php endforeach; ?>

<p><a href='<?=$this->url->create('users')?>'>Home</a></p>
