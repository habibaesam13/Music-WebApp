var audioPlayer = document.getElementById("audioPlayer");
var playButton = document.getElementById("playButton");
var pauseButton = document.getElementById("pauseButton");
var seekSlider = document.getElementById("seekSlider");
const timer = document.getElementById('timer');

playButton.addEventListener("click", function () {
    audioPlayer.play();
    playButton.style.display = "none";
    pauseButton.style.display = "inline-block";
});

pauseButton.addEventListener("click", function () {
    audioPlayer.pause();
    pauseButton.style.display = "none";
    playButton.style.display = "inline-block";
});


audioPlayer.addEventListener('timeupdate', function () {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    seekSlider.value = progress;

    // Update the timer
    const currentTime = formatTime(audioPlayer.currentTime);
    const duration = formatTime(audioPlayer.duration);
    timer.textContent = `${currentTime} / ${duration}`;
});

seekSlider.addEventListener('input', function () {
    const seekTime = (seekSlider.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
});

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}
