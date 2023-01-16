<?php
include "app/database/path.php";
include "app/controllers/users.php";
?>
<!doctype html>
<html lang="en">

<head>
    <?php include "app/include/head.php"; ?>
    <title>Регистрация</title>
</head>

<body>
    <?php include "app/include/header.php"; ?>

    <!-- Form START -->
    <div class="container register">
        <form class="row justify-content-md-center" method="post" action="register.php">
            <h2>Регистрация</h2>
            <div class="mb-3 col-12 col-md-4 err">
                <p><?= $errMsg ?></p>
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="formGroupexampleInput" class="form-label">Логин</label>
                <input name="login" value="<?= $login ?>" type="text" class="form-control" id="formGroupexampleInput">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input name="password1" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="exampleInputPassword2" class="form-label">Повторить Пароль</label>
                <input name="password2" type="password" class="form-control" id="exampleInputPassword2">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <button type="submit" class="btn btn-secondary" name="button-reg">Регистрация</button>
                <a href="login.php">Войти</a>
            </div>
        </form>
    </div>
    <!-- Form END -->
</body>

</html>