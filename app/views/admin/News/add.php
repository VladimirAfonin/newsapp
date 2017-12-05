<section>
    <div class="container">
        <h2>Добавление новой новости</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/news/add" method="post">
                    <div class="form-group">
                        <label for="login">Текст</label>
                        <textarea name="text" class="form-control" id="text" placeholder="текст новости..." value="<?= (isset($_SESSION['form_register_data']['text'])) ? fw\libs\Helper::cleanStrData($_SESSION['form_register_data']['text']) : null  ?>"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">добавить</button>
                    <a href="/admin/news/index"  class="btn btn-danger">отменить</a>
                </form>
                <?php if(isset($_SESSION['form_register_data'])) unset($_SESSION['form_register_data']) ?>
            </div>
        </div>
    </div>
</section>
