<link rel="stylesheet" href="static/css/index.css">

<h1>Welcome to my contact list. :)</h1>

<p>Your actions are to add new contact, delete specific contact, see all contacts and see all
for specific contact.
</p>

<div class="wrapper">
    <table id="customers">
        <tr>
            <th>Actions</th>
        </tr>
        <tr>
            <td>
                <a href="contact/create">Add Contact</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="contact/showAll">See all contacts</a>
            </td>
        </tr>
        <tr>
            <td>
                <form action="/ContactsList/contact/groupId" method="post">
                    <label for="groupId">Id of the group</label>
                    <input type="number" step="1" id="groupId" name="groupId" placeholder="Group Id..">

                    <input type="submit" value="Submit">
                </form>
            </td>
        </tr>
    </table>
</div>