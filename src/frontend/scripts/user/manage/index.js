(function ($) {
    'use-strict';

    var $table = $('#tbUsers');
    var $btnAddUser = $('#add-user');
    var $modalCheckUser = $('#md-manage-check-user');
    var $modalCreateUser = $('#md-manage-create-user');

    $btnAddUser.on('click', function () {
        $modalCheckUser.find('#form-check-user input,select').val('').removeClass('valid').removeClass('error');
        $modalCheckUser.find('#form-check-user label.error').remove();
        $modalCreateUser.find('#form-create-user input,select').val('').removeClass('valid').removeClass('error');
        $modalCreateUser.find('#form-create-user label.error').remove();
        $modalCheckUser.modal({backdrop: 'static'}); // no cerrar el modal al hacer click fuera de el
    });

    // formulario de chequear usuario
    $modalCheckUser.find('#form-check-user').validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            check_user(data, btn);
        },
        rules: {
            'cod_per': {required: true}
        }
    });

    // formulario de crear usuario
    $modalCreateUser.find('#form-create-user').validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            create_user(data, btn);
        },
        rules: {
            'cod_per': {required: true},
            'nombres': {required: true},
            'ape1': {required: true},
            'ape2': {required: true}
        }
    });

    var update_form_with_chacad = function (data) {
        console.log(data);
        var form = $modalCreateUser.find('#form-create-user');
        form.find('input[name=cod_per]').val(data['dni']);
        form.find('input[name=nombres]').val(data['Nombres']);
        form.find('input[name=ape1]').val(data['Ape1']);
        form.find('input[name=ape2]').val(data['Ape2']);
    };

    var check_user = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.post(controllerUrl + '/check', data, function (response) {
            if (!response.error) {
                var $id_user = response.data.id_user;
                //chequear si existe
                if (response.data.exist) {
                    _confirm("<h5 class='text-center'>El usuario ya existe en padlock, ¿Desea ver su perfil?</h5>", function () {
                        location.href = controllerUrl + '/edit?id=' + $id_user;
                    }, function () {
                        $modalCheckUser.modal('hide');
                        $table.bootstrapTable('refresh');
                    });
                } else {
                    $modalCheckUser.modal('hide');
                    if (response.data.chacad_exist) {
                        update_form_with_chacad(response.data.chacad_data);
                    }
                    $modalCreateUser.modal({backdrop: 'static'}); // no cerrar el modal al hacer click fuera de el
                }
                btn.prop({disabled: false}).html('Buscar');
            } else {
                noty({type: 'error', text: response.message, timeout: 5000}).show();
                btn.prop({disabled: false}).html('Buscar');
            }
        }, 'json').fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText}).show();
                btn.prop({disabled: false}).html('Buscar');
            }
        });
    };

    var create_user = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        console.log('creando!');
    };

}(window.jQuery));