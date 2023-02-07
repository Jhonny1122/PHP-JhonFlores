<?php
//Crear la conexión pasando parámetros de la base de datos y si hay error con el try se muestra el mensaje
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $conn; 
}

//-------------------------------------**-- 1)Alta de CATEGORIAS ---**-----------------------------------------------------------

//función que cuenta el numero de categorias y los almacene en array asociativo
function contarNombresCategoria($conn){
    $stmt = $conn->prepare("SELECT count(nombre) FROM CATEGORIA");
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();
    var_dump($arrayAso);
    return $arrayAso;
    
}


//Una vez contadas los categorias con función contarNombresCategoria($conn) lo recorremos con foreach y añadimos nuevo codigo autoincreamentado con C-OOX
function incremCategoria($lineas){
    foreach($lineas as $row) {
        $numCategoria = $row["count(nombre)"];
    }

        $numCategoria++;
        $numCategoria=str_pad($numCategoria,3,"0",STR_PAD_LEFT);
        $codigoIncreCateg="C-".$numCategoria;
        return $codigoIncreCateg;

}

function nueva_Categoria($conn,$incre, $categoria){
    $stmt = $conn->prepare("INSERT INTO CATEGORIA (id_categoria, nombre) VALUES(:id_categoria,:nombre);");     

    $stmt -> bindParam(':id_categoria',$incre);
    $stmt -> bindParam(':nombre',$categoria);
    
    $stmt->execute();
    echo "<br>";
    echo "Nueva categoria $categoria se ha dado de alta";
}

//-----------COMPARO NoMBRES DE categorias antiguos(array $resultado) con el nuevoNOMBRE(variable $new_categoria) introducido
function compararNombresCATEGORIAS($conn, $new_categoria){  //devuelve true si hay un nombre igual
    $stmt = $conn->prepare("SELECT nombre  FROM CATEGORIA");     

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    //var_dump($resultado);
    if(empty($resultado)){ //Si la tabla esta vacia
       return false;
    }else{
        for($i = 0; $i < count($resultado); $i++) {
            // var_dump($resultado[$i]["nombre"]);
            $arrayNombres[]= $resultado[$i]["nombre"];
         }
           var_dump($arrayNombres);
           //echo in_array($new_categoria, $arrayNombres, true);
           if(in_array($new_categoria, $arrayNombres, true)){
             return true; //hay un nombre repetido encontrado
           }else{
             return false;
           }
    }     
}

//-------------------------------------**--  2) Alta de Productos ---**-----------------------------------------------------------
//Pasamos como atributo la conexión y mediante una select mostramos valores de codigo de departamento y nombre de la tabla departamento.
//Creamos array asociativo y guardandolo en la variable $arrayAso retornamos el resultado de la función
function verCategorias($conn){
        $stmt = $conn->prepare("SELECT id_categoria, nombre FROM categoria");
        $stmt->execute();
    
        $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arrayAso = $stmt->fetchAll();

        return $arrayAso;
}

//función que cuenta el numero de categorias y los almacene en array asociativo
function contarNombresProducto($conn){
    $stmt = $conn->prepare("SELECT count(nombre) FROM PRODUCTO");
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();
    var_dump($arrayAso);
    return $arrayAso;
    
}


//Una vez contadas los categorias con función contarNombresCategoria($conn) lo recorremos con foreach y añadimos nuevo codigo autoincreamentado con C-OOX
function incremProducto($lineas){
    foreach($lineas as $row) {
        $numCategoria = $row["count(nombre)"];
    }
        $numCategoria++;
        $numCategoria=str_pad($numCategoria,4,"0",STR_PAD_LEFT);
        $codigoIncreCateg="P".$numCategoria;
        return $codigoIncreCateg;
}

function nuevo_Producto($conn,$incre, $nomProducto, $precio, $id_categoria){
    $stmt = $conn->prepare("INSERT INTO PRODUCTO (id_producto, nombre, precio, id_categoria) VALUES(:id_producto,:nombre, :precio, :id_categoria);");     

    $stmt -> bindParam(':id_producto',$incre);
    $stmt -> bindParam(':nombre',$nomProducto);
    $stmt -> bindParam(':precio',$precio);
    $stmt -> bindParam(':id_categoria',$id_categoria);

    $stmt->execute();
    echo "<br>";
    echo "Nuevo producto $nomProducto se ha dado de alta";
}

