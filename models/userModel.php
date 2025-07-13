<?php
    require_once "./../config/database.php";
class userModel extends database
{

    private $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function getSongs() {
        $sql="Select * from songs";
        $query=$this->_query($sql);
        $data=[];
        while($row=mysqli_fetch_assoc($query)){
            array_push($data,$row);
        }
        return $data;
        
    }
    public function getSongsDomic() {
        $sql="Select * from songs where artist='Dương Domic'";
        $query=$this->_query($sql);
        $data=[];
        while($row=mysqli_fetch_assoc($query)){
            array_push($data,$row);
        }
        return $data;
        
    }
    public function _query($sql){
        return mysqli_query($this->connect,$sql);
    }
    public function searchSongs($keyword) {
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

}