(function ($) {
    'use-strict';

    //var $moduleUrl = (Request.Host + Request.BaseUrl + "/" + Request.UrlHash.m);
    //var $controlerUrl = $moduleUrl + "/" + Request.UrlHash.c;
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
            'cod_per': {
                required: true,
            },
            'username': {
                required: true,
            },
            'email': {
                required: true,
                email: true
            }
        }
    });

    var create_user = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        var inputs = $modalAddUser.find('#form-create-user input');
        //inputs.val('').removeClass('valid');
        inputs.removeClass('valid');
        inputs.attr("disabled", true);

        $.post(controllerUrl + '/save', data, function (response) {
            console.log(response);
            if (!response.error) {
                location.href = controllerUrl + '/edit?id=' + response.data.id;
            } else {
                noty({type: 'error', text: response.message, timeout: 5000}).show();
                inputs.attr("disabled", false);
                btn.prop({disabled: false}).html('Guardar');
                $table.bootstrapTable('refresh');
                //$modalAddUser.modal('hide');
            }
        }, 'json').fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };

    var delete_user = function (data) {
        $.post(controllerUrl + '/delete', data, function (response) {
            if (!response.error) {
                $table.bootstrapTable('refresh');
                noty({type: 'success', text: response.message, timeout: 5000}).show();
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
            }
        });
    };

    var columns = function () {
        var _buttons = function (value, row, index) {
            return [
                '<a class="btn btn-default btn-icon btn-rounded edit cursor font-size-8" title="Editar"><i class="fa fa-pencil"></i></a>',
                '<a class="btn btn-default btn-icon btn-rounded delete cursor font-size-8" title="Eliminar"><i class="fa fa-trash"></i></a>'
            ].join('');
        };

        var _action_edit = function (e, value, row, index) {
            location.href = controllerUrl + '/edit?id=' + row.id_user;
        };

        var _action_delete = function (e, value, row, index) {
            var $row = row;
            _confirm("<h5 class='text-center'>Está por eliminar el usuario <strong>" + row.username + "</strong>, ¿Seguro que desea continuar?</h5>", function () {
                delete_user($row);
            });
        };

        return  [
            {
                field: 'id_user',
                title: 'ID',
                align: 'center',
                sortable: true,
                width: '50px',
            },
            {field: 'cod_per', title: 'Código personal', align: 'center', sortable: true},
            {field: 'id_type_user', title: 'Tipo de usuario', align: 'center', sortable: true},
            {field: 'username', title: 'Username', sortable: true},
            {field: 'state', title: 'Estado', align: 'center', sortable: true},
            {field: 'state_user', title: 'Estado', align: 'center', sortable: true},
            {
                field: 'action',
                title: 'Acciones',
                align: 'center',
                sortable: false,
                width: '50px',
                formatter: _buttons,
                events: {
                    'click .edit': _action_edit,
                    'click .delete': _action_delete,
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
        url: controllerUrl + '/list',
        columns: columns()
    });

}(window.jQuery));