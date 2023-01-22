<?php
    class connection{
        private $conn;

        public function __construct(){
            $this->conn = new mysqli('localhost','root','anahi1610','ccm');
        }
        public function get_connection(){
            return $this->conn;
        }
    }
?>