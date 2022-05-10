<?php
    class Compra {
        public $producto;
        public $cantidad;

        function __construct($producto, $cantidad) {
            $this->producto = $producto;
            $this->cantidad = $cantidad;
        }
    }
?>