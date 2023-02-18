function removePost(id) {
    let data = new FormData();
    data.append("id", id);
    fetch("/php/func/remove-post-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        if(window.location.href.includes("post.php")) {
            window.location = "/php/feed.php";
        } else {
            window.location = window.location;
        }
    });
}

function removeReply(id) {
    let data = new FormData();
    data.append("id", id);
    fetch("/php/func/remove-reply-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        window.location = window.location;
    });
}

function likePost(id) {
    let data = new FormData();
    data.append("id", id);
    fetch("/php/func/like-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        window.location = window.location;
    });
}

var fileEncoded = null;
function encodeFile() {
    let files = document.getElementById("file").files;
    if (files.length != 1) return;
    let reader = new FileReader();
    reader.readAsDataURL(files[0]);
    reader.onloadend = () => {
        fileEncoded = reader.result;
    }
}

function makePost() {
    let data = new FormData();
    data.append("content", document.getElementsByTagName("textarea")[0].value);
    let image = "";
    if (fileEncoded != null) image = fileEncoded;
    data.append("image", image);

    fetch("/php/func/post-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        window.location = window.location;
    });
}

function makeReply(id) {
    let data = new FormData();
    data.append("content", document.getElementsByTagName("textarea")[0].value);
    data.append("id", id);

    fetch("/php/func/reply-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        window.location = window.location;
    });
}