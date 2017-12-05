<h4 class="text-center">Новости</h4>
<?php if(isset($_SESSION['success'])) :?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<table class="table">
    <thead>
    <tr>
        <th># id</th>
        <th>Текст</th>
        <th colspan="1">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($news)): ?>
        <?php foreach ($news as $item): ?>
            <tr>
                <th scope="row"><?= $item['id'] ?></th>
                <td><?= $item['text'] ?></td>
                <td><a href="/admin/news/edit?id=<?=$item['id']?>" class="btn btn-default">edit</a>&nbsp;<a href="/admin/news/delete?id=<?=$item['id']?>" class="btn btn-danger del">delete</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<a href="/admin/news/add" class="btn btn-success">add new</a>