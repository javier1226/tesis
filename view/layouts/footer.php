<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <!--<b>Version</b> 3.0.4-->
  </div>
  <!--<strong>Copyright &copy; 2017-2021 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
  reserved.-->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- Select2 -->
<script src="../js/select2.js"></script>
<script src="../js/datatables.js"></script>
</body>

<script>
  let funcion = 'devolver_avatar';
  $.post('../controller/UsuarioController.php', {
    funcion
  }, (response) => {
    //console.log(response);
    const avatar = JSON.parse(response);
    $('#avatar4').attr('src', '../img/' + avatar.avatar);
  })
  funcion = 'tipo_usuario';
  $.post('../controller/UsuarioController.php', {
    funcion
  }, (response) => {
    //console.log(response);    
    if (response == 1) {
      $('#gestion_lote').hide();
    } else if (response == 2) {
      $('#gestion_lote').hide();
      $('#gestion_usuario').hide();
      $('#gestion_producto').hide();
      $('#gestion_atributo').hide();
      $('#gestion_proveedor').hide();
    }
  })
</script>

</html>