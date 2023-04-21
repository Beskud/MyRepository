<?php

session_start();
if(isset($_SESSION['auth']) && $_SESSION['auth'])  header("Location: index.php");

$pregPass = [
    'digits' => '@[0-9]@',
    'capital letters' => '#[A-Z]+#',
    'lowercase letters' => '#[a-z]+#'
];

$error_validation = [];

if (isset($_POST['email']) && isset($_POST['username']) &&
    isset($_POST['password']) && isset($_POST['confirmation_password'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmation_password = $_POST['confirmation_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error_validation['email'] = "Invalid email format";
    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username))  $error_validation['username'] = 'Invalid username format';
    if ($password != $confirmation_password) $error_validation['confirmation_password'] = 'Password mismatch';


    foreach ($pregPass as $key => $value) {
        if (!preg_match($value, $password)) {
            $error_validation['password'] = 'The password is not valid. Does not contain ' . $key;
        }
    }

    try {

        $dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sth = $dbh->prepare(
            "INSERT INTO Users (email, username, password) 
                VALUES (:email, :username, :password)"
        );

        $sth->bindParam(':email', $email);
        $sth->bindParam(':username', $username);
        $sth->bindParam(':password', $password_hash);
        $sth->execute();
        
        header("Location: index.php");

    } catch (Exception $e) {
        $error_validation['check_email'] = 'This email or username already exists';

    }

}