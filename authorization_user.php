<?php

session_start();
if (isset($_SESSION['auth']) && $_SESSION['auth'])
    header("Location: index.php");

try {
    $dbh = new PDO('mysql:host=localhost;dbname=page', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];


        $sth = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
        $sth->bindParam(':email', $email);
        $sth->execute();

        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            if (!empty($user)) {
                $_SESSION['auth'] = true;
                $_SESSION['user_data'] = $user;
            }
            header("Location: index.php");
        } else {
            $error = 'Неправильный email или пароль.';
        }
    }
} catch (Exception $e) {

}

?>