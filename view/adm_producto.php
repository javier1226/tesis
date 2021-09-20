<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
  include_once 'layouts/header.php';
?>

  <title>Adm | Editar Datos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>

  <!-- Button trigger modal crear Lote-->
  <div class="modal fade" id="crearlote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Crear Lote</h3>
            <button data-dismiss="modal" aria-label="close" class="close">
              <span araia-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="alert alert-success text-center" id="add-lote" style='display:none;'>
              <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
            </div>

            <form id="form-crear-lote">
              <div class="form-group">
                <label form="nombre_producto_lote">Producto: </label>
                <label id="nombre_producto_lote">Nombre de producto</label>                
              </div>
              <div class="form-group">
                <label form="proveedor">Proveedor: </label>
                <select name="proveedor" id="proveedor" class="form-control select2" style="width:100%"></select>
              </div>
              <div class="form-group">
                <label form="stock">Stock: </label>
                <input id="stock" type="number" class="form-control" placeholder="Ingrese Stock">
              </div>
              <div class="form-group">
                <label form="vencimiento">Vencimiento</label>
                <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese vencimiento">
              </div>
              <input type="hidden" id="id_lote_prod">

          </div>
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient-primary float-right m-2">Guardar</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-2">Cerrar </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de cambio de logo -->
  <div class="modal fade" id="cambiologo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id='logoactual' src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
          </div>
          <div class="text-center">
            <b id="nombre_logo">

            </b>
          </div>
          <div class="alert alert-success text-center" id="edit" style='display:none;'>
            <span><i class="fas fa-check m-1"></i>Se cambio el logo</span>
          </div>
          <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
            <span><i class="fas fa-times m-2"></i>Formato no soportado</span>
          </div>
          <form id="form-logo" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-5 mt-2">
              <input type="file" name="photo" class="input-group">
              <input type="hidden" name="funcion" id="funcion">
              <input type="hidden" name="id_logo_prod" id="id_logo_prod">
              <input type="hidden" name="avatar" id="avatar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn bg-gradient-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal crar Producto-->
  <div class="modal fade" id="crearproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Crear producto</h3>
            <button data-dismiss="modal" aria-label="close" class="close">
              <span araia-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="alert alert-success text-center" id="add" style='display:none;'>
              <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
            </div>
            <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
              <span><i class="fas fa-times m-1"></i>El producto ya existe</span>
            </div>
            <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
              <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>
            </div>
            <form id="form-crear-producto">
              <div class="form-group">
                <label form="nombre_producto">Nombre</label>
                <input id="nombre_producto" type="text" class="form-control" placeholder="Ingrese nombre" required>
              </div>
              <div class="form-group">
                <label form="concentracion">Concentración</label>
                <input id="concentracion" type="text" class="form-control" placeholder="Ingrese concentración">
              </div>
              <div class="form-group">
                <label form="adicional">Adicional</label>
                <input id="adicional" type="text" class="form-control" placeholder="Ingrese adicional">
              </div>
              <div class="form-group">
                <label form="precio">Precio</label>
                <input id="precio" type="number" step="any" class="form-control" value='1' placeholder="Ingrese Precio" required>
              </div>
              <div class="form-group">
                <label form="laboratorio">Laboratorio</label>
                <select name="laboratorio" id="laboratorio" class="form-control select2" style="width:100%"></select>
              </div>
              <div class="form-group">
                <label form="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control select2" style="width:100%"></select>
              </div>
              <div class="form-group">
                <label form="presentacion">Presentación</label>
                <select name="presentacion" id="presentacion" class="form-control select2" style="width:100%"></select>
              </div>
              <input type="hidden" id="id_edit_prod">

          </div>
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient-primary float-right m-2">Guardar</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-2">Cerrar </button>
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
            <h1>Gestión producto <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-primary ml-2">Crear producto</button></h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión producto</li>
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
            <h3 class="card-title">Buscar Producto</h3>
            <div class="input-group">
              <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Ingrese nombre de producto">
              <div class="input-group-append">
                <button class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="productos" class="row d-flex align-items-stretch">

            </div>
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
<script src="../js/Producto.js"></script>