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
    <script src="/js/follow.js"></script>
    <script src="/js/quack.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/feed.css">
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
                            <form action="/php/search.php" method="post">
                                <input type="text" name="query" placeholder="Search">
                            </form>
                        </div>
                        <div id="search-bar-spacer"></div>
                        <?php $user = new User($_GET["id"]); ?>
                        <div id="profile" class="gradient-bg">
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editPicture()"; }?>"><img class="profile-picture" src="<?php echo $user->picture; ?>"></a>
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editName()"; }?>"><span><?php echo $user->name; ?></span></a>
                            <a href="<?php if($client_id == $user->id) { echo "javascript:editBio()"; }?>"><p title="Bio"><?php echo $user->bio; ?></p></a>
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
                        <ul id="posts">
                            <?php
                                foreach ($user->getPosts() as $post) {
                                    $stats = $post->getStats();
                            ?>
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