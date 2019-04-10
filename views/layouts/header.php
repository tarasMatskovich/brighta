<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Brighta</title>
</head>
<body>
<div class="menu mb-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Главная</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/login">Войти</a>
                    <a class="nav-item nav-link" href="/register">Зарегистрироваться</a>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="alerts mb-3">
    <div class="container">
        <?php if (\App\Components\Session::isset('error')): ?>
            <?php foreach (\App\Components\Session::get('error') as $error):?>
                <?php foreach ($error as $e):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?=$e?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endforeach?>
            <?php endforeach;?>
        <?php endif;?>

        <?php if (\App\Components\Session::isset('success')): ?>
            <?php foreach (\App\Components\Session::get('success') as $error):?>
                <?php foreach ($error as $e):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$e?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endforeach?>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>