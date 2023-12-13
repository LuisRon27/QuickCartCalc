<?php
// Incluir el archivo de conexión a la base de datos
require("../Config/Conexion.php");

// Verificar si se proporcionó el parámetro 'Id' en la URL
if (isset($_GET['Id'])) {
    $productoId = $_GET['Id'];

    // Realizar la eliminación del producto en la base de datos
    $sql = "DELETE FROM Compras WHERE Id = $productoId";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si la eliminación fue exitosa
    if ($resultado) {
        // Redirigir a la página principal después de la eliminación
        header("Location: ../Index.php");
    } else {
        // Mostrar un mensaje de error si la eliminación falla
        echo "Error al eliminar el Producto: " . mysqli_error($conexion);
    }
} else {
    // Mostrar un mensaje si no se proporcionó el parámetro 'Id'
    echo "Id no proporcionado.";
}
?>
