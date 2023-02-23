function initMousePointer() {
    const pointer = document.createElement("div");
    pointer.id = "pointer";
    document.body.appendChild(pointer);

    const main = document.getElementsByTagName("main")[0];
    const login = document.getElementById("login-box");

    document.onmousemove = (e) => {
        var mainRect = main.getBoundingClientRect();
        pointer.style =  `--pos-x: ${e.clientX}px; --pos-y: ${e.clientY}px`;
        main.style =  `--pos-x: ${e.clientX}px; --pos-y: ${e.clientY}px`;
    }
}

initMousePointer();