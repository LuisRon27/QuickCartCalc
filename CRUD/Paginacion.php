<?php
    require("./Config/Conexion.php");

    // Configuración de la paginación
    $registros_por_pagina = 5;
    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $inicio = ($pagina_actual - 1) * $registros_por_pagina;

    // Consulta SQL con paginación
    $sql = "SELECT Id, Producto, Cantidad, Precio, Subtotal FROM Compras LIMIT $inicio, $registros_por_pagina";
    $resultado = $conexion->query($sql);

    // Obtener el número total de registros para calcular el número de páginas
    $total_registros = $conexion->query("SELECT COUNT(*) as total FROM Compras")->fetch_assoc()['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);
?>