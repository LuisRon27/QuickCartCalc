<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCartCalc</title>
    <!-- Archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <!-- Spinner -->
    <div id="loader" class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand mb-2 mt-2" href="#">"QuickCartCalc"</a>
        </div>
    </nav>

    <!-- Main -->
    <div class="container mt-5">

        <!-- Encabezado -->
        <div class="px-4 py-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis">Calculadora de Compras</h1>
        </div>

        <!-- Formulario de Compra -->
        <form method="post" action="./CRUD/Agregar.Compra.php" class="mb-4" id="compraForm">
            <div class="mb-3">
                <label for="producto" class="form-label">Producto:</label>
                <input type="text" name="producto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" required id="cantidad" oninput="actualizarSubtotal()">
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio por unidad:</label>
                <input type="number" name="precio" step="0.01" class="form-control" required id="precio" oninput="actualizarSubtotal()">
            </div>

            <!-- Input subtotal -->
            <input type="hidden" name="subtotal" id="subtotal" required>

            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Agregar a la compra</button>
                <a onclick="return confirm('¿Seguro que desea eliminar Todos los Registros?');" href="./CRUD/EliminarRegistros.Compra.php" class="btn btn-danger">Limpiar Tabla</a>
            </div>
        </form>

        <!-- Detalles de la Compra -->
        <div class="px-4 py-5 text-center">
            <h2 class="display-5 fw-bold text-body-emphasis">Detalles de la Compra</h2>
        </div>

        <div class="container">

            <!-- Campo de búsqueda -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar Producto">
            </div>

            <div class="table-responsive">

                <?php include("./CRUD/Paginacion.php"); ?>

                <!-- Tabla de registros -->
                <table class="table table-striped">
                    <thead class="table-dark text-center table-header">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio/unidad</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $resultado->fetch_assoc()) {
                            ?>
                            <tr>
                                <th class="margencolum" scope="row"><?php echo $row['Id']; ?></th>
                                <td class="margencolum"><?php echo $row['Producto']; ?></td>
                                <td class="margencolum"><?php echo $row['Cantidad']; ?></td>
                                <td class="margencolum"><?php echo $row['Precio']; ?></td>
                                <td class="margencolum"><?php echo $row['Subtotal']; ?></td>
                                <td class="margencolum" scope="row" class="d-flex justify-content-center" style="gap: 1rem; padding: 1.5rem 0.5rem;">
                                    <a href="./CRUD/Eliminar.Compra.php?Id=<?php echo $row['Id']; ?>" onclick="return confirm('¿Seguro que desea eliminar este Producto?');" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Paginación -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li class="page-item <?php echo ($i == $pagina_actual) ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                        </li>
                    </ul>
                </nav>

                <!-- No hay registros -->
                <div id="noRecordsMessage" class="alert alert-warning text-center" style="display: none;">No hay registros</div>

            </div>

        </div>

        <?php
            require("./Config/Conexion.php");

            $sql = $conexion->query("SELECT SUM(Subtotal) AS TotalCantidad FROM Compras;");

            while ($resultado = $sql->fetch_assoc()) {
        ?>
            <h5>Total Acumulado: $ <?php echo $resultado['TotalCantidad'] ?></h5>
        <?php
            }
        ?>

    </div>

    <!-- Footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© <?php echo date("Y") ?> Luis Ron</p>
            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                "QuickCartCalc"
            </a>
        </footer>
    </div>

    <!-- Archivo JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./Js/Script.js"></script>

</body>

</html>