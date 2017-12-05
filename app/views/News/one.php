<h4 class="text-center">Новость</h4>
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
    </tr>
    </thead>
    <tbody>
    <?php if (isset($news)): ?>
        <tr>
            <th scope="row"><?= $news['id'] ?></th>
            <td><?= $news['text'] ?></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/" class="btn btn-success">вернуться</a>