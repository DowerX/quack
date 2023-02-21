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
    <script src="/js/post.js"></script>
    <script src="/js/select-page.js" defer></script>
    <script src="/js/zoom.js" defer></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/feed.css">
    <link rel="stylesheet" href="/css/zoom.css">
    <link rel="stylesheet" media="print" href="/css/print.css">
    <title>Post</title>
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
                            <form action="/php/search.php" method="get">
                                <input type="text" name="query" placeholder="Search">
                            </form>
                        </div>
                        <div id="search-bar-spacer"></div>
                        <?php
                            $post = new Post($_GET["id"]);
                            $stats = $post->getStats();
                            $user = $post->getUser();
                            $limit = getPostLimit();
                            $offset = 0;
                            if(array_key_exists("limit", $_GET)) {
                                $limit = $_GET["limit"];
                            }
                            if(array_key_exists("offset", $_GET)) {
                                $offset = $_GET["offset"];
                            }
                            $replies = $post->getReplies($limit, $offset);
                        ?>
                        <ul class="posts gradient-bg">
                            <li>
                                <div>
                                    <a href="/php/profile.php?id=<?php echo $user->id; ?>">
                                        <img class="profile-picture" src="<?php echo $user->picture; ?>">
                                        <span><?php echo $user->name; ?></span>
                                    </a>
                                    <p><?php echo $post->content; ?></p>
                                    <?php if ($post->image!="") { ?><img class="embed" src="<?php echo $post->image; ?>"><?php } ?>
                                    <div class="interact">
                                        <a title="Likes" href="javascript:likePost(<?php echo $post->id; ?>)" class="highlight preload"><img class="invert <?php if ($post->isLikedBy($client_id)) { echo "liked"; } ?>" src="/img/love-96.png"><?php echo $stats["likes"]; ?></a>
                                        <a title="Replies" href="/php/post.php?id=<?php echo $post->id; ?>" class="highlight preload"><img class="invert" src="/img/reply96.png"><?php echo $stats["replies"]; ?></a>
                                        <?php if($user->id == $client_id) { ?><a title="Remove post" href="javascript:removePost(<?php echo $post->id; ?>)" class="highlight preload"><img class="invert" src="/img/close-90.png"></a><?php } ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div id="new-post">
                            <form id="new-post-form" action="javascript:makeReply(<?php echo $post->id; ?>)">
                                <textarea placeholder="Say something... [1-500 characters]" name="content" form="new-post-form"></textarea>
                                <input type="submit" value="Send" class="highlight preload">
                            </form>
                        </div>
                        <ul class="posts">
                            <?php foreach($replies as $reply) {
                                $reply_user = $reply->getUser();
                            ?>
                            <li>
                                <div>
                                    <a href="/php/profile.php?id=<?php echo $reply->user_id; ?>">
                                        <img class="profile-picture" src="<?php echo $reply_user->picture; ?>">
                                        <span><?php echo $reply_user->name; ?></span>
                                    </a>
                                    <p><?php echo $reply->content; ?></p>
                                    <div class="interact">
                                        <?php if ($reply->user_id == $client_id ) { ?><a title="Remove reply" href="javascript:removeReply(<?php echo $reply->id; ?>)" class="highlight preload"><img class="invert" src="/img/close-90.png"></a><?php } ?>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                            <li>
                                <div id="select-page">
                                    <a class="highlight preload" href="javascript:start()"><img class="invert" src="/img/rewind-90.png"></a><a class="highlight preload" href="javascript:prev()"><img class="invert" src="/img/sort-left-90.png"></a>
                                    <a class="highlight preload" href="javascript:next()"><img class="invert" src="/img/sort-right-90.png"></a><a style="display: none" class="highlight preload" href="javascript:end()"><img class="invert" src="/img/fast-forward-90.png"></a>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer></footer>
    <div class="zoom hidden preload">
        <img id="og">
        <div id="cz" class="fade">
            <img id="cz-img">
        </div>
    </div>
</body>
</html>