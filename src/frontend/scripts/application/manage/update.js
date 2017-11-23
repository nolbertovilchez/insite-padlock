(function ($) {
    'use-strict';

    var $tabs = $(".tabApplications");

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


}(window.jQuery));

