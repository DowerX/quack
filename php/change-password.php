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
    <title>Change Password</title>
</head>
<body>
    <main>
        <div class="blur-bg"></div>
        <div id="login-box">
            <div class="highlight preload" onclick="quack()"><img class="invert" src="/img/duck90.png" alt="duck logo"></div>
            <div>Quack</div>
            <form action="javascript:changePassword()" method="post">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Old password" name="old-password">
                <input type="password" placeholder="New password [3-16]" name="new-password">
                <input type="password" placeholder="Repeat password" name="password-repeat">
                <input class="highlight preload" type="reset" value="Reset">
                <input class="highlight preload" type="submit" value="Change password">
            </form>
        </div>
    </main>
    <footer></footer>
</body>
</html>