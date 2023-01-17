<?php
include "function.php";

$errMsg = '';
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';


// Код для формы создания записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['add_post'])) {

    if (!empty($_FILES['image']['name'])) {
        $imgName = $_FILES['image']['name'];
        $imgtmp = $_FILES['image']['tmp_name'];
        $path ='static/image/posts/' . $imgName;
        $result = move_uploaded_file($imgtmp, $path);

        if ($result) {
            $_POST['image'] = $imgName;
        } else {
            $errMsg = 'Не загрузилась картинка';
        }
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    if ($title === '' or $content === '' or $topic === '') {
        $errMsg = 'Не все поля заполнены!!!';
    } elseif (mb_strlen($title) < 5) {
        $errMsg = 'Название статьи не может быть меньше 5 символов!!!';
    } else {
        $post = [
        'id_user' => $_SESSION['id'],
        'title' => $title,
        'content' => $content,
        'image' => $_POST['image'],            
        'id_topic' => $topic
        ]; 
            
        $add_post = insert('posts', $post);         
        header('location: ' . BASE_URL);         
    }
} else {
    $title = '';
    $content = '';
    $img = '';
}
