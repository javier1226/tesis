$(document).ready(function () {
    $('.select2').select2();
    rellenar_productos();
    rellenar_estado_pago();
    rellenar_proveedores();
    var prods = [];

    function rellenar_productos() {
        funcion = 'rellenar_productos';
        $.post('../controller/ProductoController.php', {
            funcion,
        }, (response) => {
            //console.log(response);
            let productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                template += `
                <option value="${producto.nombre}">${producto.nombre}</option>
                `
            });
            $('#producto').html(template);
        })
    }

    function rellenar_estado_pago() {
        funcion = 'rellenar_estado_pago';
        $.post('../controller/EstadoController.php', {
            funcion,
        }, (response) => {
            //console.log(response);
            let estados = JSON.parse(response);
            let template = '';
            estados.forEach(estado => {
                template += `
                <option value="${estado.id}">${estado.nombre}</option>
                `
            });
            $('#estado').html(template);
        })
    }

    function rellenar_proveedores() {
        funcion = 'rellenar_proveedores';
        $.post('../controller/ProveedorController.php', {
            funcion,
        }, (response) => {
            //console.log(response);
            let proveedores = JSON.parse(response);
            let template = '';
            proveedores.forEach(proveedor => {
                template += `
                <option value="${proveedor.id}">${proveedor.nombre}</option>
                `
            });
            $('#proveedor').html(template);
        })
    }

    $(document).on('click', '.agregar-producto', (e) => {
        let producto_select2 = $('#producto').val();
        let codigo_lote = $('#codigo_lote').val();
        let cantidad = $('#cantidad').val();
        let vencimiento = $('#vencimiento').val();
        let precio_compra = $('#precio_compra').val();

        if (producto_select2 == null) {
            $('#error').text('Elija un producto');
            $('#noadd-prod').hide('slow');
            $('#noadd-prod').show(1000);
            $('#noadd-prod').hide(2000);
            //$('#form-editar-lote').trigger('reset');
        } else {
            if (codigo_lote == '') {
                $('#error').text('Ingrese un codigo');
                $('#noadd-prod').hide('slow');
                $('#noadd-prod').show(1000);
                $('#noadd-prod').hide(2000);
                //$('#form-editar-lote').trigger('reset');
            } else {

                if (cantidad == '') {
                    $('#error').text('Ingrese una cantidad');
                    $('#noadd-prod').hide('slow');
                    $('#noadd-prod').show(1000);
                    $('#noadd-prod').hide(2000);
                    //$('#form-editar-lote').trigger('reset');
                } else {
                    if (vencimiento == '') {
                        $('#error').text('Ingrese una fecha de vencimiento');
                        $('#noadd-prod').hide('slow');
                        $('#noadd-prod').show(1000);
                        $('#noadd-prod').hide(2000);
                        //$('#form-editar-lote').trigger('reset');
                    } else {
                        if (precio_compra == '') {
                            $('#error').text('Ingrese un precio de compra');
                            $('#noadd-prod').hide('slow');
                            $('#noadd-prod').show(1000);
                            $('#noadd-prod').hide(2000);
                            //$('#form-editar-lote').trigger('reset');
                        } else {
                            let producto_array = producto_select2.split(' | ');
                            let producto = {
                                id: producto_array['0'],
                                nombre: producto_select2,
                                codigo: codigo_lote,
                                cantidad: cantidad,
                                vencimiento: vencimiento,
                                precio_compra: precio_compra
                            }
                            prods.push(producto);
                            let template = '';
                            template = `
                                <tr prodId="${producto.id}">
                                    <td>${producto.nombre}</td>
                                    <td>${producto.codigo}</td>
                                    <td>${producto.cantidad}</td>
                                    <td>${producto.vencimiento}</td>
                                    <td>${producto.precio_compra}</td>
                                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                </tr>
                            `;
                            $('#registros_compra').append(template);
                            $('#add-prod').hide('slow');
                            $('#add-prod').show(1000);
                            $('#add-prod').hide(2000);
                            $('#producto').val('').trigger('change');
                            $('#codigo_lote').val('');
                            $('#cantidad').val('');
                            $('#vencimiento').val('');
                            $('#precio_compras').val('');
                        }
                    }
                }
            }
        }
    })
    $(document).on('click', '.borrar-producto', (e) => {
        //console.log(prods);
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('prodId');
        //console.log(id);
        prods.forEach(function (prod, index) {
            //console.log(index);
            //console.log(prod);
            if (prod.id == id) {
                prods.splice(index, 1);
            }
        })
        elemento.remove();
    })

    $(document).on('click', '.crear-compra', (e) => {
        //console.log(prods);
        let codigo = $('#codigo').val();
        let fecha_compra = $('#fecha_compra').val();
        let fecha_entrega = $('#fecha_entrega').val();
        let total = $('#total').val();
        let estado = $('#estado').val();
        let proveedor = $('#proveedor').val();
        if (codigo == '') {
            $('#error-compra').text('Ingrese codigo');
            $('#noadd-compra').hide('slow');
            $('#noadd-compra').show(1000);
            $('#noadd-compra').hide(2000);
            //$('#form-editar-lote').trigger('reset');
        } else {
            if (fecha_compra == '') {
                $('#error-compra').text('Ingrese una fecha de compra');
                $('#noadd-compra').hide('slow');
                $('#noadd-compra').show(1000);
                $('#noadd-compra').hide(2000);
                //$('#form-editar-lote').trigger('reset');
            } else {
                if (fecha_entrega == '') {
                    $('#error-compra').text('Ingrese una fecha de entrega');
                    $('#noadd-compra').hide('slow');
                    $('#noadd-compra').show(1000);
                    $('#noadd-compra').hide(2000);
                    //$('#form-editar-lote').trigger('reset');
                } else {
                    if (total == '') {
                        $('#error-compra').text('Ingrese un total');
                        $('#noadd-compra').hide('slow');
                        $('#noadd-compra').show(1000);
                        $('#noadd-compra').hide(2000);
                        //$('#form-editar-lote').trigger('reset');
                    } else {
                        if (estado == null) {
                            $('#error-compra').text('Seleccione un estado');
                            $('#noadd-compra').hide('slow');
                            $('#noadd-compra').show(1000);
                            $('#noadd-compra').hide(2000);
                            //$('#form-editar-lote').trigger('reset');
                        } else {
                            if (proveedor == null) {
                                $('#error-compra').text('Seleccione un proveedor');
                                $('#noadd-compra').hide('slow');
                                $('#noadd-compra').show(1000);
                                $('#noadd-compra').hide(2000);
                                //$('#form-editar-lote').trigger('reset');
                            } else {
                                if (prods == '') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'No hay productos agregados'
                                    })
                                } else {
                                    let descripcion = {
                                        codigo: codigo,
                                        fecha_compra: fecha_compra,
                                        fecha_entrega: fecha_entrega,
                                        total: total,
                                        estado: estado,
                                        proveedor: proveedor
                                    }
                                    funcion = 'registrar_compra'
                                    let productosString = JSON.stringify(prods);
                                    let descripcionString = JSON.stringify(descripcion);
                                    $.post('../controller/ComprasController.php', {
                                        funcion,
                                        productosString,
                                        descripcionString
                                    }, (response) => {
                                        console.log(response);
                                        if (response == 'add') {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Se realizo la compra',
                                                showConfirmButton: false,
                                                timer: 1500
                                            }).then(function () {
                                                location.href = '../view/adm_compras.php';
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Error en el servidor'
                                            })
                                        }
                                    })

                                }
                            }
                        }
                    }
                }
            }
        }
    })
})