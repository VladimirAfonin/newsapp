<h2>Редактирование данных пользователя</h2>
<?php if(isset($user)): ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/user/edit" method="post">
                    <input type="hidden" name="id" value="<?=$user['id']?>">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" name="login" disabled class="form-control" id="login" placeholder="login" value="<?=\fw\libs\Helper::cleanStrData($user['login'])?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?= fw\libs\Helper::cleanStrData($user['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" disabled name="email" class="form-control" id="email" placeholder="email" value="<?=  fw\libs\Helper::cleanStrData($user['email']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="role">Права</label>
                        <select  class="form-control" name="role" id="role">
                            <option value="user" <?php if($user['role'] == 'user') echo 'selected' ?>>пользователь</option>
                            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected' ?>>администратор</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">сохранить</button>
                    <a href="/admin"  class="btn btn-danger">отменить</a>
                </form>

                <?php if(isset($_SESSION['form_register_data'])) unset($_SESSION['form_register_data']) ?>
            </div>
        </div>
    </div>
</section>
    <?php else: ?>
    <p>Пользователь не найден!</p>
<?php endif; ?>
