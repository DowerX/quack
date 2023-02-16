setTimeout(()=>{
    [...document.getElementsByClassName("preload")].forEach(e => {
        e.classList.remove("preload");
    });
}, 301);