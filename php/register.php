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
    <script src="/js/register.js" defer></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <title>Register</title>
</head>
<body>
    <main>
        <div class="blur-bg"></div>
        <div id="login-box" style="--login-box-height: 570px !important">
            <div class="highlight preload" onclick="quack()"><img class="invert" src="/img/duck90.png" alt="duck logo"></div>
            <div>Quack</div>
            <form action="javascript:register()" method="post">
                <input type="text" placeholder="Username [3-16 characters]" name="username">
                <input type="password" placeholder="Password [3-16 characters]" name="password">
                <input type="password" placeholder="Repeat password" name="password-repeat">
                <input type="text" placeholder="Display Name [3-40 characters]" name="name">
                <input type="text" placeholder="Bio [3-500 characters]" name="bio">
                <input class="highlight preload" type="submit" value="Register">
            </form>
        </div>
    </main>
    <footer></footer>
</body>
</html>