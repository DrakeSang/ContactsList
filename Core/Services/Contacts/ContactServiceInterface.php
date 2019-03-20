<?php

namespace Core\Services\Contacts;

interface ContactServiceInterface
{
    public function addContact(string $name,
                               string $phone,
                               string $nickname,
                               string $email,
                               int $groupId): bool;

    public function getAllContacts(): array;
}