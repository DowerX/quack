setTimeout(()=>{
    [...document.getElementsByClassName("preload")].forEach(e => {
        console.log(e);
        e.classList.remove("preload");
    });
}, 301);