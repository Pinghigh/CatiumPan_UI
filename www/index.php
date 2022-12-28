<!DOCTYPE html>
<html>

<head>
    <title>CatiumPan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- fluent by YidaozhanYa -->
    <link rel="stylesheet" href="./css/fluent-constants.css" />
    <link rel="stylesheet" href="./css/fluent-button.css" />
    <link rel="stylesheet" href="./css/fluent-textarea.css" />
    <!-- default -->
    <link rel="stylesheet" href="./css/default.css" />
    <style type="text/css" media="all">
        .hrLine {
            vertical-align: middle;
            display: inline-block;
        }
    </style>
</head>
</head>

<body class=bg>


    <!-- 下载文件不需要身份验证 -->
    <div class=card>

        <!-- download -->
        <form action="download.php" method="get" style="margin:auto auto; display: table; width: auto;"
            enctype="multipart/form-data">
            <h1>CatiumPan</h1><br>

            <!-- input code -->
            <span class="fluent-textarea-outer" style="margin:auto auto;">
                <input required="required" type="number" class="fluent-textarea" placeholder="取件码" name="file_id">
            </span> <br><br>
            <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                <input type="submit" class="fluent-button fluent-button-primary" style="margin: 0 auto" name="submit"
                    value="下载">
            </div>
        </form>
        <br>

        <!-- line -->
        <div style=" width:100%; font-size: 23px; text-align:center; font-family: Righteous; margin: auto auto">
            <hr class="hrLine" style="width:40%;" /> or
            <hr class="hrLine" style="width:40%;" />
        </div>
        <br>

        <?php

        include('auth.php');

        if (is_logined()) {
            ?>
            <!-- logout -->
            <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                <input type="button" onclick="document.cookie='uuid=null';location.reload();" class="fluent-button fluent-button-primary"
                    style="margin: 0 auto" value="注销">
            </div>

            <!-- upload -->
            <form action="upload.php" method="post" enctype="multipart/form-data" style="margin:auto auto; display: table; width: auto;">
                <br>

                <!-- num -->
                <span class="fluent-textarea-outer" style="margin:auto auto">
                    <input type="number" class="fluent-textarea" placeholder="限制下载次数" name="file_max_download_count"
                        value="1">
                </span> <br><br>

                <!-- buttons -->
                <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                    <input type="button" onclick="upload.click()" style="float: left; margin: 0 auto"
                        class="fluent-button fluent-button-secondary" value="选择文件">
                    <input type="file" name="upload" id="upload" style="display: none;" />
                    <input type="submit" class="fluent-button fluent-button-primary" style="float: right; margin: 0 auto"
                        value="生成分享">
                </div>
            </form>


            <?php
        } else {
            // header("Location: /login.php");
            ?>
            <!-- login / register -->
            <form action="upload.php" method="post" enctype="multipart/form-data" style="margin:auto auto; display: table; width: auto;">
                <div style="margin: auto auto; display: flex; flex-direction: row; justify-content: space-between">
                    <input type="button" onclick="window.location='/login.php'" style="float: left; margin: 0 auto"
                        class="fluent-button fluent-button-primary" value="登录">
                    &nbsp;
                    <input type="button" onclick="window.location='/register.php'" style="float: right; margin: 0 auto"
                        class="fluent-button fluent-button-secondary" value="注册">
                </div>
            </form>
            <?php
        }
        ?>
    </div>
</body>
</html>