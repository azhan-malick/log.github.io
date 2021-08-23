<?php include "connection.php" ?>

<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <header>
        <h2>E-STORE</h2>
        <nav>
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Portfolio</a>
            <a href="#">Contact</a>
        </nav>

        <?php 
        
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
        {
            echo"
            <div class='user'>
            $_SESSION[username] - <a href = 'logout.php' >LOGOUT</a>
            </div>

            ";
        }
        else
        {
            echo "
            <div class='sign-in-up'>
            <button type='button' onclick=\"popup('login-popup')\">LOGIN</button>
            <button type='button' onclick=\"popup('register-popup')\">REGISTER</button>
        </div>
            ";
        }

        ?>
    </header>

    <?php 
    
    ?>

    <div class="popup-container" id="login-popup">
        <div class="popup">
            <form action="login_register.php" method="POST">
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset" onclick="popup('login-popup')"><i class="uil uil-sign-out-alt"></i></button>
                </h2>
                <input type="text" placeholder="Please Enter A Valid Email Or Username" name="email_username">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="login-btn" name="login">LOGIN</button>
            </form>
        </div>
    </div>


    <div class="popup-container" id="register-popup">
        <div class="register popup">
            <form action="login_register.php" method="POST">
                <h2>
                    <span>USER REGISTER</span>
                    <button type="reset" onclick="popup('register-popup')"><i class="uil uil-sign-out-alt"></i></button>
                </h2>
                <input type="text" placeholder="Full Name" name="full_name">
                <input type="text" placeholder="Username" name="username">
                <input type="text" placeholder="Please Enter A Valid Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="register-btn" name="register">REGISTER</button>

            </form>
 
        </div>

        
    </div>

    

    <?php

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
    {
      echo "<h1>Welcome $_SESSION[username]</h1>";
    }



     ?>

    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none";
            } else {
                get_popup.style.display = "flex";
            }
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>






</body>

</html>


