var limit = 10;
var offset = 0;

function parseParams() {
    let params = new URLSearchParams(window.location.search);
    if(params.has("offset")) offset = Number.parseInt(params.get("offset"));
    if(params.has("limit")) limit = Number.parseInt(params.get("limit"));
}

function id() {
    let params = new URLSearchParams(window.location.search);
    if(params.has("id")) return `&id=${params.get("id")}`;
    return "";
}

function start() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=0${id()}`;
}
function end() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=0${id()}`;
}
function prev() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=${Math.max(offset-limit, 0)}${id()}`;
}
function next() {
    parseParams();
    window.location = `${window.location.pathname}?limit=${limit}&offset=${offset+limit}${id()}`;
}