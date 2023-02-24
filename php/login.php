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
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/outside.css">
    <title>Login</title>
</head>
<body>
    <nav>
        <menu>
            <li class="current-item highlight preload"><a href="/php/login.php">Login</a></li>
            <li class="highlight preload"><a href="/php/register.php">Register</a></li>
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
            <form action="/php/func/login-action.php" method="post">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <input class="highlight preload" type="submit" value="Login">
            </form>
        </div>
        <div class="foreground reviews">
            <p>
                "Quack is a great platform for sharing photos and connecting with like-minded people. I love the easy-to-use interface and the ability to follow other users and see their posts in my feed. The only downside is that sometimes the app can be a bit slow to load, but overall I'm very happy with my experience on Quack!" - 4 stars
            </p>
            <p>
                "I've been using Quack for a few months now and I'm really enjoying it. It's a fun way to share photos and get inspired by other users' posts. I love that I can like and comment on other users' posts and that they can do the same for me. The only thing I wish was different is that there were more editing options for photos, but other than that, it's a great app!" - 4 stars
            </p>
            <p>
                "I've had a great experience with Quack so far. It's easy to use and I love being able to share my photos and get feedback from other users. The only issue I've had is that sometimes the app can be glitchy and freeze up, but it's not a major problem. Overall, I would definitely recommend Quack to anyone looking for a fun and easy way to share photos and connect with others!" - 4 stars
            </p>
        </div>
    </main>
    <footer></footer>
</body>
</html>