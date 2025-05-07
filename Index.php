<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCartCalc - Calculadora de Compras</title>
    <!-- Archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #2e59d9;
        --accent-color: #f8f9fc;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }

    .card {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .total-container {
        background-color: var(--accent-color);
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-top: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .total-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    .table-header th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .margencolum {
        vertical-align: middle;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .page-link {
        color: var(--primary-color);
    }

    footer {
        background-color: var(--accent-color);
        border-radius: 0.5rem;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }

        .display-5 {
            font-size: 2rem;
        }
    }
    </style>
</head>

<body>

    <!-- Spinner -->
    <!-- <div id="loader" class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div> -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-cart4 me-2"></i>QuickCartCalc
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-house-door me-1"></i> Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <div class="container py-4">

        <!-- Encabezado -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-3">Calculadora de Compras</h1>
            <p class="lead text-muted">Agrega productos, calcula cantidades y lleva el control de tus gastos</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!-- Formulario de Compra -->
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Producto
                    </div>
                    <div class="card-body">
                        <form method="post" action="./CRUD/Agregar.Compra.php" id="compraForm">
                            <div class="mb-3">
                                <label for="producto" class="form-label">Producto:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                    <input type="text" name="producto" class="form-control"
                                        placeholder="Ej: Leche, Pan..." required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                                        <input type="number" name="cantidad" class="form-control" placeholder="0"
                                            required id="cantidad" oninput="actualizarSubtotal()">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="precio" class="form-label">Precio por unidad:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="precio" step="0.01" class="form-control"
                                            placeholder="0.00" required id="precio" oninput="actualizarSubtotal()">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subtotal" class="form-label">Subtotal:</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="subtotalDisplay" placeholder="0.00"
                                        disabled>
                                </div>
                            </div>

                            <!-- Input subtotal oculto -->
                            <input type="hidden" name="subtotal" id="subtotal" required>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-primary me-md-2">
                                    <i class="bi bi-cart-plus me-1"></i> Agregar
                                </button>
                                <a onclick="return confirm('¿Seguro que desea eliminar Todos los Registros?');"
                                    href="./CRUD/EliminarRegistros.Compra.php" class="btn btn-danger">
                                    <i class="bi bi-trash3-fill me-1"></i> Limpiar Todo
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Resumen de Compra -->
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-receipt me-2"></i>Resumen de Compra
                    </div>
                    <div class="card-body">
                        <?php
                            include("./Config/Conexion.php");
                            $sql = $conexion->query("SELECT SUM(Subtotal) AS TotalCantidad FROM Compras;");
                
                            $total = 0;
                            while ($resultado = $sql->fetch_assoc()) {
                                $total = $resultado['TotalCantidad'] ? $resultado['TotalCantidad'] : 0;
                            }
                        ?>
                        <div class="total-container text-center">
                            <h5 class="mb-3">Total Acumulado</h5>
                            <div class="total-amount">$ <?php echo number_format($total, 2); ?></div>
                            <p class="text-muted mt-2 mb-0">Total de todos los productos</p>
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Instrucciones</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><small>1. Completa los campos del formulario</small></li>
                                <li class="list-group-item"><small>2. El subtotal se calcula automáticamente</small>
                                </li>
                                <li class="list-group-item"><small>3. Haz clic en "Agregar" para guardar</small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles de la Compra -->
        <div class="card mt-4">
            <div class="card-header">
                <i class="bi bi-list-check me-2"></i>Detalles de la Compra
            </div>
            <div class="card-body">
                <!-- Campo de búsqueda -->
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto...">
                    </div>
                </div>

                <div class="table-responsive">
                    <?php include("./CRUD/Paginacion.php"); ?>

                    <!-- Tabla de registros -->
                    <table class="table table-hover">
                        <thead class="table-header">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio/unidad</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="text-center">Acciones</th>
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
                                <td class="margencolum">$<?php echo number_format($row['Precio'], 2); ?></td>
                                <td class="margencolum">$<?php echo number_format($row['Subtotal'], 2); ?></td>
                                <td class="margencolum action-buttons">
                                    <a href="./CRUD/Eliminar.Compra.php?Id=<?php echo $row['Id']; ?>"
                                        onclick="return confirm('¿Seguro que desea eliminar este Producto?');"
                                        class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- No hay registros -->
                    <div id="noRecordsMessage" class="alert alert-info text-center" style="display: none;">
                        <i class="bi bi-info-circle me-2"></i>No hay productos agregados aún
                    </div>

                    <!-- Paginación -->
                    <?php if($total_paginas > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ($pagina_actual <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>" tabindex="-1"
                                    aria-disabled="true">
                                    <i class="bi bi-chevron-left"></i> Anterior
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li class="page-item <?php echo ($i == $pagina_actual) ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php } ?>

                            <li class="page-item <?php echo ($pagina_actual >= $total_paginas) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>">
                                    Siguiente <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <p class="col-md-4 mb-0 text-muted">© <?php echo date("Y") ?> Luis Ron</p>
                <a href="#"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <i class="bi bi-cart4 me-2"></i>
                    <span class="fw-bold">QuickCartCalc</span>
                </a>
                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Inicio</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Archivo JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./Js/Script.js"></script>
    <script>
    // Función para actualizar el subtotal en tiempo real
    function actualizarSubtotal() {
        const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
        const precio = parseFloat(document.getElementById('precio').value) || 0;
        const subtotal = cantidad * precio;

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('subtotalDisplay').value = subtotal.toFixed(2);
    }

    // Ocultar spinner cuando la página cargue
    window.addEventListener('load', function() {
        document.getElementById('loader').style.display = 'none';
    });
    </script>
</body>

</html>