//COMPARO NoMBRES DE DPTOs antiguos(array $resultado) con el nuevoNOMBRE(variable $dpto) introducido
function compararNombresPRODUCTS($conn, $dpto){  //devuelve true si hay un nombre igual
    $stmt = $conn->prepare("SELECT nombre  FROM PRODUCTO");     

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    //var_dump($resultado);
    if(empty($resultado)){ //Si la tabla esta vacia
       return false;
    }else{
        for($i = 0; $i < count($resultado); $i++) {
            // var_dump($resultado[$i]["nombre"]);
            $arrayNombres[]= $resultado[$i]["nombre"];
         }
           var_dump($arrayNombres);
           //echo in_array($dpto, $arrayNombres, true);
           if(in_array($dpto, $arrayNombres, true)){
             return true; //hay un nombre repetido encontrado
           }else{
             return false;
           }
    }     
}

//--------------------------*** 3)Alta de Almacenes (comaltaalm.php)--***--------------------------------------------

function nuevo_Almacen($conn, $new_localidad){
    $stmt = $conn->prepare("INSERT INTO ALMACEN (localidad) VALUES(:localidad);");     

    $stmt -> bindParam(':localidad',$new_localidad);
    
    $stmt->execute();
    echo "<br>";
    echo "Se ha dado de alta un nuevo Almacen en la localidad de $new_localidad ";
}

//--------------------------*** 4)Aprovisionar Productos (comaprpro.php)--***--------------------------------------------

function verProductos($conn){
    $stmt = $conn->prepare("SELECT id_producto, nombre FROM producto");
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}

function verNumAlmacen($conn){
    $stmt = $conn->prepare("SELECT num_almacen FROM almacen");
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}

//VER SI el PRODUCTO(ID) EN ALMACENA EXISTE O NO  EN UN DETERMINADO NUM_ALMACEN
function verSiProductoExisteEnALMACENA($conn, $num_almacen, $id_producto){
    $stmt = $conn->prepare("SELECT num_almacen, id_producto FROM ALMACENA WHERE ALMACENA.id_producto=:id_producto AND  ALMACENA.num_almacen=:num_almacen");     
    $stmt -> bindParam(':num_almacen',$num_almacen);
    $stmt -> bindParam(':id_producto',$id_producto);

    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll(); 
    
    return  $arrayAso;
   
}
function asignarCantidad($conn, $num_almacen, $id_producto, $cantidad){
    $stmt = $conn->prepare("INSERT INTO ALMACENA (num_almacen, id_producto, cantidad) VALUES(:num_almacen, :id_producto, :cantidad);");     

    $stmt -> bindParam(':num_almacen',$num_almacen);
    $stmt -> bindParam(':id_producto',$id_producto);//fu
    $stmt -> bindParam(':cantidad',$cantidad);

    $stmt->execute();
    echo "<br>";
    echo "La cantidad $cantidad se ha asignado correctamente al producto con id $id_producto";
}

//Va incrementando la cantidad en un determinado num_almacen
function actualizarCantidadDeProductoExistente($conn, $num_almacen, $id_producto, $cantidad){
    $stmt = $conn->prepare("UPDATE ALMACENA SET cantidad=cantidad + :cantidad WHERE id_producto=:id_producto AND num_almacen=:num_almacen;");     

    $stmt -> bindParam(':num_almacen',$num_almacen);
    $stmt -> bindParam(':cantidad',$cantidad);
    $stmt -> bindParam(':id_producto',$id_producto);

    $stmt->execute();
    echo "<br>";
    echo "La cantidad $cantidad se ha aumentado correctamente al producto con id $id_producto en almacen $num_almacen";
}

//--------------------------***  5)Consulta de Stock (comconstock.php)   ***--------------------------------------------

function verStockDisponible($conn, $id_producto){
    $stmt = $conn->prepare("SELECT producto.nombre, almacena.num_almacen, almacena.id_producto, almacena.cantidad FROM almacena, producto WHERE producto.id_producto=almacena.id_producto AND producto.id_producto=:id_producto");     

    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll(); 
    
    return  $arrayAso;
}

//--------------------------***  6)Consulta de Almacenes (comconsalm.php)   ***--------------------------------------------
function verProductosEnAlmacen($conn, $num_almacen){
    $stmt = $conn->prepare("SELECT producto.nombre, producto.precio, producto.id_categoria, almacena.num_almacen, almacena.id_producto, almacena.cantidad FROM almacena, producto WHERE producto.id_producto=almacena.id_producto AND almacena.num_almacen=:num_almacen");     

    $stmt -> bindParam(':num_almacen',$num_almacen);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll(); 
    
    return  $arrayAso;
}

//--------------------------***  7)Consulta de Compras (comconscom.php)   ***--------------------------------------------
function verNifs($conn){
    $stmt = $conn->prepare("SELECT nif FROM cliente");
    
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();
    
    return  $arrayAso;
}

