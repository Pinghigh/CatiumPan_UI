<?php
include('db.php');

function generate_uuid($arg = '')
{
    $timestamp = microtime();
    $uuid = md5($timestamp . $arg);
    return $uuid;
}

function register($user_name, $user_password, $user_email)
{
    if (empty(exec_sql("SELECT * FROM `CatiumPan`.`users` WHERE user_name = '$user_name'; "))) {
        $user_uuid = generate_uuid($user_name . '/' . $user_email);
        $user_password_md5 = md5($user_password);
        $sql = 'INSERT INTO `CatiumPan`.`users`(`user_name`,`user_email`,`user_password_md5`,`user_uuid`) ' .
            "VALUES('$user_name','$user_email','$user_password_md5','$user_uuid'); ";
        if (is_array(exec_sql($sql))) {
            setcookie('uuid', $user_uuid);
            header("Location: /");
        } else {
            ?>
            <p>failed</p>
            <script type="text/javascript">
                alert('register unsucessful: sql insertion failed.');
            </script>
        <?php
        }
    } else {
        ?>
        <p>failed</p>
        <script type="text/javascript">
            alert('register unsucessful: user_name is not unique.');
        </script>
    <?php
    }
}

if (!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    register($user_name, $user_password, $user_email);
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>CatiumPan - Register</title>
        <!-- fluent by YidaozhanYa -->
        <link rel="stylesheet" href="./css/fluent-constants.css" />
        <link rel="stylesheet" href="./css/fluent-button.css" />
        <link rel="stylesheet" href="./css/fluent-textarea.css" />
        <!-- default -->
        <link rel="stylesheet" href="./css/default.css" />
    </head>

    <body class="bg">
        <div class="card">
            <form style="margin:auto auto; display: table; width: auto;" action="register.php" method="post">
                <h1>CatiumPan</h1><br>

                <!-- input -->
                <span class="fluent-textarea-outer" style="margin:auto auto;">
                    <input required="required" type="email" class="fluent-textarea" placeholder="邮箱" name="user_email">
                </span><br><br>
                <span class="fluent-textarea-outer" style="margin:auto auto;">
                    <input required="required" type="text" class="fluent-textarea" placeholder="用户名" name="user_name">
                </span><br><br>
                <span class="fluent-textarea-outer" style="margin:auto auto;">
                    <input required="required" type="password" class="fluent-textarea" placeholder="密码" name="user_password">
                </span><br><br>

                <!-- buttons -->
                <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                    <input type="submit" class="fluent-button fluent-button-primary" style="margin: 0 auto" value="注册">
                    <input type="button" onclick="self.location=document.referrer;" style="float: right; margin: 0 auto"
                        class="fluent-button fluent-button-secondary" value="返回">
                </div>
            </form>
        </div>
    </body>

    </html>
<?php
}
?>