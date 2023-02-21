const zoom = document.getElementsByClassName("zoom")[0];

function zoomOut() {
    zoom.classList.add("hidden");
}

function zoomIn() {
    zoom.getElementsByTagName("img")[0].src = this.src;
    zoom.classList.remove("hidden");
}

function initZoom() {
    [...document.getElementsByClassName("embed")].forEach((e) => {
        e.onclick = zoomIn;
    });
    zoom.onclick = zoomOut;
}

initZoom();