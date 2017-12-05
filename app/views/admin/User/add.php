<section>
    <div class="container">
        <h2>Добавление нового пользователя</h2>

        <div class="row">
            <div class="col-md-6">
                <form action="/admin/user/add" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" name="login" class="form-control" id="login" placeholder="login" value="<?= (isset($_SESSION['form_register_data']['login'])) ? fw\libs\Helper::cleanStrData($_SESSION['form_register_data']['login']) : null  ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?= (isset($_SESSION['form_register_data']['name'])) ? fw\libs\Helper::cleanStrData($_SESSION['form_register_data']['name']) : null ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="email" value="<?= (isset($_SESSION['form_register_data']['email']))  ? fw\libs\Helper::cleanStrData($_SESSION['form_register_data']['email']) : null ?>">
                    </div>
                    <div class="form-group">
                    <label for="role">Права</label>
                    <select  class="form-control" name="role" id="role">
                        <option value="user">пользователь</option>
                        <option value="admin" >администратор</option>
                    </select>
            </div>
                    <button type="submit" name="submit" class="btn btn-success">добавить</button>
                    <a href="/admin"  class="btn btn-danger">отменить</a>
                </form>
                <?php if(isset($_SESSION['form_register_data'])) unset($_SESSION['form_register_data']) ?>
            </div>
        </div>
    </div>
</section>
