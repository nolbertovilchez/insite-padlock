(function ($) {
    'use-strict';

    var $table = $('#tbApplications');
    var $btnAddApplication = $('#add-application');
    var $modalAddApplication = $('#md-manage-create-application');

    $btnAddApplication.on('click', function () {
        $modalAddApplication.find('#form-create-application input,select').val('').removeClass('valid').removeClass('error');
        $modalAddApplication.find('#form-create-application label.error').remove();
        $modalAddApplication.modal('show');
    });

    $modalAddApplication.find('#form-create-application').validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = $(form).serialize();
            create_application(data, btn);
        },
        rules: {
            'nombre': {
                required: {
                    message: 'Este campo debe ser llenado'
                },
            }
        }
    });

    var create_application = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.post(controllerUrl + '/save', data, function (response) {
            if (!response.error) {
                var $id = response.id;
                console.log(response.id);
                $modalAddApplication.find('#form-create-application input').val('').removeClass('valid');
                btn.prop({disabled: false}).html('Guardar');
                $table.bootstrapTable('refresh');
                $modalAddApplication.modal('hide');
                noty({type: 'success', text: 'Aplicación creada con éxito', timeout: 1000}).show();
                setTimeout(function () {
                    location.href = controllerUrl + '/edit?id=' + $id;
                }, 1000);
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };

    var _delete_application = function (data) {
        $.post(controllerUrl + '/delete', data, function (response) {
            if (!response.error) {
                $table.bootstrapTable('refresh');
                noty({type: 'success', text: 'Aplicación creada con éxito', timeout: 1000}).show();
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
            }
        });
    };

    var _action_buttons = function (value, row, index) {
        return [
            '<a class="btn btn-default btn-icon btn-rounded edit cursor font-size-8" title="Editar"><i class="fa fa-pencil"></i></a>',
            '<a class="btn btn-default btn-icon btn-rounded delete cursor font-size-8" title="Eliminar"><i class="fa fa-trash"></i></a>'
        ].join('');
    };

    var _action_edit = function (e, value, row, index) {
        location.href = controllerUrl + '/edit?id=' + row.id_app;
    };
    var _action_delete = function (e, value, row, index) {
        var $row = row;
        _confirm("<h5 class='text-center'>Está por eliminar la aplicación <strong>"+row.name+"</strong>, ¿Seguro que desea continuar?</h5>", function () {
            _delete_application($row);
        }, function () {

        });
    };

    var columns = function () {
        return  [
            {
                field: 'id_app',
                title: 'Código',
                align: 'center',
                sortable: true,
                width: '50px',
            },
            {field: 'name', title: 'Nombre', align: 'center', sortable: true},
            {field: 'secretkey', title: 'Secreto', align: 'center', sortable: true},
            {field: 'key', title: 'Llave', sortable: true},
            {field: 'state_app', title: 'Estado', align: 'center', sortable: true},
            {
                field: 'action',
                title: 'Acciones',
                align: 'center',
                sortable: false,
                width: '100px',
                formatter: _action_buttons,
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