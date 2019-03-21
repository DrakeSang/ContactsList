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
            </tr>
            <?php foreach ($data as $contact): ?>
                <tr>
                    <td><?=$contact->getName(); ?></td>
                    <td><?=$contact->getPhone(); ?></td>
                    <td><?=$contact->getNickname(); ?></td>
                    <td><?=$contact->getEmail(); ?></td>
                    <td><?=$contact->getGroup(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <h2>Maybe you entered wrong id for that specific group. You can return to main page and
        <a href="/ContactsList">try again</a></h2>
<?php endif; ?>
