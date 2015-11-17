<h1>Se detaljer för användaren <?=$user->getProperties()['acronym']?></h1>

<!--<pre><?=var_dump($user->getProperties())?></pre>-->

<p>Namn: <?=$user->getProperties()['name']?></p>
<p>Email: <?=$user->getProperties()['email']?></p><br>

<p class="<?=isset($user->getProperties()['active']) ? 'activated' : 'deactivated'?>">Aktiverad: <?=$user->getProperties()['active']?></p>
<p>Skapad: <?=$user->getProperties()['created']?></p>
<p class="<?=isset($user->getProperties()['deleted']) ? 'deleted' : ''?>">Raderad: <?=$user->getProperties()['deleted']?></p>


<p><a href='<?=$this->url->create('users')?>'>Home</a></p>
