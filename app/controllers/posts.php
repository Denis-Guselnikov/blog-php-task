<?php
include "app/database/function.php";

$errMsg = '';
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';


// Код для формы создания записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['add_post'])) {

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
            'id_topic' => $topic,
         ];        
         $add_post = insert('posts', $post); 
         $view_post = selectOne('posts', ['id' => $id]);
         header('location: ' . BASE_URL);         
    }
} else {
    $title = '';
    $content = '';
    $img = '';
}
