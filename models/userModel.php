<?php
require_once "./../config/database.php";
class userModel extends database
{

    private $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
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
}