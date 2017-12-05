<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php \fw\core\base\View::getMeta() ?>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">

        <ul class="nav nav-pills">
            <li><a href="/">Home</a></li>
            <li><a href="/admin">Admin</a></li>
            <?php if(!isset($_SESSION['user_data'])): ?>
                <li><a href="/user/login">Login</a></li>
                <li><a href="/user/signup">Sign Up</a></li>
            <?php else: ?>
                <li><a href="/user/logout">Logout</a></li>
            <?php endif; ?>
        </ul>
        <?php if(isset($menu)) : ?>
            <?php foreach($menu as $item) : ?>
                <li><a href="category/<?= $item['id'] ?>"><?= $item->title?></a></li>
            <?php endforeach ;?>

    <?php endif; ?>

    <h3>Добро пожаловать, <?= (isset($_SESSION['user_data']['name'])) ? ($_SESSION['user_data']['name']) : 'гость'?>.</h3>
    <?=$content?>
</div>


<?php if(isset($_SESSION['errors'])) :?>
    <div class="alert alert-danger">
        <?= $_SESSION['errors']; unset($_SESSION['errors']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['success'])) :?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php foreach($scripts as $script): ?>
    <?=$script?>
<?php endforeach; ?>

</body>
</html>