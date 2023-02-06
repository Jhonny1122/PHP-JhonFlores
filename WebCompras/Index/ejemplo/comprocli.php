
<?php
	if(isset($_COOKIE["nif"])){			
		$nif=$_COOKIE["nif"]; //Guardo el nif de mi cliente para registrarlo en la compra final
	}

?>
<?php
    include("funciones.php");
?>
<?php
if( !empty($_POST["producto"]) && empty($_POST["unidades"]) ){//echo "No ha se ha elegido producto y/o unidade. NO se crea la cesta";
}
else if (isset($_POST["cesta"])){ //clic en boton AÑADIR A CESTA
    
    //Recogida de variables:
    $unidades=$_POST["unidades"]; 
    $id_producto=$_POST["producto"]; //el id del prod del desplegable 
    $fecha_compra = date('Y/m/d'); //fecha actual
   
    $conn=conexion();
    $array_precio = verPrecioProductos($conn, $id_producto);
    $conn = null;
    //var_dump($array_precio);
    $precio= $array_precio[0]["precio"];
    var_dump($precio);
   
    //Si el array $CESTA_arr no existe, que lo cree
    if(!isset($CESTA_arr)){
        $CESTA_arr = array(); //Un array vacio.

          //Añadir productos a la CESTA
     $CESTA_arr[$id_producto]['unidades']=$_POST["unidades"];
     $CESTA_arr[$id_producto]['precio']= $precio;
      
   
    }else{
        
     //Añadir productos a la CESTA
     $CESTA_arr[$id_producto]['unidades']=$_POST["unidades"];
     $CESTA_arr[$id_producto]['precio']= $precio;
 

    }

      //Crear COOKIE
      setcookie('carrito', serialize($CESTA_arr), time()+60*60*24*30, "/"); 
      var_dump($CESTA_arr);

 
     //SI la COOKIE ya existe que Muestre su contenido
     if(isset($_COOKIE["carrito"])){ 
 
      $CESTA_contenido= unserialize($_COOKIE['carrito']); 
      var_dump($CESTA_contenido); //Mostrar cookie

     }
}else if (isset($_POST["comprar"])){

    if(isset($_COOKIE["carrito"])){			
		$carrito=unserialize($_COOKIE["carrito"]); //Guardo el carrito de mi cliente
	}
    echo "Compra final:";
    var_dump($carrito);

    for($i=0; $i<count($carrito) ;$i++){
        $arr_Total[]=$carrito[$i]['unidades']*$carrito[$i]['precio'];
    }
    var_dump($arr_Total);

   
        $total_A_Pagar=array_sum($arr_Total);
    

    echo "Total de la compra: ". $total_A_Pagar . " euros";
    var_dump($total_A_Pagar);

    //BORRAR COOKIE carrito tras el pago total de la compra
    if (isset($_COOKIE['carrito'])) { 
        unset($_COOKIE['carrito']); 
        setcookie('carrito', '', time() - 3600, '/'); 
      }

}

/*else if (isset($_POST["logout"])){
    header("Location: C:\wamp64\www\WebCompras_ROSA\comlogincli.php");
    exit;
} */
?>
<HTML>
<HEAD><TITLE>Compra de Productos</TITLE></HEAD>
<style>
</style>
<link rel="stylesheet" href="bootstrap.min.css">
<BODY>


<h1>Compra de Productos (comprocli.php) COOKIE</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    Nombres de los productos <select name="producto"> 
        <?php
        $conn=conexion();
        $prod=verProductosDisponibles($conn); //Solo muestra productos que estan en stock. si hay cantidad 0, ya no los muestra
        foreach($prod as $row) {
            echo "<option value=".$row["id_producto"].">". $row["nombre"]. "</option>";
        }
        $conn = null;
        ?>
    </select> <br><br>
   
    Nº Unidades del producto <input type="text" name='unidades'> <br> <br>
    <input type="submit" value="COMPRAR" name="comprar" />
    <input type="submit" value="AÑADIR A CESTA" name="cesta" />
    <input type="submit" value="LOGOUT" name="logout" />
</form>
<br>

<br>

</BODY>
</HTML>