function infoComprasIntervalo($conn, $nif, $fechaDesde, $fechaHasta){
    $stmt = $conn->prepare("SELECT producto.id_producto, producto.nombre, producto.precio, compra.fecha_compra, compra.unidades FROM compra, producto WHERE producto.id_producto=compra.id_producto AND compra.nif=:nif AND fecha_compra BETWEEN :fechaDesde AND :fechaHasta");     

    $stmt -> bindParam(':nif',$nif);
    $stmt -> bindParam(':fechaDesde',$fechaDesde);
    $stmt -> bindParam(':fechaHasta',$fechaHasta);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll(); 
    
    return  $arrayAso;
}


function montoTotalComprasIntervalo($conn, $nif, $fechaDesde, $fechaHasta){
    $stmt = $conn->prepare("SELECT SUM(compra.unidades * producto.precio) FROM compra, producto WHERE producto.id_producto=compra.id_producto AND compra.nif=:nif AND fecha_compra BETWEEN :fechaDesde AND :fechaHasta");     

    $stmt -> bindParam(':nif',$nif);
    $stmt -> bindParam(':fechaDesde',$fechaDesde);
    $stmt -> bindParam(':fechaHasta',$fechaHasta);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll(); 
    
    return  $arrayAso;
}

//-------------------**----8) ALTA CLIENTES--***-------------------------------
//COMPARO NIFS (array $resultado) con el nuevo NIF(variable $dpto) introducido
function compararNIFs($conn, $nif){  //devuelve true si hay un nombre igual
    $stmt = $conn->prepare("SELECT nif  FROM CLIENTE");     

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    var_dump($resultado);
    if(empty($resultado)){ //Si la tabla esta vacia
       return false;
    }else{
        for($i = 0; $i < count($resultado); $i++) {
             var_dump($resultado[$i]["nif"]);
            $arrayNombres[]= $resultado[$i]["nif"];
         }
           var_dump($arrayNombres);
           //echo in_array($dpto, $arrayNombres, true);
           if(in_array($nif, $arrayNombres, true)){
             return true; //hay un nombre repetido encontrado
           }else{
             return false;
           }
    }     
}

//VALIDAR NIF introducido
function validarNIF($nif){  //devuelve true si hay un nombre igual
    $esNIF=true;
    if(strlen($nif)!=9){ //Si la longitud es diferente de 9
        $esNIF=false;
    }else{
        $numeros=substr($nif,0,8);
        var_dump($numeros);
        $letra=substr($nif,8,1);
        var_dump($letra);
       if(ctype_digit(strval($numeros))==false){
         $esNIF=false;
       }

       if(ctype_alpha(strval($letra))==false){
        $esNIF=false;
      }
    }     
    return $esNIF;
}


function nuevo_Cliente($conn, $nif, $nombre, $apellido, $cp, $direccion, $ciudad){
    $stmt = $conn->prepare("INSERT INTO CLIENTE (nif, nombre, apellido, cp, direccion, ciudad) VALUES(:nif,:nombre, :apellido, :cp, :direccion, :ciudad);");     

    $stmt -> bindParam(':nif',$nif);
    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':apellido',$apellido);
    $stmt -> bindParam(':cp',$cp);
    $stmt -> bindParam(':direccion',$direccion);
    $stmt -> bindParam(':ciudad',$ciudad);
    $stmt->execute();
    echo "<br>";
    echo "El cliente con NIF $nif se ha dado de alta";
}

//-------------------**---- 9) Compra de Productos (compro.php) --***-------------------------------

//COMPARO el NIF introducido con los que estan dados de alta
function nifDadoDeAlta($conn, $nif){  //devuelve true si hay un nif que coincide
    $stmt = $conn->prepare("SELECT nif  FROM CLIENTE");     

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    //var_dump($resultado);
    if(empty($resultado)){ //Si la tabla esta vacia
       return false;
    }else{
        for($i = 0; $i < count($resultado); $i++) {
            // var_dump($resultado[$i]["nombre"]);
            $arrayNifs[]= $resultado[$i]["nif"];
         }
           //var_dump($arrayNifs); //descomentar luego!!
           //echo in_array($dpto, $arrayNombres, true);
           if(in_array($nif, $arrayNifs, true)){
             return true; //hay un nombre repetido encontrado
           }else{
             return false;
           }
    }     
}

