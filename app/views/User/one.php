<h4 class="text-center">Пользователь</h4>
<?php if(isset($_SESSION['success'])) :?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<table class="table">
    <thead>
    <tr>
        <th># id</th>
        <th>Login</th>
        <th>Email</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($user)): ?>
            <tr>
                <th scope="row"><?= $user['id'] ?></th>
                <td><?= $user['login'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['name'] ?></td>
            </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/" class="btn btn-success">вернуться</a>