<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php"); ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/check-logged-out.php"); checkLoggedOut(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/duck90.png">
    <script src="/js/color-scheme.js"></script>
    <script src="/js/animation-preload.js"></script>
    <script src="/js/mouse-pointer.js" defer></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="blur-bg"></div>
        <div id="login-box">
            <div class="highlight preload" onclick="quack()"><img class="invert" src="/img/duck90.png" alt="duck logo"></div>
            <div>Quack</div>
            <form action="/php/func/login-action.php" method="post">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <input class="highlight preload" type="submit" value="Login">
            </form>
            <a id="register" href="/php/register.php">Register</a>
        </div>
    </main>
    <footer></footer>
</body>
</html>