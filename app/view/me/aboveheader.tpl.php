<?php if($loggedIn) : ?>
    <span class="above-profile"><a href="<?=$this->url->create('login')?>" title="Se din profil">Din profil</a></span>
    <span class="above-logout"><a href="<?=$this->url->create('users/logout')?>" title="Logga ut">Logga ut</a></span>
<?php else : ?>
    <span class="above-signup"><a href="<?=$this->url->create('create')?>" title="Registrera ny användare">Registrera</a></span>
    <span class="above-login"><a href="<?=$this->url->create('login')?>" title="Logga in">Logga in</a></span>
<?php endif; ?>
