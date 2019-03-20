<?php /** @var $group \Models\Group */ ?>
<?php /** @var $data[] \Models\Group */ ?>

<link rel="stylesheet" href="../static/css/index.css">

<div>
    <form action="/ContactsList/contact/addPost" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Contact Name..">

        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Contact Phone..">

        <label for="nickname">Nickname</label>
        <input type="text" id="nickname" name="nickname" placeholder="Contact Nickname..">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Contact Email..">

        <label for="groups">Groups</label>
        <select id="groups" name="group">
            <?php foreach ($data as $group): ?>
                <option value="<?=$group->getId(); ?>"><?=$group->getName(); ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
    </form>
</div>