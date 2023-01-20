<?php
session_start();
require 'connect.php';

// Функция для отладки
function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// Проверка выполнения запроса к БД
function dbCheckError($query)
{
    $errorInfo = $query->errorInfo();
    if ($errorInfo[0] !== PDO::ERR_NONE) {
        echo $errorInfo[2];
        exit();
    }
    return true;
}

// Получение данных
// Запрос на получение данных с одной таблицы
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Получение данных
// Запрос на получение одной строки с таблицы
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Запись в таблицу БД
function insert($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll .= "`" . "$key" . "`";
            $mask .= "'" . "$value" . "'";
        } else {
            $coll .= "," . " `" . "$key" . "`";
            $mask .= ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
        
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// Обнавление данных в таблицу БД
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str .= $key . " = '" . $value . "'";
        } else {
            $str .= ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Удаление данных в таблице БД
function delete($table, $id)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Выборка для Поиска
function getSearch($search)
{
    global $pdo;
    return array_reverse($pdo->query(
        "SELECT * FROM posts JOIN topics ON posts.id_topic = topics.id
        JOIN users ON posts.id_user = users.id WHERE title LIKE '%{$search}%';"
    )->fetchAll(PDO::FETCH_ASSOC));
}

// Выборка из таблиц: posts, users, topics 
function postssWithTopicsWithUsers($table1, $table2, $table3)
{
    global $pdo;
    $sql = "SELECT * FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_topic = t2.id
            JOIN $table3 AS t3 ON t1.id_user = t3.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка 1 поста с автором и категорией
function singlePostssWithTopicsWithUsers($table1, $table2, $table3, $id)
{
    global $pdo;
    $sql = "SELECT * FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_topic = t2.id
            JOIN $table3 AS t3 ON t1.id_user = t3.id WHERE t1.id_post=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Выборка категорий с автором
function topicsWithUsersWithPosts($table1, $table2, $id)
{
    global $pdo;
    $sql = "SELECT * FROM $table1 AS t1 JOIN $table2 AS t3 ON t1.id_user = t3.id WHERE t1.id_topic=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
