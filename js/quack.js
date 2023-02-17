var audio;
function quack() {
    if(!audio) {
        audio = new Audio("/audio/quack.mp3");
        audio.volume = .1;
    }
    audio.play();
}