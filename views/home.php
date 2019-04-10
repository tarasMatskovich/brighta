<?php require_once dirname(__FILE__) . "/layouts/header.php"; ?>
    <div class="container">
        <h3 class="mb-3">Информация про пользователя: </h3>

        <ul class="list-group mb-3">
            <li class="list-group-item">Email: <b class="ml-4"><?php echo $user['attributes']['email']?></b></li>
            <li class="list-group-item">Имя: <b class="ml-4"><?php echo $user['attributes']['name']?></b></li>
            <li class="list-group-item">Фамилия: <b class="ml-4"><?php echo $user['attributes']['surname']?></b></li>
            <li class="list-group-item">Телефон: <b class="ml-4"><?php echo $user['attributes']['phone']?></b></li>
        </ul>

        <div class="image">
            <h4 class="mb-2">Изображение пользователя:</h4>
            <div class="row">
                <div class="col-4">
                    <img src="<?php echo ($user['attributes']['img'] == '') ? '/public/images/no-image.jpg' : '/public/images/' . $user['attributes']['img']?>" alt="">
                </div>
            </div>
        </div>
    </div>

<?php require_once dirname(__FILE__) . "/layouts/footer.php"; ?>