<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==3 ){
    include_once 'layouts/header.php';
?>

  <title>Adm | Editar Datos</title>
<?php
    include_once 'layouts/nav.php';
?>
<!-- Modal logo -->
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
        <div class="alert alert-success text-center" id="edit-prov" style='display:none;'>
                <span><i class="fas fa-check m-1" ></i>El logo se editó</span>
        </div>
        <div class="alert alert-danger text-center" id="noedit-prov" style='display:none;'>
                <span><i class="fas fa-times m-2"></i>Formato no soportado</span>
        </div>
        <form id="form-logo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
               <input type="file" name="photo" class="input-group">
               <input type="hidden" name="funcion" id="funcion">
               <input type="hidden" name="id_logo_prov" id="id_logo_prov">
               <input type="hidden" name="avatar" id="avatar">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

Button trigger modal-->
<div class="modal fade" id="crearproveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Crear Proveedor</h3>
                <button data-dismiss="modal" aria-label="close" class="close">
                    <span araia-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="alert alert-success text-center" id="add-prov" style='display:none;'>
                        <span><i class="fas fa-check m-1" ></i>Se agrego correctamente</span>
               </div>
                <div class="alert alert-danger text-center" id="noadd-prov" style='display:none;'>
                        <span><i class="fas fa-times m-2"></i>El Proveedor ya existe</span>
                </div>
                <form id="form-crear">
                    <div class="form-group">
                         <label form="nombre">Nombres</label>
                         <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre" required> 
                    </div>
                    <div class="form-group">
                         <label form="telefono">Telefono</label>
                         <input id="telefono" type="number" class="form-control" placeholder="Ingrese telefono" required> 
                    </div>
                    <div class="form-group">
                         <label form="correo">Correo</label>
                         <input id="correo" type="email" class="form-control" placeholder="Ingrese correo"> 
                    </div>
                    <div class="form-group">
                         <label form="direccion">Direccion</label>
                         <input id="direccion" type="text" class="form-control" placeholder="Ingrese direccion" required> 
                    </div>
                    <input type="hidden" id="id_edit_prov">
                
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
            <h1>Gestión proveedor   <button type="button" data-toggle="modal" data-target="#crearproveedor" class="btn bg-gradient-primary ml-2">Crear proveedor</button></h1>            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión proveedor</li>
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
                    <h3 class="card-title">Buscar proveedor</h3>
                    <div class="input-group">
                        <input type="text" id="buscar_proveedor" class="form-control float-left" placeholder="Ingrese nombre de proveedor">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                   </div>
                   <div class="card-body">
                      <div id="proveedores" class="row d-flex align-items-stretch">  
                        
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
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/Proveedor.js"></script>