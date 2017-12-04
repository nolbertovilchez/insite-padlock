(function ($) {
    'use-strict';

    var $tabs = $(".tabUsers");

    $("#form-update-user").validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            update_user(data, btn);
        },
        rules: {
            'cod_per': {
                required: true
            },
            'username': {
                required: true
            }
        }
    });

    $("#form-update-recovery").validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            update_user(data, btn);
        },
        rules: {
            'email': {
                required: true
            }
        }
    });

    var update_user = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.post(controllerUrl + '/update', data, function (response) {
            if (!response.error) {
                btn.prop({disabled: false}).html('Actualizar');
                noty({type: 'success', text: response.message, timeout: 5000}).show();
            }
        }, 'json').fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };
}(window.jQuery));