<?php
// Incluir el archivo de configuración de conexión a la base de datos
require("../Config/Conexion.php");

// Sentencia SQL para truncar la tabla Compras
$sql = "TRUNCATE TABLE Compras";

// Ejecutar la sentencia
if ($conexion->query($sql) === TRUE) {
    // Redireccionar a la página principal después de truncar la tabla
    header("Location: ../Index.php");
    exit;
} else {
    // En caso de error, mostrar un mensaje de error
    echo "Error al truncar la tabla: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
