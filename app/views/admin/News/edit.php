<h2>Редактирование новости</h2>
<?php if(isset($news)): ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="/admin/news/edit" method="post">
                        <input type="hidden" name="id" value="<?=$news['id']?>">
                        <div class="form-group">
                            <label for="text">Текст</label>
                            <textarea  name="text"  class="form-control" id="text"><?=\fw\libs\Helper::cleanStrData($news['text'])?></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">сохранить</button>
                        <a href="/admin/news/index"  class="btn btn-danger">отменить</a>
                    </form>

                    <?php if(isset($_SESSION['form_register_data'])) unset($_SESSION['form_register_data']) ?>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <p>Новость не найдена!</p>
<?php endif; ?>
