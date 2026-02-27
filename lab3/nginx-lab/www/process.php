<?php
session_start();

$username = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email'] ?? '');

// Проверка
$errors = [];
if(empty($username)) $errors[] = "Имя не может быть пустым";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";

// Если ошибки есть — выходим ЗДЕСЬ, до сохранения
if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
}

// Сюда код дойдёт ТОЛЬКО если ошибок нет
$_SESSION['name'] = $username;
$_SESSION['email'] = $email;

$line = $username . ";" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

header("Location: index.php");
exit();