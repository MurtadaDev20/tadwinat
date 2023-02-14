<?php
session_start();
include '../include/connection.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <!-- Google Fonts Almarai-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&family=Cairo:wght@200;400;500;600;700&family=Open+Sans:wght@300;400;700&family=Tajawal:wght@200;300&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- font awsome -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/dashboard.css">

    <style>
        .login {
            width: 300px;
            margin: 80px auto;
        }

        .login h5 {
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        .login button {
            margin-right: 80px;
        }
    </style>
</head>

<body>

    <div class="login">
        <?php
        if (isset($_POST['log'])) {

            $adminMail = $_POST['email'];
            $adminpass = $_POST['password'];
            $login = $_POST['log'];

            if (empty($adminMail) || empty($adminpass)) {
                echo "<div class =' alert alert-danger'>" . "الرجاء ادخال كلمة السر والبريد الالكتروني" . "</div>";
            } 
            else {
                $query = "SELECT * FROM admin WHERE email = '$adminMail'";
                $res = mysqli_query($conn , $query);
                // $row = mysqli_fetch_assoc($res);
                $row = mysqli_fetch_assoc($res);
                if($row){

                    if (password_verify($adminpass, $row['password'])){

                        if ($row) {
                            echo "<div class =' alert alert-success'>" . "مرحبا سيتم تحويلك الى لوحة التحكم" . "</div>";

                            $_SESSION['id'] = $row['id'];
                            header('REFRESH:2;URL=catefories.php');
                        } else {
                            echo "<div class =' alert alert-success'>" . "البيانات غير متطابقة" . "</div>";
                        }
                    }
                    else
                    {
                        echo "<div class =' alert alert-danger'>" . "خطا في كلمة المرور" . "</div>";
                    }
                }
                else
                {
                    echo "<div class =' alert alert-danger'>" . "خطا في الايميل" . "</div>";
                }
            }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <h5>تسجيل الدخول</h5>
            <div class="form-group">
                <label for="mail">البريد الالكتروني</label>
                <input type="text " class="form-control mt-3 mb-3" id="mail" name="email" />
            </div>
            <div class="form-group">
                <label for="pass"> كلمة السر</label>
                <input type="password" class="form-control mt-3" id="pass" name="password" />
            </div>
            <button class="btn-custom mt-3" name="log">تسجيل الدخول</button>
        </form>
    </div>

    <?php

    include '../include/footer.php'

    ?>