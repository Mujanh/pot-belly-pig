<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$pagekey == 'comment-page' ? $this->url->create('comment') : $this->url->create('')?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
        <fieldset>
        <legend>Skriv ett inlägg</legend>
        <p><label>Din kommentar*:<br/><textarea name='content' rows=10 cols=80 required><?=$content?></textarea></label></p>
        <p><label>Namn*:<br/><input type='text' name='name' required value='<?=$name?>'/></label></p>
        <p><label>Hemsida:<br/><input type='url' name='web' value='<?=$web?>'/></label></p>
        <p><label>E-post:<br/><input type='email' name='mail' value='<?=$mail?>'/></label></p>
        <p class="buttons commentButtons">
            <input type='submit' name='doCreate' value='Skapa' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
            <input type='reset' value='Återställ'/>
            <input type='submit' name='doRemoveAll' value='Radera alla inlägg' formnovalidate onClick="this.form.action = '<?=$this->url->create('comment/remove-all/' . $pagekey)?>'"/>
        </p>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
