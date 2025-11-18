<?php
require_once "./../config/database.php";
class userModel extends database
{

    private $connect;

    private $genreColumnExists = null;
    private $genresTableExists = null;

    public function __construct()
    {
        $this->connect = $this->connect();
    }
    private function hasGenreColumn()
    {
        if ($this->genreColumnExists === null) {
            $result = mysqli_query($this->connect, "SHOW COLUMNS FROM songs LIKE 'genre'");
            $this->genreColumnExists = $result && mysqli_num_rows($result) > 0;
        }
        return $this->genreColumnExists;
    }
    private function hasGenresTable()
    {
        if ($this->genresTableExists === null) {
            $result = mysqli_query($this->connect, "SHOW TABLES LIKE 'genres'");
            $this->genresTableExists = $result && mysqli_num_rows($result) > 0;
        }
        return $this->genresTableExists;
    }
    public function getAllArtists()
    {
        $sql = "Select distinct artist from songs";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getSongsByArtist($artistName)
    {
        $sql = "Select * from songs where artist like '%$artistName%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getSongById($id)
    {
        $id = intval($id);
        $sql = "SELECT * FROM songs WHERE id = $id LIMIT 1";
        $query = $this->_query($sql);
        if ($query && mysqli_num_rows($query) > 0) {
            return mysqli_fetch_assoc($query);
        }
        return null;
    }
    public function insert($name, $cs, $image, $audio, $duration, $genre = 'Khác')
    {
        if ($this->hasGenreColumn()) {
            $genre = mysqli_real_escape_string($this->connect, $genre);
            $sql = "INSERT INTO songs(name,fileSong,image,artist,duration,genre) VALUES('$name','$audio', '$image', '$cs', '$duration', '$genre')";
        } else {
            $sql = "INSERT INTO songs(name,fileSong,image,artist,duration) VALUES('$name','$audio', '$image', '$cs', '$duration')";
        }
        return $this->_query($sql);
    }
    public function update($id, $name, $cs, $image, $audio)
    {
        $sql = "UPDATE songs SET name='$name', fileSong='$audio', image = '$image' ,artist='$cs' WHERE id='$id'";
        $query = $this->_query($sql);
        return $query;
    }
    public function delete($id)
    {
        $sql = "DELETE FROM songs WHERE id='$id'";
        $query = $this->_query($sql);
        return $query;
    }
    public function getSongs()
    {
        $sql = "Select * from songs";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getGenres()
    {
        $data = [];
        if ($this->hasGenresTable()) {
            $sql = "SELECT id, name FROM genres ORDER BY name";
            $query = $this->_query($sql);
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'id' => (int)$row['id'],
                    'name' => $row['name'],
                ];
            }
            return $data;
        }

        if ($this->hasGenreColumn()) {
            $sql = "SELECT DISTINCT genre FROM songs WHERE genre IS NOT NULL AND genre <> '' ORDER BY genre";
            $query = $this->_query($sql);
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'id' => null,
                    'name' => $row['genre'],
                ];
            }
        }
        return $data;
    }
    public function getSongsDomic()
    {
        $sql = "Select * from songs where artist like '%Dương Domic%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsHTH()
    {
        $sql = "Select * from songs where artist like '%HIEUTHUHAI%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsWn()
    {
        $sql = "Select * from songs where artist like '%W/n%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsMTP()
    {
        $sql = "Select * from songs where artist like '%Sơn Tùng MTP%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsWren()
    {
        $sql = "Select * from songs where artist like '%Wren Evans%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsDrt()
    {
        $sql = "Select * from songs where artist like '%Dangrangto%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function getSongsEXSH()
    {
        $sql = "Select * from songs where artist like '%EXSH%'";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;

    }
    public function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }
    public function searchSongs($keyword)
    {
        // Escape từ khóa để chống SQL Injection (rất quan trọng)
        $keyword = mysqli_real_escape_string($this->connect, $keyword);

        $sql = "SELECT * FROM songs 
            WHERE name LIKE '%$keyword%' 
               OR artist LIKE '%$keyword%'";
        $query = $this->_query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }

    public function isFavorite($userId, $songId)
    {
        $sql = "SELECT 1 FROM favorites WHERE user_id = ? AND song_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $userId, $songId);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function addFavorite($userId, $songId)
    {
        $sql = "INSERT IGNORE INTO favorites (user_id, song_id) VALUES (?, ?)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $userId, $songId);
        return $stmt->execute();
    }

    public function removeFavorite($userId, $songId)
    {
        $sql = "DELETE FROM favorites WHERE user_id = ? AND song_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $userId, $songId);
        return $stmt->execute();
    }

    public function getFavoriteSongs($userId)
    {
        $sql = "SELECT s.* FROM songs s 
                JOIN favorites f ON s.id = f.song_id 
                WHERE f.user_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getSongsByPlaylistID($playlistId)
    {
        $sql = "SELECT s.* FROM songs s
                JOIN playlist_songs ps ON s.id = ps.song_id
                WHERE ps.playlist_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $playlistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function insertPlaylist($userId, $playlistName)
    {
        $sql = "INSERT INTO playlists (user_id, name) VALUES (?, ?)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("is", $userId, $playlistName);
        return $stmt->execute();
    }
    public function getPlaylistsByUserId($userId)
    {
        $sql = "SELECT p.*, COUNT(ps.song_id) AS song_count
                FROM playlists p
                LEFT JOIN playlist_songs ps ON p.id = ps.playlist_id
                WHERE p.user_id = ?
                GROUP BY p.id
                ORDER BY p.created_at DESC";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function checkOwner($playlistId, $userId)
    {
        $sql = "SELECT id FROM playlists WHERE id = ? AND user_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $playlistId, $userId);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function addSongToPlaylist($playlistId, $songId)
    {
        // Kiểm tra xem đã tồn tại chưa
        $sqlCheck = "SELECT 1 FROM playlist_songs WHERE playlist_id = ? AND song_id = ?";
        $stmtCheck = $this->connect->prepare($sqlCheck);
        $stmtCheck->bind_param("ii", $playlistId, $songId);
        $stmtCheck->execute();
        $stmtCheck->store_result();
        if ($stmtCheck->num_rows > 0) {
            return false; // Đã tồn tại
        }
        $sql = "INSERT INTO playlist_songs (playlist_id, song_id) VALUES (?, ?)";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $playlistId, $songId);
        return $stmt->execute();
    }
    public function removeSongFromPlaylist($playlistId, $songId)
    {
        $sql = "DELETE FROM playlist_songs WHERE playlist_id = ? AND song_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("ii", $playlistId, $songId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
    public function updatePlaylistName($playlistId, $userId, $playlistName)
    {
        $sql = "UPDATE playlists SET name = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("sii", $playlistName, $playlistId, $userId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
    public function deletePlaylist($playlistId)
    {
        $sql = "DELETE FROM playlists WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $playlistId);
        return $stmt->execute();
    }
    public function getPlaylistById($playlistId)
    {
        $sql = "SELECT * FROM playlists WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param("i", $playlistId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}