<?php

namespace Controllers;

use Core\Services\Contacts\ContactServiceInterface;
use Core\Services\Groups\GroupServiceInterface;
use Core\ViewEngine\ViewInterface;
use Models\Group;
use Models\Contact;

class ContactController
{
    public function create(ViewInterface $view,
                        GroupServiceInterface $groupService)
    {
        $allGroups = $groupService->getAllGroups();

        $allGroupsAsObjects = array();
        foreach ($allGroups as $group) {
            $groupObject = new Group($group['id'], $group['name']);
            $allGroupsAsObjects[] = $groupObject;
        }

        $view->render('contact/create', $allGroupsAsObjects);
    }

    public function addPost(ContactServiceInterface $contactService,
                            Contact $contact)
    {
        if($contactService->addContact($contact->getName(),
                                       $contact->getPhone(),
                                       $contact->getNickname(),
                                       $contact->getEmail(),
                                       $contact->getGroup())) {
            header("Location: /ContactsList");
            exit;
        }

        header("Location: /ContactsList/contact/create");
        exit;
    }

    public function delete(ViewInterface $view)
    {
        $view->render();
    }
}