function initMousePointer() {
    var pointer = document.createElement("div");
    pointer.id = "pointer";
    document.body.appendChild(pointer);

    document.onmousemove = (e) => {
        pointer.style =  `--pos-x: ${e.clientX}px; --pos-y: ${e.clientY}px`;
    }
}

initMousePointer();