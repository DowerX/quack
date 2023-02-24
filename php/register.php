<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php"); ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/check-logged-out.php"); checkLoggedOut(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once($_SERVER["DOCUMENT_ROOT"]."/html/meta.html"); ?>
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
    <link rel="stylesheet" href="/css/outside.css">
    <title>Register</title>
</head>
<body>
    <nav>
        <menu>
            <li class="highlight preload"><a href="/php/login.php">Login</a></li>
            <li class="current-item highlight preload"><a href="/php/register.php">Register</a></li>
            <li class="highlight preload"><a href="/php/change-password.php">Change password</a></li>
            <li class="highlight preload"><a href="/html/about.html">About</a></li>
        </menu>
    </nav>
    <main>
        <div class="blur-bg"></div>
        <div id="menu-spacer"></div>
        <div id="login-box">
            <div class="highlight preload" onclick="quack()"><img class="invert" src="/img/duck90.png" alt="duck logo"></div>
            <div>Quack</div>
            <form action="javascript:register()" method="post">
                <input type="text" placeholder="Username [3-16, HU alphabet]" name="username">
                <input type="password" placeholder="Password [3-16]" name="password">
                <input type="password" placeholder="Repeat password" name="password-repeat">
                <input type="text" placeholder="Display Name [3-40]" name="name">
                <input type="text" placeholder="Bio [<500]" name="bio">
                <input class="highlight preload" type="reset" value="Reset">
                <input class="highlight preload" type="submit" value="Register">
            </form>
        </div>
        <div class="foreground reviews">
            <p>
                The <b>username</b> is used to login, identify and mention users. It must be between 3 and 16 characters long from the Hungarian alphabet. No special characters or spaces allowed.
            </p>
            <p>
                The <b>password</b> must be between 3 and 16 characters long. The two passwords must match.
            </p>
            <p>
                The <b>display name</b> is shown on posts and on user profiles. It must be between 3 and 40 characters long. The <b>bio</b> is a short description shown on the users profile. It must be shorter than 500 characters.
            </p>
        </div>
    </main>
    <footer></footer>
</body>
</html>