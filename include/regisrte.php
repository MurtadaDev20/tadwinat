<!-- <?php
// include 'inc/header.php'
?>


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

        <form method="POST">

            <h5> Register</h5>
            <?php
            // login_system();
            // display_message();
            ?>
            <div class="form-group">
                <label for="username">Uername</label>
                <input type="text " class="form-control mt-3 mb-3" id="username" name="username" />
            </div>
            <div class="form-group">
                <label for="username">Email</label>
                <input type="text " class="form-control mt-3 mb-3" id="username" name="username" />
            </div>
            <div class="form-group">
                <label for="pass"> Password</label>
                <input type="password" class="form-control mt-3" id="pass" name="password" />
            </div>
            <div class="form-group">
                <label for="pass"> Confirm Password</label>
                <input type="password" class="form-control mt-3" id="pass" name="password" />
            </div>
            <button class="btn-custom mt-3 display-inline-block" name="btn_login"> Sign UP</button>
            <a href='index.php'>Login</a>
        </form>
    </div>

    <?php
    // include 'inc/footer.php'
    ?> -->