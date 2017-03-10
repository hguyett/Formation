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
        $query = $this->database->prepare('INSERT INTO characters (name) VALUES (:name)');
        $query->bindValue(':name', $character->name(), PDO::PARAM_STR);

        if ($isQueryExecuted = (bool)$query->execute()) {
            $character->hydrate([
                'id' => $this->database->lastInsertId(),
                'damages' => 0,
            ]);
        }
        return $isQueryExecuted;
    }

    /**
     * Updates a character informations into the database.
     * @param  Character $character
     * @return boolean               Return true if the query has been executed.
     */
    public function update(Character $character): bool
    {
        $query = $this->database->prepare('UPDATES characters SET name = :name, damage = :damages WHERE id = '.$character->id());
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
     * @param  mixed $info Can be character's name or id.
     * @return array       Return the array sent by the database.
     */
    public function get(mixed $info): array
    {
        if (is_int($info) and $info > 0) {
            $query = $this->database->prepare('SELECT * FROM characters WHERE ID = :id');
            $query->bindValue(':id', $info, PDO::PARAM_INT);
            $query->execute();
            return $query;
        } else if (is_string($info)) {
            $query = $this->database->prepare('SELECT * FROM characters WHERE name = :name');
            $query->bindValue(':name', $info, PDO::PARAM_STR);
            $query->execute();
            return $query;
        }
    }

    /**
     * Return the list of all characters.
     * @return array Return the array sent by the database.
     */
    public function getList(): array
    {
        $data = $this->database->query('SELECT nom, damages FROM characters');
        return $data;
    }
}
