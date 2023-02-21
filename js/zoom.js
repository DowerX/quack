const zoom = document.getElementsByClassName("zoom")[0];
const og = document.getElementById("og");
const cz = document.getElementById("cz");
const czImg = document.getElementById("cz-img");

function zoomOut() {
    zoom.classList.add("hidden");
    cz.classList.add("fade");
}

function zoomIn() {
    zoom.getElementsByTagName("img")[0].src = this.src;
    czImg.src = this.src;
    zoom.classList.remove("hidden");
    cz.classList.remove("fade");
}

function initZoom() {
    [...document.getElementsByClassName("embed")].forEach((e) => {
        e.onclick = zoomIn;
    });
    zoom.onclick = zoomOut;

    zoom.onmousemove = (e) => {
        let ogRect = og.getBoundingClientRect();
        let czRect = cz.getBoundingClientRect();
        cz.style = `--pos-x: ${e.clientX}px; --pos-y: ${e.clientY}px;`;
        czImg.style = `--pos-x-rel: ${e.clientX-ogRect.left}px; --pos-y-rel: ${e.clientY-ogRect.top}px; --p-x: ${czRect.left}px; --p-y: ${czRect.top}px; --og-x: ${ogRect.left}px; --og-y: ${ogRect.top}px; --og-w: ${ogRect.width}px; --og-h: ${ogRect.height}px;`;
    }
}

initZoom();