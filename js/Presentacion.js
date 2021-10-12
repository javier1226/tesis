$(document).ready(function() {
    buscar_pre();
    var funcion;
    var edit = false;
    $('#form-crear-presentacion').submit(e => {
        let nombre_presentacion = $('#nombre-presentacion').val();
        let id_editado = $('#id_editar_pre').val();
        if (edit == false) {
            funcion = 'crear';
        } else {
            funcion = 'editar';
        }

        $.post('../controller/PresentacionController.php', { nombre_presentacion, id_editado, funcion }, (response) => {
            //console.log(response);
            if (response == 'add') {
                $('#add-presentacion').hide('slow');
                $('#add-presentacion').show(1000);
                $('#add-presentacion').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            if (response == 'noadd') {
                $('#noadd-presentacion').hide('slow');
                $('#noadd-presentacion').show(1000);
                $('#noadd-presentacion').hide(2000);
                $('#form-crear-presentacion').trigger('reset');
            }
            if (response == 'edit') {
                $('#edit-presentacion').hide('slow');
                $('#edit-presentacion').show(1000);
                $('#edit-presentacion').hide(2000);
                $('#form-editar-pre').trigger('reset');
                buscar_pre();
            }
            edit = false;
        })
        e.preventDefault();
    });


    function buscar_pre(consulta) {
        funcion = 'buscar';
        $.post('../controller/PresentacionController.php', { consulta, funcion }, (response) => {
            const presentaciones = JSON.parse(response);
            let template = '';
            presentaciones.forEach(presentacion => {
                template += `
                   <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                       <td>${presentacion.nombre}</td>
                       <td>
                           <button class="editar-pre btn btn-success" title="Editar presentación"  type="button" data-toggle ="modal" data-target="#crearpresentacion">
                              <i class="fas fa-pencil-alt"></i>
                           </button>
                           <button class="borrar-pre btn btn-danger" title="Borrar presentación">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                       </td>
                   </tr>
                `;
            });
            $('#presentaciones').html(template);
        })
    }

    $(document).on('keyup', '#buscar-presentacion', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_pre(valor);
        } else {
            buscar_pre();
        }
    })


    $(document).on("click", ".borrar-pre", (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');

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
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Sí,borra esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('../controller/PresentacionController.php', { id, funcion }, (response) => {
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La presentacion  ' + nombre + ' fue eliminado.',
                            'success'
                        )
                        buscar_pre();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'La presentacion ' + nombre + 'no fue borrado porque esta siendo usado en un producto.',
                            'error'
                        )

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La presentacion ' +
                    nombre + ' no fue borrado :)',
                    'error'
                )

            }
        })

    });

    $(document).on("click", ".editar-pre", (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit = true;
    });

});