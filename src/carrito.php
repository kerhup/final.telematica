<?php
    include("./model/producto.php");
    include("./model/compra.php");

    session_start();
    if(!isset($_SESSION["carrito"]) && !isset($_SESSION["stock"])){
        echo "El carrito esta vacio. <a href=\"/\">Volver al catalogo</a>";
    }else{
        if(count($_SESSION["carrito"])<=0){
            echo "El carrito esta vacio. <a href=\"/\">Volver al catalogo</a>";
        }
    }
    $subtotal = 0;
    $iva = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compra</title>
</head>
<body>
    
    <h2>Carrito de compra</h2>
    <br>
    <h4>Lista</h4>
    <?php
        foreach($_SESSION["carrito"] as $item){
            $subtotal = $subtotal + ($item->producto->precio * $item->cantidad)
    ?>
    <p><img src="img/<?php echo $item->producto->imagen ?>" style="max-height: 50px"> <?php echo $item->producto->nombre ?> - precio: <?php echo $item->producto->precio ?> $ - cantidad: <?php echo $item->cantidad ?></p>
    <?php } 
        $iva = $subtotal * 0.1;
    ?>
    <br><br>
    
    <h3>SubTotal: <?php echo $subtotal ?> $</h3>
    <h3>IVA 10%: <?php echo $iva ?> $</h3>
    <h2>Total: <?php echo $subtotal + $iva ?> $</h2>

    <br><br>

    <a href="/">Volver al catalogo</a>
</body>
</html>