<?php if (is_array($tags) && !empty($tags)) : ?>
<div class='tags'>
    <table class="tagsTable">

        <!-- Do this if there are more than four tags in database  -->
        <?php if(count($tags) > 4) : ?>

            <?php foreach ($tags as $id => $tag) : ?>

                <?php if($id === 0) : ?>
                    <tr>
                <?php endif; ?>

                <!-- Cut of description string if longer than 90 chars, try to preserve whole woerds if possible -->
                <?php if (strlen($tag->description) > 90) {
                    $pos = strpos($tag->description, ' ', 80);

                    if($pos !== false) {
                        $content = substr($tag->description,0,$pos ) . "...";
                    }
                    else {
                        $content = substr($tag->description,0,85 ) . "...";
                    }
                } else {
                    $content = $tag->description;
                }?>

                <td><a href="<?=$this->url->create('tags/view/' . $tag->id )?>"><?=$tag->tag?></a><span> &times; <?=$tag->nrQuestions?></span>
                    <p class="tagsDescription"><?=$content?></p>
                </td>

                <!-- Add new table row after every fourth cell -->
                <?php if(($id + 1) % 4 === 0) : ?>
                    </tr>
                    <?php if (($id + 1) !== count($tags)) : ?>
                        <tr>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>

        <!-- Do this if there are less than four tags in database  -->
        <?php else : ?>
            <tr>
                <?php foreach($tags AS $tag) : ?>

                    <!-- Cut of description string if longer than 90 chars, try to preserve whole woerds if possible -->
                    <?php if (strlen($tag->description) > 90) {
                        $pos = strpos($tag->description, ' ', 80);

                        if($pos !== false) {
                            $content = substr($tag->description,0,$pos ) . "...";
                        }
                        else {
                            $content = substr($tag->description,0,85 ) . "...";
                        }
                    } else {
                        $content = $tag->description;
                    }?>

                    <td><a href="<?=$this->url->create('tags/view/' . $tag->id )?>"><?=$tag->tag?></a><span> &times; <?=$tag->nrQuestions?></span>
                        <p class="tagsDescription"><?=$content?></p>
                    </td>

            <?php endforeach; ?>

            <!-- Create empty cells for each cell missing (out of 4 total) -->
            <?php $leftOvers = 4 - count($tags);
                if($leftOvers > 0) : ?>
                <?php for ($i = 0; $i < $leftOvers; $i++) : ?>
                    <td></td>
                    <?php endfor; ?>
                <?php endif; ?>
            </tr>
        <?php endif; ?>

    </table>
</div>
<?php endif; ?>

<?php if(!is_array($tags) && !empty($tags)) : ?>
    <p><?=$tags?></p>
<?php endif; ?>

<?php if(empty($tags)) : ?>
    <p>There are no tags yet</p>
<?php endif; ?>
