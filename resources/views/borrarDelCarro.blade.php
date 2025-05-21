include("conexion.php");
$con = mysqli_connect($host, $user, $pass, $bd);

$productId = $_POST['productId'];

$sql = "DELETE FROM carro_de_compras WHERE producto_id = '$productId'";
$query = mysqli_query($con, $sql);

$suma = mysqli_query($connect, "SELECT SUM(producto_cantidad) as total FROM carro_de_compras");
$rowSuma = mysqli_fetch_array($suma);
$sumaResultado = $rowSuma['total'];
$_SESSION["cantidadDeProductosEnCarro"] = $sumaResultado;

@if($query){
    echo '<script type="text/javascript">
    alert("Producto borrado con exito");
    window.location = "http://localhost:3000/php/stock.php";
    </script>';
} @else {
 echo '';
}
@endif