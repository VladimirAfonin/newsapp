<h4 class="text-center">Пользователи</h4>
<?php if(isset($_SESSION['success'])) :?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<table class="table">
    <thead>
    <tr>
        <th># id</th>
        <th><a href="/admin?order=login&&sort=<?=$sort?>">Login</a></th>
        <th>Email</th>
        <th><a href="/admin?order=role&&sort=<?=$sort;?>">Role</a></th>
        <th><a href="/admin?order=name&&sort=<?=$sort?>">Name</a></th>
        <th colspan="1">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?= $user['id'] ?></th>
                <td><?= $user['login'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><a href="/admin/user/edit?id=<?=$user['id']?>" class="btn btn-default">edit</a>&nbsp;<a href="/admin/user/delete?id=<?=$user['id']?>" class="btn btn-danger del">delete</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<a href="/admin/user/add" class="btn btn-success">add new</a>