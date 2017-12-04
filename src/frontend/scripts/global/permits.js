var $modalAddPermitUsuario = $("#md-add-permit-users");
var $modalRemovePermitUsuario = $("#md-remove-permit-users");
var $tbUserPermitAvailable = $("#tb-user-permissions-available");
var $tbUserPermitOwn = $("#tb-user-permissions-own");
var $tbUserPermitRestricted = $("#tb-user-permissions-restricted");
var $tbUserPermitAllow = $("#tb-user-permissions-allow");

var _add_permit = function (row) {
    var modalPermit = $("#md-add-permit-users");
    modalPermit.find("#label_usuario").html(row.nombre_persona);
    modalPermit.find("#label_aplicacion").html(row.application);
    modalPermit.find("#label_rol").html(row.role);
    modalPermit.find("#id_app_user").val(row.id_app_user);
    modalPermit.modal("show");
};

var _remove_permit = function (row) {
    var modalPermit = $("#md-remove-permit-users");
    modalPermit.find("#label_usuario").html(row.nombre_persona);
    modalPermit.find("#label_aplicacion").html(row.application);
    modalPermit.find("#label_rol").html(row.role);
    modalPermit.find("#id_app_user").val(row.id_app_user);
    modalPermit.modal("show");
};

var columns = function () {
    return  [
        {
            field: 'id_action',
            title: 'ID',
            align: 'center',
            sortable: true,
            width: '50px',
        },
        {field: 'name', title: 'Nombre', align: 'center', sortable: true},
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
                'click .allow': _action_allow,
                'click .restricted': _action_restrict,
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
    } else if (row.type == "allow") {
        return [
            "<button class='btn btn-sm btn-danger restricted'><i class='fa fa-arrow-left'></i></button>"
        ].join('');
    } else if (row.type == "restricted") {
        return [
            "<button class='btn btn-sm btn-success allow'><i class='fa fa-arrow-right'></i></button>"
        ].join('');
    }
};

var _action_remove = function (e, value, row, index) {
    var $id_app_user = $modalAddPermitUsuario.find("#id_app_user");
    row.id_app_user = $id_app_user.val();
    $.post(Request.Host + Request.BaseUrl + '/application/users/remove', row, function (response) {
        if (!response.error) {
            noty({type: 'success', text: response.message, timeout: 1000}).show();
            $tbUserPermitAvailable.bootstrapTable('refresh');
            $tbUserPermitOwn.bootstrapTable('refresh');
        }
    }, "json").fail(function (xhr, status, error) {
        if (xhr.status != 200) {
            noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
        }
    });
};

var _action_add = function (e, value, row, index) {
    var $id_app_user = $modalAddPermitUsuario.find("#id_app_user");
    row.id_app_user = $id_app_user.val();
    $.post(Request.Host + Request.BaseUrl + '/application/users/add', row, function (response) {
        if (!response.error) {
            noty({type: 'success', text: response.message, timeout: 1000}).show();
            $tbUserPermitAvailable.bootstrapTable('refresh');
            $tbUserPermitOwn.bootstrapTable('refresh');
        }
    }, "json").fail(function (xhr, status, error) {
        if (xhr.status != 200) {
            noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
        }
    });
};

var _action_restrict = function (e, value, row, index) {
    var $id_app_user = $modalRemovePermitUsuario.find("#id_app_user");
    row.id_app_user = $id_app_user.val();
    $.post(Request.Host + Request.BaseUrl + '/application/users/restrict', row, function (response) {
        if (!response.error) {
            noty({type: 'success', text: response.message, timeout: 1000}).show();
            $tbUserPermitAllow.bootstrapTable('refresh');
            $tbUserPermitRestricted.bootstrapTable('refresh');
        }
    }, "json").fail(function (xhr, status, error) {
        if (xhr.status != 200) {
            noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
        }
    });
};

var _action_allow = function (e, value, row, index) {
    var $id_app_user = $modalRemovePermitUsuario.find("#id_app_user");
    row.id_app_user = $id_app_user.val();
    $.post(Request.Host + Request.BaseUrl + '/application/users/allow', row, function (response) {
        if (!response.error) {
            noty({type: 'success', text: response.message, timeout: 1000}).show();
            $tbUserPermitAllow.bootstrapTable('refresh');
            $tbUserPermitRestricted.bootstrapTable('refresh');
        }
    }, "json").fail(function (xhr, status, error) {
        if (xhr.status != 200) {
            noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
        }
    });
};

$modalAddPermitUsuario.on("shown.bs.modal", function () {
    var $id_app_user = $modalAddPermitUsuario.find("#id_app_user");
    $tbUserPermitAvailable.bootstrapTable("destroy");
    $tbUserPermitAvailable.bootstrapTable({
        escape: false,
        locale: 'es-SP',
        search: true,
        pagination: true,
        pageSize: 10,
        idField: 'id',
        uniqueId: 'id',
        url: Request.Host + Request.BaseUrl + '/application/users/list_permit_available?id=' + $id_app_user.val(),
        columns: columns()
    });
    $tbUserPermitOwn.bootstrapTable("destroy");
    $tbUserPermitOwn.bootstrapTable({
        escape: false,
        locale: 'es-SP',
        search: true,
        pagination: true,
        pageSize: 10,
        idField: 'id',
        uniqueId: 'id',
        url: Request.Host + Request.BaseUrl + '/application/users/list_permit_own?id=' + $id_app_user.val(),
        columns: columns()
    });
}).on("hidden.bs.modal", function () {
    $("#tb-users").bootstrapTable('refresh');
    $("#tb-application").bootstrapTable('refresh');
});

$modalRemovePermitUsuario.on("shown.bs.modal", function () {
    var $id_app_user = $modalRemovePermitUsuario.find("#id_app_user");
    $tbUserPermitAllow.bootstrapTable("destroy");
    $tbUserPermitAllow.bootstrapTable({
        escape: false,
        locale: 'es-SP',
        search: true,
        pagination: true,
        pageSize: 10,
        idField: 'id',
        uniqueId: 'id',
        url: Request.Host + Request.BaseUrl + '/application/users/list_permit_allow?id=' + $id_app_user.val(),
        columns: columns()
    });
    $tbUserPermitRestricted.bootstrapTable("destroy");
    $tbUserPermitRestricted.bootstrapTable({
        escape: false,
        locale: 'es-SP',
        search: true,
        pagination: true,
        pageSize: 10,
        idField: 'id',
        uniqueId: 'id',
        url: Request.Host + Request.BaseUrl + '/application/users/list_permit_restricted?id=' + $id_app_user.val(),
        columns: columns()
    });
}).on("hidden.bs.modal", function () {
    $("#tb-users").bootstrapTable('refresh');
    $("#tb-application").bootstrapTable('refresh');
});
