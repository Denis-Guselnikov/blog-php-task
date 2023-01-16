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
    global $pdo;  // экземпляр класса
    $sql = "SELECT * FROM $table";  // запрос

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

    $query = $pdo->prepare($sql);   // подготовка, выполнение, возврат ошибок
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Получение данных
// Запрос на получение одной строки с таблицы
function selectOne($table, $params = [])
{
    global $pdo;  // экземпляр класса
    $sql = "SELECT * FROM $table";  // запрос

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
    $coll = ''; // Колонка
    $mask = ''; // Строка = значение
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll .= "$key";
            $mask .= "'" . "$value" . "'";
        } else {
            $coll .= ", $key";
            $mask .= ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// Обнавление данных в таблицу БД
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = ''; // Строка    
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
    $query->execute($params);
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

// Для Поиска
function getSearch($search)
{
    global $pdo;
    return array_reverse($pdo->query("SELECT * FROM posts WHERE title LIKE '%{$search}%';")->fetchAll(PDO::FETCH_ASSOC));
}
