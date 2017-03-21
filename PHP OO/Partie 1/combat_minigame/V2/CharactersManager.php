<?php
class CharactersManager
{
    /**
     * Connection to MySQL database.
     * @var PDO $database
     */
    private $database;

    public function __construct(PDO $database)
    {
        $this->setDatabase($database);
    }

    /**
     * Create connection with MySQL database.
     * @param PDO $database
     */
    public function setDatabase(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Adds a character to the database.
     * @param  Character $character
     * @return boolean               Return true if the query has been executed.
     */
    public function add(Character $character): bool
    {
        try {
            $query = $this->database->prepare('INSERT INTO characters (name, class) VALUES (:name, :class)');
            $query->bindValue(':name', $character->name(), PDO::PARAM_STR);
            $query->bindValue(':class', $character->class(), PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            // Le personnage existe déjà.
            return false;
        }

        $character->hydrate([
            'id' => $this->database->lastInsertId(),
            'damages' => 0,
        ]);

        return true;
    }

    /**
     * Updates a character informations into the database.
     * @param  Character $character
     * @return boolean               Return true if the query has been executed.
     */
    public function update(Character $character): bool
    {
        $query = $this->database->prepare('UPDATE characters SET name = :name, damages = :damages WHERE id = '.$character->id());
        $query->bindValue(':name', $character->name(), PDO::PARAM_STR);
        $query->bindValue(':damages', $character->damages(), PDO::PARAM_INT);

        return $query->execute();
    }

    /**
     * Deletes a character into the database.
     * @param  Character $character
     * @return boolean               Return true if the query has been executed.
     */
    public function delete(Character $character): bool
    {
        $query = $this->database->prepare('DELETE FROM characters WHERE id = :id');
        $query->bindValue(':id', $character->id(), PDO::PARAM_STR);
        return $query->execute();
    }

    /**
     * Return a character from the database.
     * @param  mixed $info Can be character's name (String) or id (int).
     * @return array       Return the array sent by the database.
     * @throws Exception If the character can't be found, an exception is thrown.
     */
    public function get($info): array
    {
        $query = new PDOStatement();
        if (is_int($info) and $info > 0) {
            $query = $this->database->prepare('SELECT * FROM characters WHERE ID = :id');
            $query->bindValue(':id', $info, PDO::PARAM_INT);
        } else if (is_string($info)) {
            $query = $this->database->prepare('SELECT * FROM characters WHERE name = :name');
            $query->bindValue(':name', $info, PDO::PARAM_STR);
        }
        try {
            $query->execute();
        } catch (Exception $e) {
            throw $e;
        }
        $data = $query->fetch();
        $query->closeCursor();
        if (!$data) {
            throw new Exception("Character doesn't exist.", 1);
        }
        return $data;
    }

    /**
     * Return the list of all characters.
     * @return array Return the array sent by the database.
     */
    public function getList(): array
    {
        $result = $this->database->query('SELECT name, class, damages FROM characters');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $data;
    }
}
