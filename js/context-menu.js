const contextMenu = document.getElementById("context-menu");

var copyUsername = "";
var copyPostId = "";

function contextMenuOpen(e) {
    e.preventDefault();
    contextMenu.style = `--pos-x: ${e.clientX}px; --pos-y: ${e.clientY}px; display: block !important;`;
    document.getElementById("copy-username").style.display = "none";
    document.getElementById("copy-postid").style.display = "none";
    document.getElementById("share-post").style.display = "none";
    
    if (e.target.dataset.username) {
        copyUsername = e.target.dataset.username;
        document.getElementById("copy-username").style.display = "list-item";
    }

    if (e.target.dataset.postid) {
        copyPostId = e.target.dataset.postid;
        document.getElementById("copy-postid").style.display = "list-item";
        document.getElementById("share-post").style.display = "list-item";
    }
}

function contextMenuCopy(text) {
    if(text!=undefined) {
        navigator.clipboard.writeText(text);
    }
    contextMenuClose();
}

function contextMenuClose () {
    contextMenu.style.display = 'none';
    return false;
}

document.querySelectorAll("[data-username]").forEach((e) => {
    e.oncontextmenu = contextMenuOpen;
});