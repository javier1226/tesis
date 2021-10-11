$(document).ready(function () {
    $('#aviso').hide();
    $('#aviso1').hide();
    $('#form-recuperar').submit(e => {
        Mostrar_Loader('Recuperar_password');
        let email = $('#email-recuperar').val();
        let dni = $('#dni-recuperar').val();
        if (email == '' || dni == '') {
            $('#aviso').show();
            $('#aviso').text('Rellene todos los campos');
            Cerrar_Loader("");
        } else {
            $('#aviso').hide();
            let funcion = 'verificar';
            $.post('../controller/RecuperarController.php', {
                funcion,
                email,
                dni
            }, (response) => {
                if (response == 'encontrado') {
                    let funcion = 'recuperar';
                    $('#aviso').hide();
                    $.post('../controller/RecuperarController.php', {
                        funcion,
                        email,
                        dni
                    }, (response2) => {
                        $('#aviso').hide();
                        $('#aviso1').hide();
                        //console.log(response2);
                        if (response2 == 'Enviado') {
                            Cerrar_Loader('exito_envio');
                            $('#aviso1').show();
                            $('#aviso1').text('Se reestablecio la contraseña');
                            $('#form-recuperar').trigger('reset');
                        } else {
                            Cerrar_Loader('error_envio');
                            $('#aviso').show();
                            $('#aviso').text('No se puede reestablecer');
                            $('#form-recuperar').trigger('reset');
                        }
                    })
                } else {
                    Cerrar_Loader('error_usuario');
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('El correo y el dni no se encuentran asociados o no estan registrados en el sistema');
                    $('#form-recuperar').trigger('reset');
                }
            })
        }
        e.preventDefault();
    })

    function Mostrar_Loader(Mensaje) {
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
            case 'Recuperar_password':
                texto = 'Se está enviando el correo. Por favor espere...';
                mostrar = true;
                break;
                //default:
                //    break;
        }
        if (mostrar) {
            Swal.fire({
                title: 'Enviando correo',
                text: texto,
                showConfirmButton: false
            })
        }
    }

    function Cerrar_Loader(Mensaje) {
        var tipo = null;
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
            case 'exito_envio':
                tipo = 'success';
                texto = 'El correo fue enviado correctamente.';
                mostrar = true;
                break;
            case 'error_envio':
                tipo = 'error';
                texto = 'El correo no pudo enviarse, por favor intente de nuevo.';
                mostrar = true;
                break;
            case 'error_usuario':
                tipo = 'error';
                texto = 'El usuario perteneciente a estos datos no fue encontrado';
                mostrar = true;
                break;
            default:
                swal.close();
                break;
        }
        if (mostrar) {
            Swal.fire({
                position: 'center',
                icon: tipo,                
                text: texto,
                showConfirmButton: false
            })
        }
    }
})