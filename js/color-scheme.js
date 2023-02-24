const light = "/css/light-mode.css";
const dark = "/css/dark-mode.css";
const ls = window.localStorage;

initColorScheme();

function initColorScheme() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.id = "colorScheme";

    if (ls.getItem("darkMode") != "true" && ls.getItem("darkMode") != "false") {
        ls.setItem("darkMode", "false");
    }

    document.head.appendChild(link);

    applyColorScheme();
}

function applyColorScheme() {
    let link = document.getElementById("colorScheme");
    if (ls.getItem("darkMode") == "true") {
        link.href = dark;
    } else {
        link.href = light;
    }
}

function toggleColorScheme() {
    ls.setItem("darkMode", (!(ls.getItem("darkMode")=="true")).toString());
    console.log()
    applyColorScheme();
}