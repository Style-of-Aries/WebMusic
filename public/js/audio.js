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
const overlay = document.getElementById("overlay");
const popupUpload = document.getElementById("popupUpload");
const uploadMusic = document.getElementById("uploadMusic");
const avatarBtn = document.getElementById("avatarBtn");
const dropdownMenu = document.getElementById("dropdownMenu");
const closePopup = document.getElementById("closePopup");
const deleteBtn = document.getElementById("deleteBtn");
const popupAddPlaylist = document.getElementById("popupAddPlaylist");
const addPlaylistBtn = document.getElementById("addPlaylistBtn");
const editPlaylistBtns = document.querySelectorAll(".editPlaylistBtn");
const popupEditPlaylist = document.getElementById("popupEditPlaylist");
const playlistPopup = document.getElementById("playlistPopup");
const closePlaylistPopup = document.getElementById("closeplaylistPopup");
let isMute = false;
let isPlaying = true;
let vitribai = null;
let isRepeat = false;
let isRandom = false;

function hideFlashMessage() {
  // Tìm phần tử thông báo bằng ID
  var messageElement = document.getElementById("flash-message");

  // Kiểm tra xem phần tử có tồn tại không
  if (messageElement) {
    // 2. Ẩn thông báo bằng cách thay đổi CSS
    // Cách đơn giản: đặt display thành 'none'
    messageElement.style.display = "none";

    /* HOẶC: Sử dụng class để ẩn dần (tạo hiệu ứng đẹp hơn)
            Bạn sẽ cần thêm CSS cho class 'hidden'
            messageElement.classList.add('hidden');
            */
  }
}

// 3. Thiết lập bộ đếm thời gian (Timer)
// Thiết lập thời gian chờ (ví dụ: 4000 mili giây = 4 giây)
var hideDelay = 2000;

// Gọi hàm hideFlashMessage() sau khi thời gian chờ kết thúc
// Đây là dòng mã quan trọng nhất để tạo tính năng tự động ẩn
setTimeout(hideFlashMessage, hideDelay);
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
  switch (e.key.toLowerCase()) {
    case "m":
      tatTieng();
      break;

    case "p":
      playPause();
      break;

    default:
      // Không làm gì nếu không trùng
      break;
  }
});


rangeVolume.addEventListener("input", function () {
  const value = parseInt(this.value);
  music.volume = value / 100;
  if (music.volume == 0) {
    volumeBtn.innerHTML = `<i class="fa-solid fa-volume-xmark"></i>`;
  } else {
    volumeBtn.innerHTML = `<i class="fa-solid fa-volume-high"></i>`;
  }
  // this.style.background = `linear-gradient(to right, white ${value}%, rgba(255,255,255,0.2) ${value}%)`;
});

