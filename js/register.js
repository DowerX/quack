function register() {
    fetch("/php/func/register-action.php", {
        method: "POST",
        body: new FormData(document.getElementsByTagName("form")[0]),
    }).then((r)=>{
        r.text().then((resp) => {
            if (resp != "") {
                alert(resp);
            } else {
                window.location = "/php/login.php";
            }
        });
    });
}
function changePassword() {
    fetch("/php/func/change-password-action.php", {
        method: "POST",
        body: new FormData(document.getElementsByTagName("form")[0]),
    }).then((r)=>{
        r.text().then((resp) => {
            if (resp != "") {
                alert(resp);
            } else {
                window.location = "/php/login.php";
            }
        });
    });
}