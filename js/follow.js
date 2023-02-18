function follow(id) {
    let data = new FormData();
    data.append("id", id);

    fetch("/php/func/follow-action.php",
        {
            method: "POST",
            body: data
        }
    ).then(()=>{
        window.location = window.location;
    });
}