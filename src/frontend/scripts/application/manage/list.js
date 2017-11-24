(function ($) {
    'use-strict';

//    var $moduleUrl = (Request.Host + Request.BaseUrl + "/" + Request.UrlHash.m);
//    var $controlerUrl = $moduleUrl + "/" + Request.UrlHash.c;
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
        $.post('/application/manage/save', data, function (response) {
            if (!response.error) {
                $modalAddApplication.find('#form-create-application input').val('').removeClass('valid');
                btn.prop({disabled: false}).html('Guardar');
                $table.bootstrapTable('refresh');
                $modalAddApplication.modal('hide');
                noty({type: 'success', text: 'Aplicación creada con éxito', timeout: 1000}).show();
                setTimeout(function () {
                    location.href = '/application/manage/edit/id/' + response.data.id;
                }, 1000);
            }
        }, "json").fail(function (xhr, status, error) {
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

    var columns = function () {
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
        url: '/application/manage/list',
        columns: columns()
    });

}(window.jQuery));