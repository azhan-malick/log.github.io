<?php

require("connection.php");

if(isset($_GET['email']) && isset($_GET['v_code']))
 {
     $query = "SELECT * FROM `registered_users` WHERE `email`='$_GET[email]' AND `verification_code`= '$_GET[v_code]'";
     $result = mysqli_query($con,$query);
     if($result)
     {
         if(mysqli_num_rows($result)==1)
         {
             $result_fetch = mysqli_fetch_assoc($result);
             if($result_fetch['is_verified']==0)
             {
                $update = "UPDATE `registered_users` SET `is_verified`= '1' WHERE `email`='$result_fetch[email]'";
                if(mysqli_query($con, $update))
                {
                    echo "9
                    <script>
                    alert('Verification Sucessful');
                    window.location.href = 'index.php';
                    </script>
                    "; 
                }
                else{
                    echo "9
                    <script>
                    alert('Email With Name Has Already Registered');
                    window.location.href = 'index.php';
                    </script>
                    ";
                }
             }
             else{
                echo "9
                <script>
                alert('Email With Name Has Already Registered');
                window.location.href = 'index.php';
                </script>
                ";
             }
         }
     }
     else{
        echo "9
        <script>
        alert('cannot run query');
        window.location.href = 'index.php';
        </script>
        ";
     }
 }

?>