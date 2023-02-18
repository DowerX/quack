var filePicker = null;

function editPicture() {
    if (filePicker == null) {
        filePicker = document.createElement("input");
        filePicker.setAttribute("type", "file");
        filePicker.setAttribute("accept", "image/jpg, image/jpeg, image/png");
        filePicker.setAttribute("display", "none");
        document.body.appendChild(filePicker);
        filePicker.addEventListener("change", ()=>{
            let files = filePicker.files;
            if (files.length != 1) return;
            let reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = () => {
                console.log("Processed image.")
                let data = new FormData();
                data.append("picture", reader.result);
            
                fetch("/php/func/edit-action.php",
                    {
                        method: "POST",
                        body: data
                    }
                ).then((r)=>{
                    r.text().then((resp) => {
                        if (resp != "") {
                            alert(resp);
                        } else {
                            window.location = window.location;
                        }
                    });
                });
            }
        }); 
    }
    filePicker.click();
}

function editName() {
    let name = window.prompt("New name:", "");

    if (name) {
        let data = new FormData();
        data.append("name", name);
        fetch("/php/func/edit-action.php",
        {
            method: "POST",
            body: data
        }).then((r)=>{
            r.text().then((resp) => {
                if (resp != "") {
                    alert(resp);
                } else {
                    window.location = window.location;
                }
            })
        });
    }
}

function editBio() {
    let bio = window.prompt("New bio:", "");

    if (bio) {
        let data = new FormData();
        data.append("bio", bio);
        fetch("/php/func/edit-action.php",
        {
            method: "POST",
            body: data
        }
        ).then((r)=>{
            r.text().then((resp) => {
                if (resp != "") {
                    alert(resp);
                } else {
                    window.location = window.location;
                }
            })
        });
    }
}