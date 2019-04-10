<?php require_once dirname(__FILE__) . "/layouts/header.php"; ?>
    <div class="container">
        <h3 class="mb-3">Информация про пользователя: </h3>

        <ul class="list-group">
            <li class="list-group-item">Email: <b class="ml-4"><?php echo $user['attributes']['email']?></b></li>
            <li class="list-group-item">Имя: <b class="ml-4"><?php echo $user['attributes']['name']?></b></li>
            <li class="list-group-item">Фамилия: <b class="ml-4"><?php echo $user['attributes']['surname']?></b></li>
            <li class="list-group-item">Телефон: <b class="ml-4"><?php echo $user['attributes']['phone']?></b></li>
        </ul>
    </div>

<?php require_once dirname(__FILE__) . "/layouts/footer.php"; ?>