$(document).ready(function () {
    var funcion;
    var edit=false;
    $('.select2').select2();
    rellenar_laboratorios();
    rellenar_tipos();
    rellenar_presentaciones();
    buscar_producto();

    //carga laboratorio en vista producto
    function rellenar_laboratorios() {
        funcion = "rellenar_laboratorios";
        $.post('../controller/LaboratorioController.php', {
            funcion
        }, (response) => {
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                template += `
                    <option value="${laboratorio.id}">${laboratorio.nombre}</option>
                `;
            });
            $('#laboratorio').html(template);
        })
    }

    function rellenar_tipos() {
        funcion = "rellenar_tipos";
        $.post('../controller/TipoController.php', {
            funcion
        }, (response) => {
            const tipos = JSON.parse(response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                    <option value="${tipo.id}">${tipo.nombre}</option>
                `;
            });
            $('#tipo').html(template);
        })
    }

    function rellenar_presentaciones() {
        funcion = "rellenar_presentaciones";
        $.post('../controller/PresentacionController.php', {
            funcion
        }, (response) => {
            const presentaciones = JSON.parse(response);
            let template = '';
            presentaciones.forEach(presentacion => {
                template += `
                    <option value="${presentacion.id}">${presentacion.nombre}</option>
                `;
            });
            $('#presentacion').html(template);
        })
    }

    $('#form-crear-producto').submit(e => {
        let id = $('#id_edit_prod').val();
        let nombre = $('#nombre_producto').val();
        let concentracion = $('#concentracion').val();
        let adicional = $('#adicional').val();
        let precio = $('#precio').val();
        let laboratorio = $('#laboratorio').val();
        let tipo = $('#tipo').val();
        let presentacion = $('#presentacion').val();
        //console.log(nombre + " " + concentracion + " " + adicional + " " + precio + "  " + laboratorio + "  " + tipo + "  " + presentacion);
        //funcion = "crear";
        if(edit=true){
            funcion="editar";
        }else{
            funcion="crear";
        }
        $.post('../controller/ProductoController.php', {
            funcion,
            id,
            nombre,
            concentracion,
            adicional,
            precio,
            laboratorio,
            tipo,
            presentacion
        }, (response) => {
            
            if (response == 'add') {
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear-producto').trigger('reset');
                buscar_producto();
            }
            if (response == 'edit') {
                $('#edit_prod').hide('slow');
                $('#edit_prod').show(1000);
                $('#edit_prod').hide(2000);
                $('#form-crear-producto').trigger('reset');
                buscar_producto();
            }
            if (response == 'noadd') {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear-producto').trigger('reset');
            }  
            if (response == 'noedit') {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear-producto').trigger('reset');
            }
            edit=false;
        });
        e.preventDefault();
    });

    function buscar_producto(consulta) {
        funcion = "buscar";
        $.post('../controller/ProductoController.php', {
            consulta,
            funcion
        }, (response) => {
            const productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                template += `
                <div prodId="${producto.id}" prodNombre="${producto.nombre}"  prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" prodAvatar="${producto.avatar}" prodPresentacion="${producto.presentacion_id}"  prodTipo="${producto.tipo_id}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                   <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead"><b>${producto.nombre}</b></h2>
                        <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h4>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion:${producto.concentracion}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional:${producto.adicional}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio:${producto.laboratorio}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo:${producto.tipo}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion:${producto.presentacion}</li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                        <i class="fas fa-image"></i>
                      </button>
                      <button  class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crearproducto">
                        <i class="fas fa-pencil-alt"></i> 
                      </button>
                      <button  class="lote btn btn-sm btn-primary">
                      <i class="fas fa-plus-square"></i> 
                      </button>
                      <button  class="borrar btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> 
                      </button>
                    </div>
                  </div>
                </div>
              </div>
             `
            });
            $('#productos').html(template);
        })
    }
    $(document).on("keyup", "#buscar-producto", function () {
        let valor = $(this).val();
        if (valor != "") {
            buscar_producto(valor);
        } else {
            buscar_producto();
        }
    });

    $(document).on('click', '.avatar', (e) => {
        funcion = "cambiar_avatar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const avatar = $(elemento).attr('prodAvatar');
        const nombre = $(elemento).attr('prodNombre');
        $('#funcion').val(funcion);
        $('#id_logo_prod').val(id);
        $('#avatar').val(avatar);
        $('#logoactual').attr('src', avatar);
        $('#nombre_logo').html(nombre);
        //console.log(id + ' ' + avatar);
    });

    $('#form-logo').submit(e => {
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controller/ProductoController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);
            if(json.alert=='edit'){
                $('#logoactual').attr('src',json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-logo').trigger('reset');
                buscar_producto()
            }else{
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.editar', (e) => {        
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const concentracion = $(elemento).attr('prodConcentracion');
        const adicional = $(elemento).attr('prodAdicional');
        const precio = $(elemento).attr('prodPrecio');
        const laboratorio = $(elemento).attr('prodLaboratorio');
        const tipo = $(elemento).attr('prodTipo');
        const presentacion = $(elemento).attr('prodPresentacion');

        $('#id_edit_prod').val(id);
        $('#nombre_producto').val(nombre);
        $('#concentracion').val(concentracion);
        $('#adicional').val(adicional);
        $('#precio').val(precio);
        $('#laboratorio').val(laboratorio).trigger('change');
        $('#tipo').val(tipo).trigger('change');
        $('#presentacion').val(presentacion).trigger('change');
        edit = true;

        //console.log(id + ' ' + avatar);
    });

    $(document).on("click", ".borrar", (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const avatar = $(elemento).attr('prodAvatar');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Desea eliminar ' + nombre + '?',
            text: "No podrás revertir esto!",
            imageUrl: '' + avatar + '',
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Sí,borra esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('../controller/ProductoController.php', { id, funcion }, (response) => {
                    edit=false;
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El producto ' + nombre + ' fue eliminado.',
                            'success'
                        )
                        buscar_producto();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El producto ' + nombre + 'no fue borrado porque esta siendo usado en un lote.',
                            'error'
                        )

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El producto ' +
                    nombre + ' no fue borrado :)',
                    'error'
                )

            }
        })

    });


    // $(document).on("click", ".avatar", (e) => {
    //     funcion = "cambiar_logo";
    //     const elemento = $(this)[0].activeElement.parentElement.parentElement;
    //     const id = $(elemento).attr('labId');
    //     const nombre = $(elemento).attr('labNombre');
    //     const avatar = $(elemento).attr('labAvatar');
    //     $('#logoactual').attr('src', avatar);
    //     $('#nombre_logo').html(nombre);
    //     $('#funcion').val(funcion);
    //     $('#id_logo_lab').val(id);

    // });


})