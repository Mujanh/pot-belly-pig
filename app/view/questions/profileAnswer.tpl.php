<div class="profileRightTable">
    <h4>Senaste svaren</h4>

    <?php if(is_array($answers) && !empty($answers)) : ?>

        <table class="profileAnswerTable">
        <?php foreach ($answers AS $answer) : ?>

            <!-- Get title to question and limit it to around 20 chars (whole words) -->
            <?php $title = null;
            foreach ($questions AS $question) {
                if($question->id == $answer->questionId) {
                    $title = $question->title;

                    //If the title is over 30 chars, cut it off at the first space character after 20 chars
                    if (strlen($title) > 30) {
                        $pos = strpos($question->title, ' ', 20);


                        if($pos !== false) {
                            $title = substr($question->title,0,$pos ) . "...";
                        }
                        //If no space character was found after 20 chars, just cut the string at 25 chars
                        else {
                            $title = substr($question->title,0,25) . "...";
                        }
                    }
                }
            } ?>

            <?php $time = strtotime($answer->timestamp); ?>
            <tr>
                <td class="profileScore"><?=$answer->score?></td>
                <td class="profileTime"><a href="<?=$this->url->create('question/view/' . $answer->questionId . '#' . $answer->id)?>" title="Se hela frågan"><?=$title?></a></td>
                <td class="profileTime"><?=strftime("%d %b '%y", $time)?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="<?=$this->url->create('question/view-user-answers/' . $answer->userId)?>" title="Se alla svar från användaren"> Visa alla svar <i class="fa fa-long-arrow-right"></i></a>

    <?php elseif (empty($answers)) : ?>
        <p>Inga svar ännu</p>
    <?php endif; ?>
</div>
