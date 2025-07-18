// fetch("../api/getSongs.php")
//   .then((res) => res.json())
//   .then((data) => {
//     songs = data;
//     console.log("Danh sách bài hát:", songs);
//     vitribai = null;
//     khoitaoSong(vitribai);

//     document.querySelectorAll(".song-table tbody tr").forEach((row) => {
//       row.addEventListener("click", function () {
//         const index = parseInt(this.getAttribute("data-index"));
//         console.log("Vị trí bài hát:", index);
//         console.log("File bài hát:", songs[index].fileSong);
//         if (isNaN(index)) return;

//         if (vitribai === index) {
//           playPause();
//           const icon = this.querySelector(".icon-overlay i");
//           if (icon)
//             icon.className = isPlaying
//               ? "fa-solid fa-play"
//               : "fa-solid fa-pause";
//         } else {
//           vitribai = index;
//           isPlaying = true;
//           khoitaoSong(vitribai);
//           playPause();
//           document
//             .querySelectorAll(".song-table tbody tr")
//             .forEach((r) => r.classList.remove("active"));
//           this.classList.add("active");
//           document
//             .querySelectorAll(".icon-overlay i")
//             .forEach((icon) => (icon.className = "fa-solid fa-play"));
//           const icon = this.querySelector(".icon-overlay i");
//           if (icon) icon.className = "fa-solid fa-pause";
//         }
//       });
//     });
//   })

//   .catch((error) => console.error("Lỗi khi lấy danh sách bài hát:", error));
let songs = [];
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
const rangeVolume = document.getElementById("rangeVolume");
const volumeBtn = document.getElementById("volumeBtn");
const card_playBtn = document.getElementById("card_playBtn");
const favoriteBtn = document.getElementById("favoriteBtn");
const avatarBtn = document.getElementById("avatarBtn");
const dropdownMenu = document.getElementById("dropdownMenu");

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
document.addEventListener("keydown", function (e) {
  if (e.key === "m" || e.key === "M") {
    tatTieng();
  }
});
rangeVolume.addEventListener("input", function () {
  const value = parseInt(this.value);
  music.volume = value / 100;

  this.style.background = `linear-gradient(to right, white ${value}%, rgba(255,255,255,0.2) ${value}%)`;
});
document.querySelectorAll(".card").forEach((card) => {
  card.addEventListener("click", function () {
    const playlist = this.dataset.playlist;
    const index = this.dataset.index; // ép kiểu
    const audio = this.dataset.song;
    const id = this.dataset.id;
    console.log("Vị trí bài hát:", index);
    console.log("Playlist: ", playlist);
    console.log("File bài hát:", audio);
    console.log("ID bài:", id);

    if (vitribai === index) {
      playPause();
      const icon = this.querySelector(".play-icon");
      if (icon)
        icon.className = isPlaying
          ? "fa-solid fa-play play-icon"
          : "fa-solid fa-pause play-icon";
    } else {
      vitribai = index;
      isPlaying = true;
      khoitaoSong(vitribai, playlist);
      playPause();
      document
        .querySelectorAll(".play-icon")
        .forEach((icon) => (icon.className = "fa-solid fa-play play-icon"));
      const icon = this.querySelector(".play-icon");
      if (icon) icon.className = "fa-solid fa-pause play-icon";
    }
  });
});

document.querySelectorAll(".card").forEach((card, index) => {
  const song = {
    id: card.dataset.id,
    name: card.dataset.name,
    image: card.dataset.img,
    artist: card.dataset.artist,
    fileSong: card.dataset.song,
  };
  songs.push(song);
  // Gán index để đảm bảo đúng vị trí
  card.setAttribute("data-index", index);
});
avatarBtn.addEventListener("click", function (e) {
  e.stopPropagation(); // Ngăn click lan ra ngoài
  dropdownMenu.style.display =
    dropdownMenu.style.display === "block" ? "none" : "block";
});

window.addEventListener("click", function (e) {
  if (!dropdownMenu.contains(e.target)) {
    dropdownMenu.style.display = "none";
  }
});

