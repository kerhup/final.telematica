<?php
    class Producto {
        public $id;
        public $nombre;
        public $precio;
        public $imagen;
        public $existencia;

        function __construct($id, $nombre, $precio, $imagen, $existencia) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->imagen = $imagen;
            $this->existencia = $existencia;
        }
    }
?>