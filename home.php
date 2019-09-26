<?php
    session_start();
    if(empty($_SESSION["type"])){
        echo '/401 Unauthorized';
    }else{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/src.ed250a2d.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <title>Home</title>
    </head>
    <body>
        <div class="container-p">
            <div class="header-p">
                <img src="img/avatar.png">
                <h1>Welcome <?php echo $_SESSION["user"]; ?></h1>
            </div>
            <a href="connect.php?log=1" class="logout">Logout</a>
            <div class="content-p">
                <div class="img">
                    <img src="img/img.svg">
                </div>
            </div>
        </div>
        <script src="./js/src.a7ee34a4.js"></script>
    </body>
    </html>
    <?php }
?>