<?php
    class RegistroUsuarios{
        private $CorreoE;
        private $NombreUsuario;
        private $Contrasenia;
        private $Nombre;
        private $ApPaterno;
        private $ApMaterno;
        private $Edad;
        private $NumTelefono;
        private $ID_Pedido;
        private $NumeroTarjeta;

        public function getCorreoE(){
            return $this->CorreoE;
        }
        public function getNombreUsuario(){
            return $this->NombreUsuario;
        }
        public function getContrasenia(){
            return $this->Contrasenia;
        }
        public function getNombre(){
            return $this->Nombre;
        }
        public function getApPaterno(){
            return $this->ApPaterno;
        }
        public function getApMaterno(){
            return $this->ApMaterno;
        }
        public function getEdad(){
            return $this->Edad;
        }
        public function getNumTelefono(){
            return $this->NumTelefono;
        }
        public function getID_Pedido(){
            return $this->ID_Pedido;
        }
        public function getNumeroTarjeta(){
            return $this->NumeroTarjeta;
        }

        public function setCorreoE($CorreoE){
            $this->CorreoE = $CorreoE;
        }
        public function setNombreUsuario($NombreUsuario){
            $this->NombreUsuario = $NombreUsuario;
        }
        public function setContrasenia($Contrasenia){
            $this->Contrasenia = $Contrasenia;
        }
        public function setNombre($Nombre){
            $this->Nombre = $Nombre;
        }
        public function setApPaterno($ApPaterno){
            $this->ApPaterno = $ApPaterno;
        }
        public function setApMaterno($ApMaterno){
            $this->ApMaterno = $ApMaterno;
        }
        public function setEdad($Edad){
            $this->Edad = $Edad;
        }
        public function setNumTelefono($NumTelefono){
            $this->NumTelefono = $NumTelefono;
        }
        public function setID_Pedido($ID_Pedido){
            $this->ID_Pedido = $ID_Pedido;
        }
        public function setNumeroTarjeta($NumeroTarjeta){
            $this->NumeroTarjeta = $NumeroTarjeta;
        }
    }
