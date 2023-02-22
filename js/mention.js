function replaceMentions(text) {
    const user = /@(\w+)/;
    const post = /#([0-9]+)/;
    text = text.replace(user, '<a href="/php/api/redirect-username.php?username=$1" class="mention">@$1</a>');
    return text.replace(post, '<a href="/php/post.php?id=$1" class="mention">#$1</a>');
}

document.querySelectorAll(".posts p").forEach((e) => {
    e.innerHTML = replaceMentions(e.innerHTML);
});