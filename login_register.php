<?php

require('connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'azhan4451@gmail.com';                     //SMTP username
        $mail->Password   = '1234_5678';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


        $mail->setFrom('azhan4451@gmail.com', 'E-STORE');
        $mail->addAddress($email);


        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification For E-STORE';
        $mail->Body    = "thanks for registration To E-STORE Please click the link below to verify the email address
        <a href='http://localhost/login/verify.php?email=$email&v_code=$v_code'>Verify</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}



if (isset($_POST['login'])) {
    $query = "SELECT * FROM `registered_users` WHERE  `email` = '$_POST[email_username]' OR `username` = '$_POST[email_username]'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['is_verified'] == 1) {
                if (password_verify($_POST['password'], $result_fetch['password'])) 
                {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $result_fetch['username'];
                    header("location: index.php");
                }
                else 
                {
                 echo "
                <script>
                alert('Incorrect Password');
                window.location.href = 'index.php';
                </script>
                "; 
                }
            }
            else{
                echo "9
                <script>
                alert('Email  Not Verified');
                window.location.href = 'index.php';
                </script>
                ";
            }
        
        } else {
            echo "9
        <script>
        alert('Email Or Username Not Registered');
        window.location.href = 'index.php';
        </script>
        ";
        }
    } else {
        echo "9
        <script>
        alert('Cannot Run Query');
        window.location.href = 'index.php';
        </script>
        ";
    }
}







if (isset($_POST['register'])) {
    $user_exist_query = "SELECT * FROM `registered_users` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";

    $result = mysqli_query($con, $user_exist_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['username'] == $_POST['username']) {
                echo "9
                <script>
                alert('$result_fetch[username] - Username Already Taken');
                window.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "9
                <script>
                alert('$result_fetch[email] - Email Already Taken');
                window.location.href = 'index.php';
                </script>
                ";
            }
        } else {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $v_code = bin2hex(random_bytes(16));
            $query = "INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`,`verification_code`, `is_verified`) VALUES ('$_POST[full_name]','$_POST[username]','$_POST[email]','$password', '$v_code', '0')";

            if (mysqli_query($con, $query) && sendMail($_POST['email'], $v_code)) {
                echo "9
            <script>
            alert('Registration Succesful');
            window.location.href = 'index.php';
            </script>
            ";
            } else {
                echo "9
            <script>
            alert('Server Down');
            window.location.href = 'index.php';
            </script>
            ";
            }
        }
    } else {
        echo "9
        <script>
        alert('Cannot Run Query');
        window.location.href = 'index.php';
        </script>
        ";
    }
}
