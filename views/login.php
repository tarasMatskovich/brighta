<?php require_once dirname(__FILE__) . "/layouts/header.php"?>
    <div class="container">
        <h3 class="mb-3">Войдите в систему</h3>
        <form method="POST" action="/loginuser">
            <div class="form-group">
                <label for="email">Ваш email адрес:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Введите email">
                <div class="invalid-feedback">
                    Введите email
                </div>
            </div>

            <div class="form-group">
                <label for="password">Ваш пароль:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
                <div class="invalid-feedback">
                    Введите пароль
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="log">Войти</button>
        </form>
    </div>

<?php require_once dirname(__FILE__) . "/layouts/footer.php"?>