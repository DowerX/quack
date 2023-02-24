function getStats() {
    fetch("/php/api/stats.php").then((r)=>{
        r.json().then((d)=> {
            for (const [key, value] of Object.entries(d)) {
                document.getElementById(key).textContent = value;
            }
        });
    });
}

getStats();
setInterval(getStats, 60000);