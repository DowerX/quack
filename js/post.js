function removePost(id) {
    if(confirm("Are you sure you want to remove this post?")) {
        console.log("TODO: remove post");
    }
    window.location = window.location;
}

function removeReply(id) {
    if(confirm("Are you sure you want to remove this relpy?")) {
        console.log("TODO: remove reply");
    }
    window.location = window.location;
}

function likePost(id) {
    console.log("TODO: like post");
    window.location = window.location;
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
    console.log("TODO: make post");
    window.location = window.location;
}

function makeReply() {
    console.log("TODO: make reply");
    window.location = window.location;
}