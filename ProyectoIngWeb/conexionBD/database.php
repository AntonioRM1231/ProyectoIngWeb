<?php
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost','root','anahi1610','ccm'); 
    if(!$db){
        echo "No se pudo conectar";
        exit;
    }
    return $db;
}
// class connection{
//     private $conn;

//     public function __construct(){
//         $this->conn = new mysqli('localhost','root','root','ccm');
//     }

//     public function get_connection(){
//         return $this->conn;
//     }
// }