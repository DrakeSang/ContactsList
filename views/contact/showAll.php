<?php /** @var $data[] \Models\Contact */ ?>
<?php /** @var $contact \Models\Contact */ ?>

<link rel="stylesheet" href="../static/css/index.css">

<?php if(count($data) > 0): ?>
    <div class="wrapper">
        <table id="contacts">
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data as $contact): ?>
                <tr>
                    <td><?=$contact->getName(); ?></td>
                    <td><?=$contact->getPhone(); ?></td>
                    <td><?=$contact->getNickname(); ?></td>
                    <td><?=$contact->getEmail(); ?></td>
                    <td><?=$contact->getGroup(); ?></td>
                    <td>
                        <a href="/ContactsList/contact/delete/<?=$contact->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <h2>Your contacts are empty. You should go and add new <a href="/ContactsList/contact/create">contact</a></h2>
<?php endif; ?>