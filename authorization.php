<?php include 'authorization_user.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorization</title>
    <link rel="stylesheet" href="autorization_class.css">
</head>

<body>


    <div class="container">

        <form action="" method="POST">

            <h3
                style="text-align: center; color: #ffff; font-weight: 700; font-size: 30px; font-family: 'Trebuchet MS';">
                Authorization</h3>
            <div class="position-registr">

                <input type="email" name="email" class="default-input-registration"
                    style="-family: 'Trebuchet MS'; font-weight: 700" placeholder="email" required>

                <input type="password" name="password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>
                <div class="message">
                    <?php

                    if (!empty($error)) {
                        echo "<div>" . $error . "</div>";
                    }
                    ?>
                </div>
                <input id='click' type="submit" name="submitButton" class="registration-button">
                <br>
               
            </div>


        </form>

        <div class="position-registr"> 
            <a  href="registration.php" class="nav_livk">Еще не зарегистрированы?</a>   
        </div>


    </div>
 
</body>

</html>