<?php

namespace Controllers;

use Core\Http\RequestInterface;
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

    public function showAll(ViewInterface $view,
                            ContactServiceInterface $contactService)
    {
        $allContacts = $contactService->getAllContacts();

        $allContactsAsObjects = array();

        foreach ($allContacts as $contact) {
            $contactObject = new Contact();

            $contactObject->setName($contact['contactName']);
            $contactObject->setPhone($contact['phone']);
            $contactObject->setNickname($contact['nickname']);
            $contactObject->setEmail($contact['email']);
            $contactObject->setGroup($contact['groupName']);

            $allContactsAsObjects[] = $contactObject;
        }

        $view->render('contact/showAll', $allContactsAsObjects);
    }

    public function delete(int $id,
                           ContactServiceInterface $contactService)
    {
        if($contactService->deleteContact($id)) {
            header("Location: /ContactsList/contact/showAll");
            exit;
        }
    }

    public function groupId()
    {
        $groupId = $_POST['groupId'];

        header("Location: /ContactsList/contact/group?groupId=" . $groupId);
        exit;
    }

    public function group(RequestInterface $request,
                          ContactServiceInterface $contactService,
                          ViewInterface $view)
    {
        $queryStringArray = array();
        parse_str($request->getQueryString(), $queryStringArray);

        $allContactsForSpecificGroup =
            $contactService->getContactsForSpecificGroup($queryStringArray['groupId']);

        $allContactsAsObjects = array();

        foreach ($allContactsForSpecificGroup as $contact) {
            $contactObject = new Contact();

            $contactObject->setName($contact['contactName']);
            $contactObject->setPhone($contact['phone']);
            $contactObject->setNickname($contact['nickname']);
            $contactObject->setEmail($contact['email']);
            $contactObject->setGroup($contact['groupName']);

            $allContactsAsObjects[] = $contactObject;
        }

        $view->render('group/showAllContacts', $allContactsAsObjects);
    }
}