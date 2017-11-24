(function ($) {
    'use-strict';

//    var $moduleUrl = (Request.Host + Request.BaseUrl + "/" + Request.UrlHash.m);
//    var $controlerUrl = $moduleUrl + "/" + Request.UrlHash.c;
    var $table = $('#tbUsers');
    var $btnAddUser = $('#add-user');
    var $modalAddUser = $('#md-manage-create-user');

    $btnAddUser.on('click', function () {
        $modalAddUser.find('#form-create-user input,select').val('').removeClass('valid').removeClass('error');
        $modalAddUser.find('#form-create-user label.error').remove();
        $modalAddUser.modal({backdrop: 'static'}); // no cerrar el modal al hacer click fuera de el
    });

    $modalAddUser.find('#form-create-user').validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            create_user(data, btn);
        },
        rules: {
            'nombres': {
                required: {
                    message: 'Este campo debe ser llenado'
                },
            },
            'apellidos': {
                required: {
                    message: 'Este campo debe ser llenado'
                },
            }
        }
    });

    var create_user = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        var inputs = $modalAddUser.find('#form-create-user input');
        inputs.val('').removeClass('valid');
        inputs.attr("disabled",true);
        
        $.post('/web/user/manage/save', data, function (response) {
            console.dir(response);
            if (!response.error) {
                //$modalAddUser.find('#form-create-user input').val('').removeClass('valid');
                //btn.prop({disabled: false}).html('Guardar');
                //$table.bootstrapTable('refresh');
                //$modalAddUser.modal('hide');
                //noty({type: 'success', text: 'Usuario creado con éxito', timeout: 1000}).show();
                setTimeout(function () {
                    location.href = '/web/user/manage/edit/id/' + response.data.id;
                }, 5000);
            }
        },'json').fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };

    var _action_buttons = function (value, row, index) {
        return [
            '<a>Editar</a>'
        ].join('');
    };

    var _action_edit = function (e, value, row, index) {
        var href = '';
        if (row.tipo == 'P') {
            href = 'person/id' + ' / ' + row.id;
        }
        location.href = ' / ' + href;
    };

    var _columns = function () {
        return  [
            {
                field: 'ID_APP',
                title: 'Código',
                align: 'center',
                sortable: true,
                width: '50px',
            },
            {field: 'NAME_APP', title: 'Nombre', align: 'center', sortable: true},
            {field: 'SECRET_APP', title: 'Secreto', align: 'center', sortable: true},
            {field: 'KEY_APP', title: 'Llave', sortable: true},
            {field: 'STATE_APP', title: 'Estado', align: 'center', sortable: true},
            {
                field: 'action',
                title: 'Acciones',
                align: 'center',
                sortable: false,
                width: '50px',
                formatter: _action_buttons,
                events: {
                    'click .edit': _action_edit,
                }
            }
        ];
    };

    $table.bootstrapTable({
        escape: false,
        locale: 'es-SP',
        search: true,
        pagination: true,
        pageSize: 10,
        idField: 'id',
        url: '/web/user/manage/list',
        columns: _columns()
    });

}(window.jQuery));