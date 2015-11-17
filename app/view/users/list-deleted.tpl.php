<h1><?=$title?></h1>

<table class="usertable deleted">
<?php foreach ($users as $user) : ?>

<tr>

<td><a href='<?=$this->url->create('users/id/' . $user->id)?>'><?=$user->getProperties()['acronym']?></a></td>
<td><a href='<?=$this->url->create('users/undo-soft-delete/' . $user->id)?>'><i class="fa fa-undo"> Återställ</i></a></td>
<td><a href='<?=$this->url->create('users/delete/' . $user->id)?>'><i class="fa fa-eraser"> Radera permanent</i></a></td>

</tr>
<?php endforeach; ?>
</table>
<p><a href='<?=$this->url->create('form-small/signup')?>'><i class="fa fa-user-plus"></i> Lägg till användare</a></p>
<hr>

<div class="useroptions">
    <strong>Sortera: </strong>
    <a href='<?=$this->url->create('users/list')?>'><i class="fa fa-users"> Se alla användare</i></a>
    <a href='<?=$this->url->create('users/inactive')?>'><i class="fa fa-ban"> Inaktiva (ej raderade)</i></a>
    <a href='<?=$this->url->create('users/removed')?>'><i class="fa fa-trash-o"> Papperskorgen</i></a>
    <a href='<?=$this->url->create('users/active')?>'><i class="fa fa-check"> Aktiva (ej raderade)</i></a>
</div>

<a class="userbutton" href='<?=$this->url->create('setup')?>'><i class="fa fa-refresh"> Återställ databasen</i></a>
