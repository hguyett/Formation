<form action="" method="post">
    <input type="text" name="createCharacterName" value="<?php if (isset($_POST['characterName']) and is_string($_POST['characterName'])) echo htmlspecialchars($_POST['characterName']); ?>">
    <input type="radio" name="classSelection" value="Warrior" id="Warrior" checked><label for="Warrior">Guerrier</label>
    <input type="radio" name="classSelection" value="Wizard" id="Wizard"><label for="Wizard">Magicien</label>
    <input type="submit" name="create_character_submit" value="Créer le personnage">
</form>