//solo se mustran los productos con cantidad que no sea CERO
function verProductosDisponibles($conn){
    $stmt = $conn->prepare("SELECT distinct almacena.id_producto, producto.nombre FROM producto, almacena WHERE producto.id_producto=almacena.id_producto AND almacena.cantidad>0 ");
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}








// !!!! comprobar la cantidad del producto en ALMACENA (StockporProductoAntesdeCompra). ex. Si quedan 2 bacalaos no se puede comprar 3 bacalaos. Que de error en ese escenario
function comprobarStockporProductoAntesdeCompra($conn, $id_producto){
    $stmt = $conn->prepare("SELECT producto.nombre, almacena.num_almacen, almacena.id_producto, almacena.cantidad FROM producto, almacena WHERE producto.id_producto=almacena.id_producto AND producto.id_producto=:id_producto ");
    
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}












function comprarUnProducto($conn, $nif, $id_producto, $fecha_compra, $unidades){
    $stmt = $conn->prepare("INSERT INTO COMPRA (nif, id_producto, fecha_compra, unidades) VALUES(:nif, :id_producto, :fecha_compra, :unidades);");  
    
    $stmt -> bindParam(':nif',$nif);
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt -> bindParam(':fecha_compra',$fecha_compra);
    $stmt -> bindParam(':unidades',$unidades);
    $stmt->execute();

    echo "<br>";
    echo "El cliente con NIF $nif ha comprado $unidades unidades de $id_producto con fecha de compra $fecha_compra";
}



//GUAAAAAAAAAAA****::

//Ver el numero total de almacenes en el q se encuentra un determinado producto
function contarAlmacenesEnALMACENA($conn, $id_producto){
    $stmt = $conn->prepare("SELECT count(almacena.num_almacen) FROM almacena WHERE almacena.id_producto=:id_producto ");
    
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}

//gahhhhh  ver LA CANTIDAD DE PRODUCTO EN CADA ALMACEN
function comprobarNumAlmacenALMACENA($conn, $id_producto){
    $stmt = $conn->prepare("SELECT producto.nombre, almacena.num_almacen, almacena.id_producto, almacena.cantidad FROM producto, almacena WHERE producto.id_producto=almacena.id_producto AND producto.id_producto=:id_producto ");
    
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();
    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();

    return $arrayAso;
}

function arrayConIDs_PRODUCTO($conn, $id_producto){
    $stmt = $conn->prepare("SELECT almacena.id_producto FROM almacena WHERE id_producto=:id_producto AND cantidad>0 ");
    
    $stmt -> bindParam(':id_producto',$id_producto);

    $stmt->execute();
    $arrayAsoIDs = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAsoIDs = $stmt->fetchAll();
    return $arrayAsoIDs;
}
//   NOW
//array con datos de un determinado producto(id_producto)
function actualizarTablaAlmacenaTrasCompra1($conn, $id_producto){
    $stmt = $conn->prepare("SELECT almacena.num_almacen, almacena.id_producto, almacena.cantidad FROM almacena WHERE almacena.id_producto=:id_producto ");
    
    $stmt -> bindParam(':id_producto',$id_producto);
    //$stmt -> bindParam(':unidades',$unidades);

    $stmt->execute();
    $arrayAsoTodasFilas = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAsoTodasFilas = $stmt->fetchAll();
    return $arrayAsoTodasFilas;
}

function actualizarTablaAlmacenaTrasCompra2($conn,$arrayNum_almacenes, $id_producto,  $unidades, $cantidadQueQueda, $quitar){ //FALTA NUM_ALMACEN
    $stmt = $conn->prepare("UPDATE ALMACENA SET cantidad=:cantidadQueQueda WHERE id_producto=:id_producto AND num_almacen=:num_almacen; ");
    $stmt -> bindParam(':num_almacen',$arrayNum_almacenes);
    $stmt -> bindParam(':cantidadQueQueda',$cantidadQueQueda);
   // $stmt -> bindParam(':quitar',$quitar); //
    $stmt -> bindParam(':id_producto',$id_producto);
    //$stmt -> bindParam(':unidades',$unidades);//
    $stmt->execute();
    var_dump($cantidadQueQueda);
    var_dump(max(0, $unidades - $quitar));
    return max(0, $unidades - $quitar);
}


//no uso esto:
function actualizarTablaAlmacenaTrasCompra($conn, $id_producto, $unidades){
    $stmt = $conn->prepare("UPDATE ALMACENA SET cantidad=cantidad - :unidades WHERE id_producto=:id_producto AND cantidad>=0; ");

    $stmt -> bindParam(':unidades',$unidades);
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();

    echo "<br>";
    echo "Cantidad en tabla ALMACENA se ha actualizado ";
}






















