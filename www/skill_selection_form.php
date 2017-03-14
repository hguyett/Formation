<form action="" method="post">
    <p><label for="skillsList">Choississez une compétence : </label></p>
    <select name="skillsList" id="skillsList">
        <?php
        $character = loadCharacter($_SESSION['character'], $manager);
        echo $character->class();
        foreach ($character->getSkillsList() as $key => $value) { ?>
        <option value=<?php echo htmlspecialchars($value, ENT_QUOTES, 'utf-8'); ?> ><?php echo htmlentities($value, ENT_QUOTES, 'utf-8'); ?></option>
<?php   }
         ?>
    </select>
    <p><label for="skillTarget">Choisissez une cible : </label><input type="text" name="skillTarget"></p>
    <p><input type="submit" name="use_skill_submit" value="Valider"></p>
</form>
