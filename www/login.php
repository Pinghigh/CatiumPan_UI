<?php
include('auth.php');

if (!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_password_md5 = md5($user_password);
    if (!auth_user_name_password_md5($user_name, $user_password_md5)) {
        ?>
        <script type="text/javascript">
            alert('login unsucessful.');
            location.replace(location.href)
        </script>
    <?php
    } else {
        header("Location: /");
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>CatiumPan - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- fluent by YidaozhanYa -->
        <link rel="stylesheet" href="./css/fluent-constants.css" />
        <link rel="stylesheet" href="./css/fluent-button.css" />
        <link rel="stylesheet" href="./css/fluent-textarea.css" />
        <!-- default -->
        <link rel="stylesheet" href="./css/default.css" />
    </head>

    <body class="bg">
        <div class="card" style="margin:10% auto; width:15%;">
            <form style="margin:auto auto; display: table; width: auto;" action="login.php" method="post">
                <h1 style="margin:auto 8%; font-family: Righteous">CatiumPan</h1><br>

                <!-- input -->
                <span class="fluent-textarea-outer" style="margin:auto auto;">
                    <input required="required" type="text" class="fluent-textarea" placeholder="用户名" name="user_name">
                </span> <br><br>
                <span class="fluent-textarea-outer" style="margin:auto auto;">
                    <input required="required" type="password" class="fluent-textarea" placeholder="密码" name="user_password">
                </span> <br><br>
                
                <!-- 2 buttons -->
                <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                    <input type="submit" class="fluent-button fluent-button-primary" style="float: left; margin: 0 auto" value="登录">
                    <input type="button" onclick="window.location='/register.php'" style="float: right; margin: 0 auto"
                        class="fluent-button fluent-button-secondary" value="注册">
                </div>
            </form>
        </div>
    </body>

    </html>

<?php
}
?>