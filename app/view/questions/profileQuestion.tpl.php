<div class="profileLeftTable">
    <h4>Senaste frågorna</h4>

    <?php if(is_array($questions) && !empty($questions)) : ?>
        <table class="profileQuestionTable">

        <?php foreach ($questions AS $question) : ?>

            <!-- Is the title longer than 30 chars? -->
            <?php if (strlen($question->title) > 30) {

                //Find the first space char after 20 characters in word
                $pos = strpos($question->title, ' ', 20);

                //Cut string at around 20 chars but without cutting a word in half
                if($pos !== false) {
                    $title = substr($question->title,0,$pos ) . "...";
                }
                //If no space char was found after 20 chars, just cut the string at 25 chars
                else {
                    $title = substr($question->title,0,25 ) . "...";
                }
            } else {
                $title = $question->title;
            }?>

            <?php $time = strtotime($question->timestamp); ?>
            <tr>
                <td class="profileScore"><?=is_null($question->qScore) ? 0 : $question->qScore?></td>
                <td class="profileTitle"><a href="<?=$this->url->create('question/view/' . $question->id)?>" title="Se hela frågan"><?=$title?></a></td>
                <td class="profileTime"><?=strftime("%d %b '%y", $time)?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="<?=$this->url->create('question/view-user-questions/' . $question->userId)?>" title="Visa alla frågor från användaren"> Visa alla frågor <i class="fa fa-long-arrow-right"></i></a>

    <?php elseif (empty($questions)) : ?>
        <p>Inga frågor ännu</p>
    <?php endif; ?>
</div>
