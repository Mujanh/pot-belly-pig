<hr>

<h2>Inlägg</h2>

<?php if (is_array($comments) && !empty($comments)) : ?>
<div class='comments'>
    <?php foreach ($comments as $id => $comment) : ?>

        <h4 class="commentNr">Inlägg <a href="<?=$this->url->create('comment/edit-view/' . $comment->id )?>">#<?=$id?></a></h4>
        <div class='comment'>
            <div class="commentBox">
                <p><?=$comment->content?></p>

                <div class='commentOrigin'>
                    <p class="commentTime"><?=$comment->timestamp?></p>
                    <img src="<?=$comment->gravatar?>" alt="Gravatar">
                    <p class="commentName"><?=$comment->name?></p>
                </div>
            </div>
        <div class="commentLinks">
        <p class="left"><a href="<?=$comment->web?>"><?=!empty($comment->web) ? "Hemsida" : ""?></a></p>
        <p class="right"><?=$comment->email?></p>
        <!--<p><a href="<?=$this->url->create('comment/delete/' . $id . '/' . $pagekey)?>">Radera</a>-->
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php if(!is_array($comments)) : ?>
<p><?=$comments?></p>
<?php endif; ?>
