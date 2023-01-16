<?php

$driver = 'mysql';
$host = 'mysql';
//$host = 'localhost';
$db_name = 'blog-php-task';
$db_user = 'root';
$db_pass = '12345';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];  // Убираем дублирование при выводе

try {
    $pdo = new PDO(
        "$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
    );
} catch (PDOException $i){
    die("Ошибка подключения к базе данных");
} 