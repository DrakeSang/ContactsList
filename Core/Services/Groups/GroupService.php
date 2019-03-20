<?php

namespace Core\Services\Groups;

use Driver\DatabaseInterface;

class GroupService implements GroupServiceInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getAllGroups(): array
    {
        $query = "SELECT * FROM groups";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();

        return $result;
    }
}