//------------------10. REGISTRO DE CLIENTES-----------------
function registrar_cliente($conn, $nif, $nombre, $apellido, $cp, $direccion, $ciudad){ //BIEN  . EN USO
    $usuario=strtolower($nombre);
    $clave=strrev(strtolower($apellido));

    $stmt = $conn->prepare("INSERT INTO CLIENTE (nif, nombre, apellido, cp, direccion, ciudad, usuario, clave) VALUES(:nif,:nombre, :apellido, :cp, :direccion, :ciudad, :usuario, :clave);");     

    $stmt -> bindParam(':nif',$nif);
    $stmt -> bindParam(':nombre',$nombre);
    $stmt -> bindParam(':apellido',$apellido);
    $stmt -> bindParam(':cp',$cp);
    $stmt -> bindParam(':direccion',$direccion);
    $stmt -> bindParam(':ciudad',$ciudad);
    $stmt -> bindParam(':usuario',$usuario);
    $stmt -> bindParam(':clave',$clave);
    $stmt->execute();
    echo "<br>";
    echo "El cliente con NIF $nif ha sido registrado. Su usuario es $usuario";
}

function registrar_Usuario($conn,$nombre, $apellido){ //NO ME SIRVE AHORA, NO USO ESTA FUNCION
    $usuario=strtolower($nombre);
    $apellido=strrev(strtolower($apellido));
    $stmt = $conn->prepare("INSERT INTO REGISTRA (usuario, clave) VALUES(:usuario,:clave);");     

    $stmt -> bindParam(':usuario',$nombre);
    $stmt -> bindParam(':clave',$apellido);

    $stmt->execute();
    echo "<br>";
    echo "El cliente se ha dado registrado con el usuario $nombre";
}

function insertar_UsuarioEnCLIENTE($conn, $nombre, $nif){//NO ME SIRVE AHORA, NO USO ESTA FUNCION
    $nombre=strtolower($nombre);
    $stmt = $conn->prepare("UPDATE CLIENTE SET usuario= :usuario WHERE nif=:nif;");     

    $stmt -> bindParam(':usuario',$nombre);
    $stmt -> bindParam(':nif',$nif);

    $stmt->execute();
    echo "<br>";
    echo "Se ha actualizado el campo USUARIO $nombre en la tabla CLIENTE";
}

//------------------11. LOGIN DE CLIENTES / INICIO DE SESION-----------------

//COMPRUEBO SI EL USUARIO Y CLAVE introducidos coinciden con los que estan registrados
function loginCliente($conn, $username, $password){  //devuelve true si hay un nif que coincide
    $stmt = $conn->prepare("SELECT usuario, clave  FROM CLIENTE WHERE usuario=:username;");     

    $stmt -> bindParam(':username',$username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    var_dump($resultado);
    if(empty($resultado)){ //Si la tabla/array esta vacia
       echo "Nombre de USUARIO erróneo. Vuelva a intentarlo por favor";
    }else{
       // var_dump($resultado);
     
        for($i = 0; $i < count($resultado); $i++) {
            // var_dump($resultado[$i]["nombre"]);
            $arrayClave[]= $resultado[$i]["clave"];
         }
           var_dump($arrayClave);
           if(in_array($password, $arrayClave, true)){
             return true; //el usuario coincide con su clave. SI es un usuario registrado
           }else{
             return false; //NO coincide el usuario con su clave correspondiente
           }
          
    }     
}




function extraerNIF($conn, $username){  //devuelve true si hay un nif que coincide
    $stmt = $conn->prepare("SELECT nif  FROM CLIENTE WHERE usuario=:username;");     

    $stmt -> bindParam(':username',$username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $resultado=$stmt->fetchAll();
    
    //var_dump($resultado);
    if(empty($resultado)){ //Si la tabla/array esta vacia
       echo "Nombre de USUARIO erróneo. Vuelva a intentarlo por favor";
    }else{
       // var_dump($resultado);
     
        for($i = 0; $i < count($resultado); $i++) {
            // var_dump($resultado[$i]["nombre"]);
            $stringNif= $resultado[$i]["nif"];
         }
           //var_dump($arrayNif);    
           return $stringNif;
    }     
}

//---------------------------------------------------


function verPrecioProductos($conn, $id_producto){
    $stmt = $conn->prepare("SELECT precio FROM PRODUCTO WHERE producto.id_producto=:id_producto ");
    
    $stmt -> bindParam(':id_producto',$id_producto);
    $stmt->execute();

    $arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrayAso = $stmt->fetchAll();
   //var_dump($arrayAso);
    return $arrayAso;
}


?>
