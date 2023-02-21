var limit = 10;
var offset = 0;
var extra = "";

function parseParams() {
    let params = new URLSearchParams(window.location.search);
    if(params.has("offset")) offset = Number.parseInt(params.get("offset"));
    if(params.has("limit")) limit = Number.parseInt(params.get("limit"));
    if(params.has("query")) extra += `&query=${params.get("query")}`;
    if(params.has("id")) extra += `&id=${params.get("id")}`;
}

function start() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=0${extra}`;
}
function end() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=0${extra}`;
}
function prev() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=${Math.max(offset-limit, 0)}${extra}`;
}
function next() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=${offset+limit}${extra}`;
}

function hidePageSelectors() {
    let prev = false;
    let next = false;
    parseParams();
    if (document.querySelectorAll(".posts li").length==1) {
        document.querySelector('a[href="javascript:next()"]').style.display = "none";
        next = true;
    }
    if (offset == 0) {
        document.querySelector('a[href="javascript:prev()"]').style.display = "none";
        document.querySelector('a[href="javascript:start()"]').style.display = "none";
        prev = true;
    }
    if (prev&&next) {
        document.querySelector(".posts li").style.display = "none";
    }
}

hidePageSelectors();