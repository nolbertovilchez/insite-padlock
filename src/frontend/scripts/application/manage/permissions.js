
(function ($) {
    'use-strict';

    var $cboRole = $("#cboRole");
    var $content = $("#content-role");
    var $tbOwn = $("#tb-permissions-own");
    var $tbAvailable = $("#tb-permissions-available");

    var columns = function () {
        return  [
            {
                field: 'id',
                title: 'ID',
                align: 'center',
                sortable: true,
                width: '50px',
            },
            {field: 'name_action', title: 'Nombre', align: 'center', sortable: true},
            {
                field: 'action',
                title: 'Accion',
                align: 'center',
                sortable: false,
                width: '50px',
                formatter: _action_buttons,
                events: {
                    'click .own': _action_remove,
                    'click .available': _action_add,
                }
            }
        ];
    };

    var _action_buttons = function (value, row, index) {
        if (row.type == "own") {
            return [
                "<button class='btn btn-sm btn-danger own'><i class='fa fa-arrow-left'></i></button>"
            ].join('');
        } else if (row.type == "available") {
            return [
                "<button class='btn btn-sm btn-success available'><i class='fa fa-arrow-right'></i></button>"
            ].join('');
        }
    };
    var _action_remove = function (e, value, row, index) {
        $.post(moduleUrl+'/permissions/remove', row, function (response) {
            if (!response.error) {
                noty({type: 'success', text: response.message, timeout: 1000}).show();
                var unique = $tbOwn.bootstrapTable('getRowByUniqueId', row.id);
                $tbOwn.bootstrapTable('removeByUniqueId', row.id);
                row.type = "available";
                $tbAvailable.bootstrapTable('append', row);
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
            }
        });
    };

    var _action_add = function (e, value, row, index) {
        $.post(moduleUrl+'/permissions/add', row, function (response) {
            if (!response.error) {
                noty({type: 'success', text: response.message, timeout: 1000}).show();
                $tbAvailable.bootstrapTable('removeByUniqueId', row.id);
                row.type = "own";
                $tbOwn.bootstrapTable('append', row);
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
            }
        });
    };

    $cboRole.on("change", function () {
        var role = $(this).val();
        if (role != "") {
            noty({type: "success", text: "Seleccionado option " + role, timeout: 1000}).show();
            $content.removeClass("invisible");
            $tbOwn.bootstrapTable("destroy");
            $tbOwn.bootstrapTable({
                escape: false,
                locale: 'es-SP',
                search: true,
                pagination: true,
                pageSize: 10,
                idField: 'id',
                uniqueId: 'id',
                url: moduleUrl+'/permissions/list_role_own?id=' + role,
                columns: columns()
            });
            $tbAvailable.bootstrapTable("destroy");
            $tbAvailable.bootstrapTable({
                escape: false,
                locale: 'es-SP',
                search: true,
                pagination: true,
                pageSize: 10,
                idField: 'id',
                uniqueId: 'id',
                url: moduleUrl+'/permissions/list_role_available?id=' + role,
                columns: columns()
            });
        }
    });

    var _generate_row = function (action, val) {
        var type;
        var color;
        if (action == "own") {
            type = "right";
            color = "danger";
        } else {
            type = "left";
            color = "success";
        }
        return $("<tr>").attr("id", val.id).append($("<td>").html(val.id)).append($("<td>").html(val.name_action)).append($("<td>").html());
    };

}(window.jQuery));

