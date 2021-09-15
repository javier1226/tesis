$(document).ready(function() {
    buscar_tipo();
    var funcion;
    var edit = false;
    $('#form-crear-tipo').submit(e => {
        let nombre_tipo = $('#nombre-tipo').val();
        funcion = 'crear';
        $.post('../controller/TipoController.php', { nombre_tipo, funcion }, (response) => {
            if (response == 'add') {
                $('#add-tipo').hide('slow');
                $('#add-tipo').show(1000);
                $('#add-tipo').hide(2000);
                $('#form-crear-tipo').trigger('reset');
                buscar_tipo();
            } else {
                $('#noadd-tipo').hide('slow');
                $('#noadd-tipo').show(1000);
                $('#noadd-tipo').hide(2000);
                $('#form-crear-tipo').trigger('reset');
            }
        })
        e.preventDefault();
    });
    $('#form-editar-tipo').submit(e => {
        let nombre_tipoEdit = $('#nombre-tipoEdit').val();
        let id_editado = $('#id_editar_tipo').val();
        if (edit != false) {
            funcion = 'editar';
        }
        $.post('../controller/TipoController.php', { nombre_tipoEdit, id_editado, funcion }, (response) => {
            if (response == 'edit') {
                $('#edit-tipo').hide('slow');
                $('#edit-tipo').show(1000);
                $('#edit-tipo').hide(2000);
                $('#form-editar-tipo').trigger('reset');
                buscar_tipo();
            }
            edit == false;
        })
        e.preventDefault();

    })

    function buscar_tipo(consulta) {
        funcion = 'buscar';
        $.post('../controller/TipoController.php', { consulta, funcion }, (response) => {
            const tipos = JSON.parse(response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                   <tr tipId="${tipo.id}" tipNombre="${tipo.nombre}">

                       <td>${tipo.nombre}</td>
                       <td>
                           <button class="editar-tipo btn btn-success" title="Editar tipo"  type="button" data-toggle ="modal" data-target="#editartipo">
                              <i class="fas fa-pencil-alt"></i>
                           </button>
                           <button class="borrar-tipo btn btn-danger" title="Borrar tipo">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                       </td>
                   </tr>
                `;
            });
            $('#tipos').html(template);
        })
    }

    $(document).on('keyup', '#buscar-tipo', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_tipo(valor);
        } else {
            buscar_tipo();
        }
    })


    $(document).on("click", ".borrar-tipo", (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipId');
        const nombre = $(elemento).attr('tipNombre');
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí,borra esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('../controller/tipoController.php', { id, funcion }, (response) => {
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El tipo ' + nombre + ' fue eliminado.',
                            'success'
                        )
                        buscar_tipo();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El tipo ' + nombre + 'no fue borrado porque esta siendo usado en un producto.',
                            'error'
                        )

                    }
                })

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El tipo ' +
                    nombre + '  no fue borrado :)',
                    'error'
                )

            }
        })

    });

    $(document).on("click", ".editar-tipo", (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipId');
        const nombre = $(elemento).attr('tipNombre');
        $('#id_editar_tipo').val(id);
        $('#nombre-tipoEdit').val(nombre);
        edit = true;
    });

});