<?php if (is_array($comments) && !empty($comments)) : ?>
<div class='comments'>
    <?php foreach ($comments as $id => $comment) : ?>
        
        <div class='comment'>
            <div class="commentBox">
                <p><?=$this->textFilter->doFilter($comment->content, "markdown")?></p>

                <div class='commentOrigin'>
                    <p class="commentTime"><?=$comment->timestamp?></p>
                    <p class="commentName"><a href="<?=$this->url->create('users/view/' . $comment->userId)?>"><?=$comment->author?></a></p>
                </div>
            </div>
        <div class="commentLinks">
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php if(!is_array($comments)) : ?>
<p><?=$comments?></p>
<?php endif; ?>