favoriteBtn.addEventListener("click", function () {
  const song = songs[vitribai]; // bài đang phát
  if (!song || !song.id) return;

  fetch("index.php?controller=user&action=toggleFavorite", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "song_id=" + song.id,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log("Server response:", data);
      const icon = favoriteBtn.querySelector("i");
      if (data === "added") {
        icon.classList.remove("fa-regular");
        icon.classList.add("fa-solid");
      } else if (data === "removed") {
        icon.classList.remove("fa-solid");
        icon.classList.add("fa-regular");
      }
    });
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
    if (isRandom) {
      let vitrimoi;
      do {
        vitrimoi = Math.floor(Math.random() * songs.length);
        console.log("vị trí mới: = " + vitrimoi);
      } while (vitribai === vitrimoi);
      vitribai = vitrimoi;
    } else {
      vitribai++;
      if (vitribai >= songs.length) {
        vitribai = 0;
      }
    }
  } else if (dir == -1) {
    if (isRandom) {
      let vitrimoi;
      do {
        vitrimoi = Math.floor(Math.random() * songs.length);
        console.log("vị trí mới: = " + vitrimoi);
      } while (vitribai === vitrimoi);
      vitribai = vitrimoi;
    } else {
      vitribai--;
      if (vitribai < 0) {
        vitribai = songs.length - 1;
      }
    }
  }
  isPlaying = true;
  khoitaoSong(vitribai);
  playPause();
  // console.log("Bài hiện tại:", vitribai, songs[vitribai].file);
}
function displayTime() {
  const { duration, currentTime } = music;
  if (vitribai === null || isNaN(duration)) {
    timeChay.textContent = "--:--";
    timeSong.textContent = "--:--";
    return;
  }
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
function khoitaoSong(vitribai) {
  const song = songs[vitribai];
  const src = songs[vitribai].image;
  if (!song) {
    console.error("Không tìm thấy bài hát tại vị trí:", vitribai);
    return;
  }
  nameArtist.textContent = song.artist;
  nameSong.textContent = song.name;
  music.src = song.fileSong;
  // imgSong.src = song.image;
  if (src) {
    imgSong.src = src;
    imgSong.style.display = "block";
  }
  document.getElementById("favoriteBtn").style.display = "block";
  checkFavorite(song.id);
  if (songs[vitribai]) {
    console.log("Bài hiện tại:", vitribai, songs[vitribai].fileSong);
  }
}

function xulyHetbai() {
  if (isRepeat) {
    isPlaying = true;
    playPause();
  } else if (isRandom) {
    let vitrimoi;
    do {
      vitrimoi = Math.floor(Math.random() * songs.length);
      console.log("vị trí mới: = " + vitrimoi);
    } while (vitribai === vitrimoi);
    isPlaying = true;
    vitribai = vitrimoi;
    khoitaoSong(vitribai);
    playPause();
  } else doibai(1);
}
function xulyrangeAudio() {
  music.currentTime = rangeAudio.value;
}
function onOffRepeat() {
  if (isRepeat) {
    isRepeat = false;

    repeatBtn.classList.remove("active");
  } else {
    isRepeat = true;

    repeatBtn.classList.add("active");
  }
  console.log("isRepeat = " + isRepeat);
}
function onOffRandom() {
  if (isRandom) {
    isRandom = false;

    randomBtn.classList.remove("active");
  } else {
    isRandom = true;

    randomBtn.classList.add("active");
  }
  console.log("isRandom = " + isRandom);
}
function tatTieng() {
  if (isMute) {
    volumeBtn.innerHTML = `<i class="fa-solid fa-volume-high"></i>`;
    music.volume = 1;
    rangeVolume.value = 100;
    isMute = false;
  } else {
    volumeBtn.innerHTML = `<i class="fa-solid fa-volume-xmark"></i>`;
    music.volume = 0;
    rangeVolume.value = 0;
    isMute = true;
  }
  console.log("isMute = " + isMute);
}

function checkFavorite(songId) {
  fetch("index.php?controller=user&action=isFavorite", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "song_id=" + songId,
  })
    .then((res) => res.text())
    .then((data) => {
      const icon = favoriteBtn.querySelector("i");
      if (data === "true") {
        icon.classList.remove("fa-regular");
        icon.classList.add("fa-solid");
      } else {
        icon.classList.remove("fa-solid");
        icon.classList.add("fa-regular");
      }
    });
}
