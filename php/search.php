<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/check-logged-in.php"); checkLoggedIn(); ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"]."/php/func/util.php"); $client_id = getClientID(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/duck90.png">
    <script src="/js/color-scheme.js"></script>
    <script src="/js/animation-preload.js"></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/feed.css">
    <link rel="stylesheet" media="print" href="/css/print.css">
    <title>Search</title>
</head>
<body>
    <main>
        <table class="gradient-bg">
            <tbody>
                <tr>
                    <td id="side-bar">
                        <nav>
                            <a class="highlight preload" href="javascript:quack()"><img class="invert" src="/img/duck90.png" alt="duck logo"></a>
                                <ul>
                                    <li><a class="highlight preload" href="/php/feed.php"><img class="invert" src="/img/hashtag-large-96.png">Feed</a></li>
                                    <li><a class="highlight preload" href="/php/profile.php?id=<?php echo $client_id; ?>"><img class="invert" src="/img/contacts-96.png">Profile</a></li>
                                    <li><a class="highlight preload" href="javascript:history.back()"><img class="invert" src="/img/undo-90.png">Back</a></li>
                                    <li><a class="highlight preload" href="/php/func/logout-action.php"><img class="invert" src="/img/open-pane-96.png">Log Out</a></li>
                                    <li><a class="highlight preload" href="javascript:toggleColorScheme()"><img class="invert" src="/img/sun-96.png">Dark Mode</a></li>
                                </ul>
                        </nav>
                    </td>
                    <td id="main-area">
                        <div id="search-bar">
                            <form action="/php/search.php" method="post">
                                <input type="text" name="query" placeholder="Search">
                            </form>
                        </div>
                        <div id="search-bar-spacer"></div>
                        <ul class="posts">
                            <?php
                                $db = getDB();
                                $stm = $db->prepare("SELECT user_id FROM user WHERE name LIKE :query");
                                $stm->bindValue("query", "%".$_POST["query"]."%");
                                $result = $stm->execute();
                                while($values = $result->fetchArray(SQLITE3_ASSOC)) {
                                    $user = new User($values["user_id"]);
                            ?>
                            <li>
                                <div>
                                    <a href="/php/profile.php?id=<?php echo $user->id; ?>">
                                        <img class="profile-picture" src="<?php echo $user->picture; ?>">
                                        <span><?php echo $user->name; ?></span>
                                    </a>
                                    <p title="Bio"><?php echo $user->bio; ?></p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer></footer>
</body>
</html>