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

    public function getAllContacts(): array
    {
        $query = "SELECT c.name as contactName, g.name as groupName, c.phone, c.nickname, c.email
                  FROM contacts as c
                  LEFT JOIN groups as g
                  ON c.groupID = g.id";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();

        return $result;
    }

    public function deleteContact(int $id): bool
    {
        $query = "DELETE FROM contacts WHERE contacts.id = ?";
        $statement = $this->db->prepare($query);

        return $statement->execute([$id]);
    }
}