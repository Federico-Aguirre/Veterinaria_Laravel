@if(!empty($_POST["btnlogin"])) {
    @if(empty($_POST["inputUsuariologin"]) and empty($_POST["inputContraseñalogin"])) {
        echo '<script type="text/javascript">
        alert("Escriba usuario y contraseña");
        </script>';
    } @else {
        $usuario = $_POST["inputUsuariologin"];
        $contraseña = $_POST["inputContraseñalogin"];
        $query=$connect->query(" select * from usuarios where Usuario='$usuario' and Contraseña='$contraseña' ");
        $row = mysqli_fetch_array($query);
        $sql=$connect->query(" select * from usuarios where Usuario='$usuario' and Contraseña='$contraseña' ");
        @if($datos=$sql->fetch_object()) {
            $_SESSION["sessionUsuario"] = $usuario;
            $_SESSION["sessionContraseña"] = $contraseña;
            $_SESSION["sessionId"] = $row['Id'];
            @if($row['administrador'] == 1) {
                $_SESSION["esAdministrador"] = 1;
            } @else {
                $_SESSION["esAdministrador"] = 0;
            } @endif

            // Verificar si es administrador
            $_SESSION["esAdministrador"] = ($row['administrador'] == 1) ? 1 : 0;
            // Retornar una respuesta JSON a JavaScript con un valor
            echo json_encode([
                "success" => true, 
                "esAdministrador" => $_SESSION["esAdministrador"],
                "mensaje" => "login correcto"
            ]);

            $idUsuarioActual = $_SESSION["sessionId"];
            $suma = mysqli_query($connect, "SELECT SUM(producto_cantidad) as total FROM carro_de_compras WHERE id_cliente = '$idUsuarioActual'");
            $rowSuma = mysqli_fetch_array($suma);
            $sumaResultado = $rowSuma['total'];
            $_SESSION["cantidadDeProductosEnCarro"] = $sumaResultado;
            
            header("location:index.php");
        } @else {
            echo '<script type="text/javascript">
            alert("usuario no existe");
            </script>';
        } @endif
    } @endif
} @endif