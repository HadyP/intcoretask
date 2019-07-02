<?php require('partial/head.php'); ?>

    <h1>All users</h1>


    <?php foreach($users as $user): ?>

        <ul>
            <li><?= $user->description ?></li>
        </ul>

    <?php endforeach; ?>

    <h1>Submit Your form</h1>


    <form action="/users" method="POST">

        <input type="text" name="name">
        <button type="submit">Submit</button>

    </form>

<?php require('partial/footer.php'); ?>