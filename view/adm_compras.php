<?php
session_start();
if ($_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
?>

    <title>Adm | Gestión Compras</title>
    <?php
    include_once 'layouts/nav.php';
    ?>

<div class="modal fade" id="vista_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Detalle compra</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span araia-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="for-group">
                            <label for="codigo_compra">Codigo compra: </label>
                            <span id="codigo_compra"></span>
                        </div>
                        <div class="for-group">
                            <label for="fecha_compra">Fecha de compra: </label>
                            <span id="fecha_compra"></span>
                        </div>
                        <div class="for-group">
                            <label for="fecha_entrega">Fecha de entrega: </label>
                            <span id="fecha_entrega"></span>
                        </div>
                        <div class="for-group">
                            <label for="estado">Estado: </label>
                            <span id="estado"></span>
                        </div>
                        <div class="for-group">
                            <label for="proveedor">Proveedor: </label>
                            <span id="proveedor"></span>
                        </div>

                        <table class="table table-hover text-nowrap table-responsive">
                            <thead class="table-success">
                                <tr>
                                    <th># </th>
                                    <th>Codigo </th>
                                    <th>Cantidad </th>
                                    <th>Vencimiento </th>
                                    <th>Precio Compra </th>
                                    <th>Producto </th>
                                    <th>Laboratorio </th>
                                    <th>Presentacion </th>
                                    <th>Tipo </th>
                                </tr>
                            </thead>
                            <tbody class="table-warning" id="detalles">

                            </tbody>
                        </table>
                        <div class="float-right input-group-append">
                            <h3 class="m-3">Total: </h3>
                            <h3 class="m-3" id="total"></h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-2">Cerrar </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cambiar_estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Cambiar estado</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span araia-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
                            <span><i class="fas fa-times m-1"></i>No se pudo editar</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit" style='display:none;'>
                            <span><i class="fas fa-check m-1"></i>Se cambio el estado</span>
                        </div>
                        <form id="form-editar">
                            <div class="form-group">
                                <label form="estado_compra">Estado</label>
                                <select id="estado_compra" class="form-control select2" style="width:100%"></select>
                                <input type="hidden" id="id_compra">
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión compras <a class="btn bg-gradient-primary ml-2" href="adm_ingresar_compra.php">Crear compra</a></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión compras</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar lote</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-lote" class="form-control float-left" placeholder="Ingrese nombre de producto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="compras" class="table table-dark table-hover ">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>ID | Codigo</td>
                                    <td>Fecha de Compra</td>
                                    <td>Fecha de Entrega</td>
                                    <td>Total</td>
                                    <td>Estado</td>
                                    <td>Proveedor</td>
                                    <td>Operaciones</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/Compras.js"></script>