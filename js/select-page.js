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