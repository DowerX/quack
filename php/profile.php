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
    <script src="/js/edit.js"></script>
    <script src="/js/post.js"></script>
    <script src="/js/follow.js" defer></script>
    <script src="/js/select-page.js" defer></script>
    <script src="/js/zoom.js" defer></script>
    <script src="/js/mention.js" defer></script>
    <script src="/js/context-menu.js" defer></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/feed.css">
    <link rel="stylesheet" href="/css/zoom.css">
    <link rel="stylesheet" href="/css/context-menu.css">
    <link rel="stylesheet" media="print" href="/css/print.css">
    <title>Profile</title>
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
                                <li><a class="highlight preload current-item" href="/php/profile.php?id=<?php echo $client_id; ?>"><img class="invert" src="/img/contacts-96.png">Profile</a></li>
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
                        <?php $user = new User($_GET["id"]); ?>
                        <div id="profile" class="gradient-bg">
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editPicture()"; }?>"><img class="profile-picture" src="<?php echo $user->picture; ?>"></a>
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editName()"; }?>"><span title="@<?php echo htmlspecialchars($user->username);?>"><?php echo htmlspecialchars($user->name); ?></span></a>
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editBio()"; }?>"><p title="Bio"><?php echo htmlspecialchars($user->bio); ?></p></a>
                            <?php if ($user->id != $client_id) { ?>
                                <a class="highlight preload" href="javascript:follow(<?php echo $user->id; ?>)" title="Follow/unfollow user">
                                    <div id="follow-img" class="invert" <?php if ($user->isFollowedBy($client_id)) { ?> style="--follow-image: url('/img/checked-user-male-90.png')" <?php } else { ?> style="--follow-image: url('/img/add-user-male-90.png')" <?php } ?>>
                                    </div>
                                    Follow
                                </a>
                            <?php } ?>
                        </div>
                        <?php if ($user->id == $client_id) { ?>
                        <div id="new-post">
                            <form id="new-post-form" action="javascript:makePost()">
                                <textarea placeholder="Say something... [<500 characters]" name="content" form="new-post-form"></textarea>
                                <label for="file" class="highlight preload"><img src="/img/add-image-90.png" class="invert">Attach Image</label>
                                <input type="file" id="file" accept="image/jpg, image/jpeg, image/png">
                                <script>document.getElementById("file").addEventListener("change", encodeFile);</script>
                                <input type="submit" value="Send" class="highlight preload">
                            </form>
                        </div>
                        <?php } ?>
                        <ul class="posts">
                            <?php
                                $limit = getPostLimit();
                                $offset = 0;
                                if(array_key_exists("limit", $_GET)) {
                                    $limit = $_GET["limit"];
                                }
                                if(array_key_exists("offset", $_GET)) {
                                    $offset = $_GET["offset"];
                                }
                                foreach ($user->getPosts($limit, $offset) as $post) {
                                    $stats = $post->getStats();
                            ?>
                            <li>
                                <div data-postid="<?php echo $post->id; ?>" data-username="<?php echo htmlspecialchars($user->username); ?>">
                                    <a href="/php/profile.php?id=<?php echo $user->id; ?>">
                                        <img class="profile-picture" src="<?php echo $user->picture; ?>">
                                        <span title="@<?php echo htmlspecialchars($user->username);?>"><?php echo htmlspecialchars($user->name); ?></span>
                                    </a>
                                    <p><?php echo htmlspecialchars($post->content); ?></p>
                                    <?php if ($post->image!="") { ?><img class="embed" src="<?php echo $post->image; ?>"><?php } ?>
                                    <div class="interact">
                                        <a title="Likes" href="javascript:likePost(<?php echo $post->id; ?>)" class="highlight preload"><img class="invert <?php if ($post->isLikedBy($client_id)) { echo "liked"; } ?>" src="/img/love-96.png"><?php echo $stats["likes"]; ?></a>
                                        <a title="Replies" href="/php/post.php?id=<?php echo $post->id; ?>" class="highlight preload"><img class="invert" src="/img/reply96.png"><?php echo $stats["replies"]; ?></a>
                                        <?php if($user->id == $client_id) { ?><a title="Remove post" href="javascript:removePost(<?php echo $post->id; ?>)" class="highlight preload"><img class="invert" src="/img/close-90.png"></a><?php } ?>
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
    <div id="context-menu">
        <ul>
            <li id="copy-username"><a onclick="contextMenuCopy(copyUsername);">Copy Username</a></li>
            <li id="copy-postid"><a onclick="contextMenuCopy(copyPostId);">Copy PostID</a></li>
            <li id="share-post"><a onclick="contextMenuCopy(`${window.location.hostname}/php/post.php?id=${copyPostId}`);">Copy link to post</a></li>
            <li><a onclick="contextMenuClose();">Close Menu</a></li>
        </ul>
    </div>
</body>
</html>