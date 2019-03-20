<?php

namespace Core\Services\Contacts;

use Driver\DatabaseInterface;

class ContactService implements ContactServiceInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function addContact(string $name,
                               string $phone,
                               string $nickname,
                               string $email,
                               int $groupId): bool
    {
        $query = "INSERT 
                  INTO contacts (name, phone, nickname, email , groupID)
                  VALUES (?, ?, ?, ?, (SELECT id FROM groups WHERE groups.id = ?))";
        $statement = $this->db->prepare($query);

        return $statement->execute([$name, $phone, $nickname, $email, $groupId]);
    }
}