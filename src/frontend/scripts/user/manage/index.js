(function ($) {
    'use-strict';

    var $table = $('#tbUsers');
    var $btnAddUser = $('#add-user');
    var $modalCheckUser = $('#md-manage-check-user');
    var $modalCreateUser = $('#md-manage-create-user');

    //$('.datepicker-2').datepicker();

    $btnAddUser.on('click', function () {
        $modalCheckUser.find('#form-check-user input,select').val('').removeClass('valid').removeClass('error');
        $modalCheckUser.find('#form-check-user label.error').remove();
        $modalCreateUser.find('#form-create-user input,select').val('').removeClass('valid').removeClass('error');
        $modalCreateUser.find('#form-create-user label.error').remove();
        $modalCreateUser.find('input[name^="identis[CodTMoti]"]').val('*');
        $modalCheckUser.modal({backdrop: 'static'}); // no cerrar el modal al hacer click fuera de el
    });

    // formulario de chequear usuario
    $modalCheckUser.find('#form-check-user').validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var formArr = $(form).serializeArray();
            $.each(formArr, function (i, field) {
                formArr[i].value = $.trim(field.value);
            });
            var data = $.param(formArr);
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
            var formArr = $(form).serializeArray();
            $.each(formArr, function (i, field) {
                formArr[i].value = $.trim(field.value);
            });
            var data = $.param(formArr);
            create_user(data, btn);
        },
        rules: {
            'identis[CodPer]': {required: true},
            'identis[Nombres]': {required: true},
            'identis[Ape1]': {required: true},
            'identis[Ape2]': {required: true},
            'contacto[telefono]': {required: true},
            'contacto[email]': {required: true, email: true}
        }
    });

    var update_form_with_chacad = function (data) {
        var form = $modalCreateUser.find('#form-create-user');
        form.find('input[name^="identis[CodIden]"]').val(data['CodIden']);
        form.find('input[name^="identis[CodPer]"]').val(data['dni']);
        form.find('input[name^="identis[Nombres]"]').val(data['Nombres']);
        form.find('input[name^="identis[Ape1]"]').val(data['Ape1']);
        form.find('input[name^="identis[Ape2]"]').val(data['Ape2']);
        form.find('input[name^="identis[Sexo]"]').val(data['Sexo']);
        form.find('input[name^="contacto[telefono]"]').val(data['telefono_personal']);
        form.find('input[name^="contacto[email]"]').val(data['email_personal']);
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
                    if (response.data.chacad.exist) {
                        update_form_with_chacad(response.data.chacad.data);
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
        $.post(controllerUrl + '/save', data, function (response) {
            if (!response.error) {
                location.href = controllerUrl + '/edit?id=' + response.data.id_user;
            } else {
                noty({type: 'error', text: response.message, timeout: 5000}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        }, 'json').fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };

}(window.jQuery));