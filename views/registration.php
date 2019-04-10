<?php require_once dirname(__FILE__) . "/layouts/header.php"?>
<div class="container">
    <h3 class="mb-3">Заполните форму, чтобы зарегистрироваться:</h3>

    <form method="POST" action="/signup" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Ваш email адрес:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Введите email">
        </div>
        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя">
        </div>
        <div class="form-group">
            <label for="surname">Ваша фамилия:</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Введите фамилию">
        </div>
        <div class="form-group">
            <label for="phone">Ваш телефон:</label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Введите телефон">
        </div>
        <div class="form-group">
            <label for="password">Ваш пароль:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
        </div>
        <div class="form-group">
            <label for="password_confirm">Ваш пароль повторно:</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Введите пароль повторно">
        </div>
        <div class="form-group">
            <label for="image">Ваше изображение: </label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Загрузите свое изображение">
        </div>

        <button type="submit" class="btn btn-success">Зарегистрироваться</button>
    </form>
</div>

<?php require_once dirname(__FILE__) . "/layouts/footer.php"?>