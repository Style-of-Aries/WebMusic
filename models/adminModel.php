<?php
require "../config/database.php";
class adminModel extends database
{
    private $connect;
    private $genreColumnExists = null;
    private $genresTableExists = null;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function getAll()
    {
        $sql = "select * from songs";
        $query = $this->_query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
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

    public function insert($name, $cs, $image, $audio, $duration, $genre = 'Khác')
    {
        if ($this->hasGenreColumn()) {
            $genre = mysqli_real_escape_string($this->connect, $genre);
            $sql = "INSERT INTO songs(name,fileSong,image,artist,duration,genre) VALUES('$name','$audio', '$image', '$cs', '$duration', '$genre')";
        } else {
            $sql = "INSERT INTO songs(name,fileSong,image,artist,duration) VALUES('$name','$audio', '$image', '$cs', '$duration')";
        }
        $this->_query($sql);
    }

    public function getGenres()
    {
        if (!$this->hasGenresTable()) {
            return [];
        }
        $sql = "SELECT id, name FROM genres ORDER BY name";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'id' => (int)$row['id'],
                'name' => $row['name'],
            ];
        }
        return $data;
    }

    public function createGenre($name)
    {
        if (!$this->hasGenresTable()) {
            return false;
        }
        $name = mysqli_real_escape_string($this->connect, $name);
        $sql = "INSERT INTO genres(name) VALUES('$name')";
        return $this->_query($sql);
    }

    public function updateGenre($id, $name)
    {
        if (!$this->hasGenresTable()) {
            return false;
        }
        $id = intval($id);
        $name = mysqli_real_escape_string($this->connect, $name);
        $sql = "UPDATE genres SET name = '$name' WHERE id = $id";
        return $this->_query($sql);
    }

    public function deleteGenre($id)
    {
        if (!$this->hasGenresTable()) {
            return false;
        }
        $id = intval($id);
        $this->_query("DELETE FROM song_genres WHERE genre_id = $id");
        $sql = "DELETE FROM genres WHERE id = $id";
        return $this->_query($sql);
    }
    public function getSongId($id)
    {
        $sql = "select * from songs where id='$id'";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }
    public function updateSong($id,$name, $cs, $image, $audio){
        $sql = "UPDATE songs SET name='$name', fileSong='$audio', image = '$image' ,artist='$cs'  WHERE id='$id'";
        $query=$this->_query($sql);
    }
    public function deleteSong($id){
        $sql="DELETE FROM songs WHERE id=$id";
        $query=$this->_query($sql);
    }

    public function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }

    // Your database connection and methods for admin-related data

    public function getAllUser()
    {
        $sql = "select * from users";
        $query = $this->_query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function deleteUser($id){
        $sql="DELETE FROM users WHERE id=$id";
        $query=$this->_query($sql);

    }
    public function getAllYt($id)
    {
        $sql = " SELECT 
                s.image,
                s.name ,
                s.artist,
                s.fileSong
            FROM favorites f
            JOIN songs s ON f.song_id = s.id
            WHERE f.user_id = $id";
        $query = $this->_query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
}
