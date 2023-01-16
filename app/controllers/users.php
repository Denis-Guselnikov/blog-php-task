<?php
include "function.php";

$isSubmit = false;
$errMsg = '';

// Для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);

    if ($login === '' or $password1 === '') {
        $errMsg = 'Не все поля заполнены!!!';
    } elseif (mb_strlen($login) < 4) {
        $errMsg = 'Логин не может быть меньше 4 символов!!!';
    } elseif ($password1 !== $password2) {
        $errMsg = 'Пароли не похожи!!!';
    } else {
        $existLogin = selectOne('users', ['username' => $login]);
        if ($existLogin['username'] === $login) {
            $errMsg = 'Такой пользователь уже есть!!!';
        } else {
            $pass = password_hash($password1, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'password' => $pass,
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);

            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['username'];
            $_SESSION['admin'] = $user['admin'];
            header('location: ' . BASE_URL); // redirect                 
        }
    }
} else {
    $login = '';
}

// Для формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-log'])) {

    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if ($login === '' or $password === '') {
        $errMsg = 'Не все поля заполнены!!!';
    } else {
        $existLogin = selectOne('users', ['username' => $login]);
        if ($existLogin and password_verify($password, $existLogin['password'])) {
            $_SESSION['id'] = $existLogin['id'];
            $_SESSION['login'] = $existLogin['username'];
            $_SESSION['admin'] = $existLogin['admin'];
            header('location: ' . BASE_URL);
        } else {
            $errMsg = 'Ошибка авторизациии';
        }
    }
} else {
    $login = '';
}