document.querySelectorAll(".card").forEach((card) => {
  card.addEventListener("click", function (e) {
    const playBtn = e.target.closest(".play-btn");
    if (!playBtn) return; // Chỉ xử lý khi click vào play-btn (hoặc play-icon bên trong)

    const index = parseInt(this.getAttribute("data-index"));
    const audio = this.dataset.song;
    const id = this.dataset.id;

    console.log("Vị trí bài hát:", index);
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
      khoitaoSong(vitribai);
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
document.querySelectorAll(".iconAddPlaylist").forEach((btn) => {
  btn.addEventListener("click", () => {
    const songId = btn.getAttribute("data-song_id");
    console.log("Song ID to add to playlist:", songId);
    document.querySelectorAll('input[name="song_id"]').forEach((input) => {
      input.value = songId;
    });
    document.getElementById("playlistPopup").style.display = "block";
    overlay.style.display = "block";
  });
});

document.querySelectorAll(".favoriteBtn").forEach((btn) => {
  btn.addEventListener("click", function () {
    const songId = this.getAttribute("data-id");
    if (!songId) return;

    fetch("index.php?controller=user&action=toggleFavorite", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "song_id=" + songId,
    })
      .then((res) => res.text())
      .then((data) => {
        // Tìm tất cả các nút favorite có cùng songId
        const allFavBtns = document.querySelectorAll(
          `.favoriteBtn[data-id="${songId}"]`
        );

        allFavBtns.forEach((btn) => {
          const icon = btn.querySelector("i");
          if (data === "added") {
            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
          } else if (data === "removed") {
            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
          }
        });
      });
  });
});

function capNhatIconCardDangPhat() {
  document.querySelectorAll(".card").forEach((card, index) => {
    const icon = card.querySelector(".play-icon");
    if (!icon) return;

    if (index === vitribai && !isPlaying) {
      icon.className = "fa-solid fa-pause play-icon";
    } else {
      icon.className = "fa-solid fa-play play-icon";
    }
  });
}

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
  capNhatIconCardDangPhat();
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
  capNhatIconCardDangPhat();
  console.log("Bài hiện tại:", vitribai, songs[vitribai].file);
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
  const wrapper = document.querySelector(".scroll-wrapper");
  if (!wrapper) {
    console.error("Không tìm thấy phần tử scroll-wrapper");
    return;
  }
  if (!song) {
    console.error("Không tìm thấy bài hát tại vị trí:", vitribai);
    return;
  }
  document.getElementById("favoriteBtn").setAttribute("data-id", song.id);
  document.getElementById("iconAddPlaylist").setAttribute("data-song_id", song.id);
  nameArtist.textContent = song.artist;
  nameSong.textContent = song.name;
  music.src = song.fileSong;
  imgSong.src = song.image;
  if (src) {
    imgSong.src = src;
    imgSong.style.display = "block";
  }
  nameSong.classList.remove("scroll");
  nameSong.style.animation = "none";
  nameSong.style.paddingLeft = "0";
  void nameSong.offsetWidth; // Trigger reflow

  // Sau 100ms kiểm tra nếu cần scroll thì thêm class
  setTimeout(() => {
    if (nameSong.scrollWidth > wrapper.clientWidth) {
      nameSong.classList.add("scroll");
      nameSong.style.animation = null;
      nameSong.style.paddingLeft = "100%";
    }
  }, 100);
  document.getElementById("favoriteBtn").style.display = "block";
  document.getElementById("iconAddPlaylist").style.display = "block";
  checkFavorite(song.id);
  if (songs[vitribai]) {
    console.log("Bài hiện tại:", vitribai, songs[vitribai].fileSong);
  }
}

function xulyHetbai() {
  if (isRepeat) {
    isPlaying = true;
    playPause();
    capNhatIconCardDangPhat();
  } else if (isRandom) {
    let vitrimoi;
    do {
      vitrimoi = Math.floor(Math.random() * songs.length);
      console.log("tổng bài: " + songs.length);
      console.log("vị trí mới: = " + vitrimoi);
    } while (vitribai === vitrimoi);
    isPlaying = true;
    vitribai = vitrimoi;
    khoitaoSong(vitribai);
    playPause();
    capNhatIconCardDangPhat();
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
    repeatBtn.innerHTML = `<i class="fa-solid fa-repeat"></i>`;
    repeatBtn.classList.add("active");
  }
  console.log(repeatBtn.classList.contains("active"));

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

document.querySelectorAll(".editBtn").forEach((btn) => {
  btn.addEventListener("click", () => {
    console.log("Edit button clicked");
    const card = btn.closest(".mySongs-item");
    if (!card) {
      console.error("Card not found for this button!");
      return;
    }

    const songData = {
      id: card.dataset.id,
      name: card.dataset.name,
      artist: card.dataset.artist,
      fileSong: card.dataset.song,
      image: card.dataset.img,
    };

    openEditPopup(songData);
  });
});

function openEditPopup(songData) {
  if (!popupEdit) return;

  document.getElementById("edit-id").value = songData.id;
  document.getElementById("edit-title").value = songData.name;
  document.getElementById("edit-artist").value = songData.artist;
  document.getElementById("edit-old-audio").value = songData.fileSong; // lưu file nhạc cũ
  document.getElementById("edit-old-image").value = songData.image; // lưu ảnh cũ
  overlay.style.display = "block";
  popupEdit.style.display = "block";
}

uploadMusic.addEventListener("click", function () {
  overlay.style.display = "block";
  popupUpload.style.display = "block";
});

document.querySelectorAll(".closePopup").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (overlay) overlay.style.display = "none";
    if (popupUpload) popupUpload.style.display = "none";
    if (popupEdit) popupEdit.style.display = "none";
    if (popupAddPlaylist) popupAddPlaylist.style.display = "none";
    if (popupEditPlaylist) popupEditPlaylist.style.display = "none";
    if (playlistPopup) playlistPopup.style.display = "none";
  });
});

if (addPlaylistBtn && popupAddPlaylist) {
  addPlaylistBtn.addEventListener("click", function () {
    overlay.style.display = "block";
    popupAddPlaylist.style.display = "block";
  });
}

if (editPlaylistBtns.length && popupEditPlaylist) {
  editPlaylistBtns.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      const playlistId = this.dataset.playlistId;
      const playlistName = this.dataset.playlistName || "";
      document.getElementById("edit-playlist-id").value = playlistId;
      document.getElementById("edit-playlist-name").value = playlistName;
      overlay.style.display = "block";
      popupEditPlaylist.style.display = "block";
    });
  });
}

