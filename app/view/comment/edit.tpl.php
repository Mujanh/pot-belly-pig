<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$pagekey == 'comment-page' ? $this->url->create('comment') : $this->url->create('')?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
        <fieldset>
        <legend>Redigera inlägg</legend>
        <p><label>Din kommentar*:<br/><textarea name='content' rows=10 cols=80 required><?=strip_tags($comment['content'])?></textarea></label></p>
        <p><label>Namn*:<br/><input type='text' name='name' required value='<?=$comment['name']?>'/></label></p>
        <p><label>Hemsida:<br/><input type='url' name='web' value='<?=$comment['web']?>'/></label></p>
        <p><label>E-post:<br/><input type='email' name='mail' value='<?=$comment['mail']?>'/></label></p>
        <p class="buttons commentButtons">
            <input type='submit' name='doEdit' value='Spara ändringar' onClick="this.form.action = '<?=$this->url->create('comment/edit-comment/' . $id . '/' . $pagekey)?>'"/>
            <input type='reset' value='Ångra'/>
            <input type='submit' name='doRemoveOne' value='Radera' formnovalidate onClick="this.form.action = '<?=$this->url->create('comment/delete/' . $id . '/' . $pagekey)?>'"/>
            <input type='submit' name='doGoBack' value='Tillbaka' formnovalidate onClick="this.form.action =
                '<?=$pagekey == 'comment-page' ? $this->url->create('comment') : $this->url->create('')?>'"/>
        </p>
        <output></output>
        </fieldset>
    </form>
</div>
