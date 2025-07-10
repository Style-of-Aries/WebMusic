let songs = [];

fetch("../api/getSongs.php") // đường dẫn phù hợp với vị trí file JS của bạn
    .then(res => res.json())
    // .then(data => {
    //     songs = data;
    //     console.log("Danh sách bài hát:", songs);
    //     vitribai = 0; 
    //     khoitaoSong(vitribai); 
    // })
    .then(data => {
        songs = data;
        console.log("Danh sách bài hát:", songs);
        // vitribai = null;
        // khoitaoSong(vitribai);
        
        document.querySelectorAll(".song-table tbody tr").forEach(row => {
            row.addEventListener("click", function () {
                const index = parseInt(this.getAttribute("data-index"));
                console.log("Vị trí bài hát:", index);
                console.log("File bài hát:", songs[index].fileSong);
                if (isNaN(index)) return;

                if (vitribai === index) {
                    playPause();
                    const icon = this.querySelector(".icon-overlay i");
                    if (icon) icon.className = isPlaying ? "fa-solid fa-play" : "fa-solid fa-pause";
                } else {
                    vitribai = index;
                    isPlaying = true;
                    khoitaoSong(vitribai);
                    playPause();
                    document.querySelectorAll(".song-table tbody tr").forEach(r => r.classList.remove("active"));
                    this.classList.add("active");
                    document.querySelectorAll(".icon-overlay i").forEach(icon => icon.className = "fa-solid fa-play");
                    const icon = this.querySelector(".icon-overlay i");
                    if (icon) icon.className = "fa-solid fa-pause";
                }
            });
        });

    })


    .catch(error => console.error("Lỗi khi lấy danh sách bài hát:", error));

// const songs = [
//     {
//         id: 1,
//         title: "Em chỉ là",
//         file: "ecl.mp3",
//         image: "ecl.jpg",
//     },
//     {
//         id: 2,
//         title: "Gã săn cá",
//         file: "gsc.mp3",
//         image: "gsc.jpg",
//     },
//     {
//         id: 3,
//         title: "Không đau nữa rồi",
//         file: "kdnr.mp3",
//         image: "kdnr.jpg",
//     },
//     {
//         id: 4,
//         title: "Phép màu",
//         file: "pm.mp3",
//         image: "pm.jpg",
//     },
//     {
//         id: 5,
//         title: "Nhắn nhủ",
//         file: "nn.mp3",
//         image: "nn.jpg",
//     },
// ];
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const music = document.getElementById("music");
const playBtn = document.getElementById("playBtn");
const rangeAudio = document.getElementById("rangeAudio");
const timeSong = document.getElementById("timeSong");
const timeChay = document.getElementById("timeChay");
const nameSong = document.getElementById("nameSong");
const nameArtist = document.getElementById("nameArtist");
const imgSong = document.getElementById("imgSong");
const repeatBtn = document.getElementById("repeatBtn");
const randomBtn = document.getElementById("randomBtn");
const rangeVolume = document.getElementById('rangeVolume');
const volumeBtn = document.getElementById("volumeBtn");
let isMute = false;
let isPlaying = true;
let vitribai = null;
let isRepeat = false;
let isRandom = false;
let time = setInterval(displayTime, 500);
playBtn.addEventListener("click", playPause);
nextBtn.addEventListener("click", function () {
    doibai(1);
});
prevBtn.addEventListener("click", function () {
    doibai(-1);
});
music.addEventListener("ended", xulyHetbai);
rangeAudio.addEventListener("change", xulyrangeAudio);
repeatBtn.addEventListener("click", onOffRepeat);
randomBtn.addEventListener("click", onOffRandom);
// rangeVolume.addEventListener('input', function () {
//     music.volume = this.value / 100;
// });
volumeBtn.addEventListener("click", tatTieng);
rangeVolume.addEventListener("input", function () {
    const value = parseInt(this.value);
    music.volume = value / 100;

    this.style.background = `linear-gradient(to right, white ${value}%, rgba(255,255,255,0.2) ${value}%)`;
});
function playPause() {
    if (isPlaying) {
        music.play();
        isPlaying = false;
        playBtn.innerHTML = `<i class="fa-solid fa-circle-pause center-button"></i>`;
        clearInterval(time);
        time = setInterval(displayTime, 500);
    } else {
        isPlaying = true;
        music.pause();
        playBtn.innerHTML = `<i class="fa-solid fa-circle-play center-button"></i>`;
    }
    console.log("isPlaying =" + isPlaying);
}
function doibai(dir) {
    if (dir == 1) {
        vitribai++;
        if (vitribai >= songs.length) {
            vitribai = 0;
        }
        isPlaying = true;
    } else if (dir == -1) {
        vitribai--;
        if (vitribai < 0) {
            vitribai = songs.length - 1;
        }
        isPlaying = true;
    }
    khoitaoSong(vitribai);
    playPause();
    // console.log("Bài hiện tại:", vitribai, songs[vitribai].file);
    if (songs[vitribai]) {
        console.log("Bài hiện tại:", vitribai, songs[vitribai].fileSong);
    }

}
function displayTime() {
    const { duration, currentTime } = music;
    rangeAudio.max = duration;
    rangeAudio.value = currentTime;
    timeChay.textContent = formatTime(currentTime);
    if (!duration) {
        timeSong.textContent = "00:00";
    } else {
        timeSong.textContent = formatTime(duration);
    }
}
function formatTime(time) {
    const phut = Math.floor(time / 60);
    const giay = Math.floor(time - phut * 60);
    return `${phut < 10 ? "0" + phut : phut}:${giay < 10 ? "0" + giay : giay}`;
}
// function khoitaoSong(vitribai) {
//     nameSong.textContent = songs[vitribai].name;
//     music.setAttribute("src", `/WebMusic/public/uploads/music/${songs[vitribai].fileSong}`);
//     imgSong.setAttribute("src", `/WebMusic/public/uploads/img/${songs[vitribai].image}`);

// }
function khoitaoSong(vitribai) {
    const song = songs[vitribai];
    if (!song) {
        console.error("Không tìm thấy bài hát tại vị trí:", vitribai);
        return;
    }
    nameArtist.textContent = song.artist;
    nameSong.textContent = song.name; 
    music.src = song.fileSong;
    imgSong.src = song.image;
}

function xulyHetbai() {
    if (isRepeat) {
        isPlaying = true;
        playPause();
    }
    else doibai(1);
}
function xulyrangeAudio() {
    music.currentTime = rangeAudio.value;
}
function onOffRepeat() {
    if (isRepeat) {
        isRepeat = false;

        repeatBtn.classList.remove("active");
    }
    else {
        isRepeat = true;

        repeatBtn.classList.add("active");
    }
    console.log("isRepeat = " + isRepeat);
}
function onOffRandom() {
    if (isRandom) {
        isRandom = false;

        randomBtn.classList.remove("active");
    }
    else {
        isRandom = true;

        randomBtn.classList.add("active");
    }
    console.log("isRepeat = " + isRandom);
}
function tatTieng() {
    if (isMute) {

        volumeBtn.innerHTML = `<i class="fa-solid fa-volume-high"></i>`;
        music.volume = 1;
        rangeVolume.value = 100;
        isMute = false;
    }
    else {

        volumeBtn.innerHTML = `<i class="fa-solid fa-volume-xmark"></i>`;
        music.volume = 0;
        rangeVolume.value = 0;
        isMute = true;
    }
    console.log("isMute = " + isMute);
}

