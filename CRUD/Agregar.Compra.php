<?php
// Incluir archivo de configuración y conexión a la base de datos
require("../Config/Conexion.php");

// Obtener valores del formulario
$producto = isset($_POST['producto']) ? $_POST['producto'] : null;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
$subtotal = isset($_POST['subtotal']) ? floatval($_POST['subtotal']) : 0;
$fecha = date("Y-m-d");

// Definir consulta SQL para la inserción de datos
$sql = "INSERT INTO compras (producto, cantidad, precio, Subtotal, fecha) 
        VALUES (?, ?, ?, ?, ?)";

// Preparar la consulta SQL
$stmt = $conexion->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt) {
    // Vincular parámetros
    $stmt->bind_param("siids", $producto, $cantidad, $precio, $subtotal, $fecha);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a la página principal después de la inserción exitosa
        header("Location: ../Index.php");
        exit;
    } else {
        // Mostrar mensaje de error en caso de fallo en la ejecución de la consulta
        echo "Error al guardar los datos en la base de datos.";
    }

    // Cerrar la declaración preparada
    $stmt->close();
} else {
    // Mostrar mensaje de error en caso de fallo al preparar la consulta
    echo "Error al preparar la consulta.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
