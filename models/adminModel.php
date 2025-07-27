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
    public function getUserId($id)
    {
        $sql = "select * from users where id='$id'";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function updateSong($id,$name, $cs, $image, $audio){
        $sql = "UPDATE songs SET name='$name', fileSong='$audio', image = '$image' ,artist='$cs'  WHERE id='$id'";
        $query=$this->_query($sql);
    }
    public function updateUser($id,$userNameRegister, $emailRegister, $passRegister){
        $sql = "UPDATE users SET username='$userNameRegister', email='$emailRegister', password = '$passRegister' WHERE id='$id'";
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
    public function authEmail($emailRegister){
        $sql="Select *from users where email='$emailRegister'";
        $query=$this->_query($sql);
        if(mysqli_num_rows($query)>0){
            return true;
        }
    }
    public function authUserName($userNameRegister){
        $sql="Select *from users where username='$userNameRegister'";
        $query=$this->_query($sql);
        if(mysqli_num_rows($query)>0){
            return true;
        }
    }
    // Thêm tài khoản vào bảng users
    public function authUsers($userNameRegister,$emailRegister,$passRegister){

        $sql="INSERT INTO users(username,email,password,sodienthoai) VALUES ('$userNameRegister','$emailRegister','$passRegister')";
        $query=$this->_query($sql);
    }
}
