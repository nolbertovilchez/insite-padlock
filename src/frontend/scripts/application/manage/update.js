(function ($) {
    'use-strict';

    var $tabs = $(".tabApplications");
    var $btnAdd = $(".btnAddPartial");
    var $btnUpdateGeneral = $("#actualizarGeneral");

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

    $tabs.on("click", function () {
        var type = $(this).attr("data-id");
        var list = $(this).attr("data-list");

        if (list) {
            var table = $("#tb-" + type);

            table.bootstrapTable("destroy");
            table.bootstrapTable({
                escape: false,
                locale: 'es-SP',
                search: true,
                pagination: true,
                pageSize: 10,
                idField: 'id',
                url: '/application/' + type + '/list',
                columns: columns()
            });
        }
    });

    $btnUpdateGeneral.on("click", function () {
        $("#form-update-application").validate({
            submitHandler: function (form) {
                var btn = $(form).find('button[type=submit]');
                var data = $(form).serialize();
                update_application(data, btn);
            },
            rules: {
                'nombre': {
                    required: {
                        message: 'Este campo debe ser llenado'
                    },
                }
            }
        });
    });

    var update_application = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.post('/application/manage/update', data, function (response) {
            if (!response.error) {
                btn.prop({disabled: false}).html('Actualizar');
                noty({type: 'success', text: response.message, timeout: 1000}).show();
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };

    $btnAdd.on("click", function () {
        var type = $(this).attr("data-id");
        var mdCreate = $("#md-manage-create-" + type);
        var frmCreate = "#form-create-" + type;
        var table = $("#tb-" + type);

        mdCreate.find(frmCreate + ' input,select').val('').removeClass('valid').removeClass('error');
        mdCreate.find(frmCreate + ' label.error').remove();
        mdCreate.modal('show');

        mdCreate.find(frmCreate).validate({
            submitHandler: function (form) {
                var btn = $(form).find('button[type=submit]');
                var data = $(form).serialize();
                create_partial(type, mdCreate, table, data, btn);
            },
            rules: {
                'nombre': {
                    required: {
                        message: 'Este campo debe ser llenado'
                    },
                }
            }
        });

    });

    var create_partial = function (type, mdCreate, table, data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.post('/application/' + type + '/save', data, function (response) {
            console.log("POST");
            if (!response.error) {
                mdCreate.find('#form-create-' + type + ' input').val('').removeClass('valid');
                btn.prop({disabled: false}).html('Guardar');
                table.bootstrapTable('refresh');
                mdCreate.modal('hide');
                noty({type: 'success', text: response.message, timeout: 1000}).show();
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
                btn.prop({disabled: false}).html('Guardar');
            }
        });
    };


}(window.jQuery));

