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
        <th>Детали</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($news)): ?>
        <?php foreach ($news as $item): ?>
            <tr>
                <th scope="row"><?= $item['id'] ?></th>
                <td><?= $item['text'] ?></td>
                <td><a href="/news/one?id=<?=$item['id']?>">просмотреть</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<a href="/user/edit" class="btn btn-success">редактировать профиль</a>
<br><hr>
