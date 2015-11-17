<h1><?=$title?></h1>

<table class="usertable">
<?php foreach ($users as $user) : ?>
    <tr class="<?=!is_null($user->deleted) ? 'userdeleted' : '' ?>">
        <!--<pre><?=var_dump($user->getProperties())?></pre>-->

        <td><a href='<?=$this->url->create('users/id/' . $user->id)?>'><?=$user->getProperties()['acronym']?></a></td>
        <td><a href='<?=$this->url->create('users/update/' . $user->id)?>'><i class="fa fa-pencil-square-o"> Ändra</i></a></td>

        <td><?php if(is_null($user->deleted)) : ?>
        <a href='<?=$this->url->create('users/soft-delete/' . $user->id)?>'><i class="fa fa-times"> Ta bort</i></a>
        <?php else : ?>
        <a href='<?=$this->url->create('users/undo-soft-delete/' . $user->id)?>'><i class="fa fa-undo"> Återställ</i></a>
        <?php endif; ?></td>

        <td class="<?=is_null($user->active) ? 'userinactive' : 'useractive' ?>"><?php if(!is_null($user->active)) : ?>
        <a href='<?=$this->url->create('users/do-deactivate/' . $user->id)?>'><i class="fa fa-ban"> Inaktivera</i></a>
        <?php else : ?>
        <a href='<?=$this->url->create('users/do-activate/' . $user->id)?>'><i class="fa fa-check"> Aktivera</i></a>
        <?php endif; ?></td>
    </tr>

<?php endforeach; ?>

</table>
<p><a href='<?=$this->url->create('users/add')?>'><i class="fa fa-user-plus"></i> Lägg till användare</a></p>
<hr>

<div class="useroptions">
    <strong>Sortera: </strong>
    <a href='<?=$this->url->create('users/list')?>'><i class="fa fa-users"> Se alla användare</i></a>
    <a href='<?=$this->url->create('users/inactive')?>'><i class="fa fa-ban"> Inaktiva (ej raderade)</i></a>
    <a href='<?=$this->url->create('users/removed')?>'><i class="fa fa-trash-o"> Papperskorgen</i></a>
    <a href='<?=$this->url->create('users/active')?>'><i class="fa fa-check"> Aktiva (ej raderade)</i></a>
</div>

<a class="userbutton" href='<?=$this->url->create('setup')?>'><i class="fa fa-refresh"> Återställ databasen</i></a>
