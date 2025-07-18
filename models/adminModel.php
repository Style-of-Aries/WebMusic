<?php
require "../config/database.php";
class adminModel extends database
{
    private $connect;

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
    public function insert($name, $cs, $image, $audio)
    {
        $sql = "INSERT INTO songs(name,fileSong,image,artist) VALUES('$name','$audio', '$image', '$cs')";
        $query = $this->_query($sql);
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
