<?php /** @var $data[] \Models\Contact */ ?>
<?php /** @var $contact \Models\Contact */ ?>

<link rel="stylesheet" href="../static/css/index.css">

<div class="wrapper">
    <table id="contacts">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Nickname</th>
            <th>Email</th>
            <th>Group</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data as $contact): ?>
            <tr>
                <td><?=$contact->id; ?></td>
                <td><?=$contact->getName(); ?></td>
                <td><?=$contact->getPhone(); ?></td>
                <td><?=$contact->getNickname(); ?></td>
                <td><?=$contact->getEmail(); ?></td>
                <td><?=$contact->getGroup(); ?></td>
                <td>
                    <a href="">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>