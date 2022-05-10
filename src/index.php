<?php
    include("./model/producto.php");
    include("./model/compra.php");
    session_start();
    if(!isset($_SESSION["carrito"]) && !isset($_SESSION["stock"])){
        $prod1 = new Producto(1, "VOGUE", 800000, "revistaVogue.jpeg", 10);
        $prod2 = new Producto(2, "ESIKA", 25000, "esika.jpeg", 20);
        $prod3 = new Producto(3, "NATURA", 100000, "natura.jpeg", 15);

        $_SESSION["stock"] = array($prod1, $prod2, $prod3);

        $_SESSION["carrito"] = array();
    }

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $cantidad = $_POST["cantidad"];
        
        if($cantidad <= 0){
            echo "No se pudo agregar el producto al carrito de compra: la cantidad debe ser mayor a 0";
        } else {
            $prod = null;

            foreach($_SESSION["stock"] as $item){
                if($item->id == $id){
                    $prod = $item;
                }
            }

            if($prod->existencia >= $cantidad){
                array_push($_SESSION["carrito"], new Compra($prod, $cantidad));
                foreach($_SESSION["stock"] as $item){
                    if($item->id == $id){
                        $item->existencia = $item->existencia - $cantidad;
                    }
                }
                echo "Se agrego un producto al carrito de compra";
            }else{
                echo "No se pudo agregar el producto al carrito de compra: la cantidad supera la existencia de ese producto";
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Pukii</title>
</head>
<body>
    <center><h2>Tienda Pukii</h2></center>
    <br>
    <p><a href="carrito.php">Carrito de compra <img src="img/carrito.png" style="max-height: 20px"></a></p>
    <br>
    <br>
    <h3>Catalogo</h3>
    <?php
        foreach($_SESSION["stock"] as $item){
    ?>
    <div>
        <img src="img/<?php echo $item->imagen ?>" style="max-height: 200px">
        <p><?php echo $item->nombre ?></p>
        <p>Precio: <?php echo $item->precio ?> $</p>
        <p>Existencias: <?php echo $item->existencia ?></p>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $item->id ?>">
            <p style="font-size: 10pt">Agregar al carrito <input type="number" name="cantidad" style="width: 40px" placeholder="Cantidad"> <input type="submit"  value="agregar"></p>
        </form>
    </div>
    <br>
    <?php
        }
    ?>
</body>
</html>