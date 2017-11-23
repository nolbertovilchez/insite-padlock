(function ($) {
    'use-strict';

    var $moduleUrl = (Request.Host + Request.BaseUrl + "/" + Request.UrlHash.m);
    var $controlerUrl = $moduleUrl + "/" + Request.UrlHash.c;
    var $table = $("#tbApplications");
    
    console.log($table);
//    var $modalCreatePerson = $("#md-manage-create-client-person");
//    var $modalCreateCompany = $("#md-manage-create-client-company");
//    var $addClientPerson = $("#add-client-person");
//    var $addClientCompany = $("#add-client-company");

//    $.validator.addMethod("validate_document", function (value, element) {
//        var clients = $table.bootstrapTable("getData");
//        var state = true;
//        $.each(clients, function (row, column) {
//            if (column.documento == value && column.tipo == 'P') {
//                state = false;
//                return true;
//            }
//        });
//        return state;
//    }, "El cliente ya existe");

//    $addClientPerson.on("click", function () {
//        $modalCreatePerson.find("#form-create-client-person input,select").val('').removeClass("valid").removeClass("error");
//        $modalCreatePerson.find("#form-create-client-person label.error").remove();
//        $modalCreatePerson.modal("show");
//    });
//
//    $modalCreatePerson.find("#form-create-client-person").validate({
//        submitHandler: function (form) {
//            var btn = $(form).find("button[type=submit]");
//            var data = $(form).serialize();
//            create_client_person(data, btn);
//        },
//        rules: {
//            "cliente[documento]": {
//                required: true,
//                validate_document: true
//            },
//            "cliente[tipo]": {
//                required: true
//            },
//            "cliente[nombres]": {
//                required: true
//            }
//        }
//    });

//    var create_client_person = function (data, btn) {
//        btn.prop({disabled: true}).html("Cargando...");
//        $.post($controlerUrl + "/createPerson", data, function (response) {
//            if (!response.error) {
//                $modalCreatePerson.find("#form-create-client-person input").val('').removeClass("valid");
//                btn.prop({disabled: false}).html("Guardar");
//                $table.bootstrapTable("refresh");
//                $modalCreatePerson.modal("hide");
//                Notify("success", "Cliente creado con éxito");
//                setTimeout(function () {
//                    location.href = $controlerUrl + "/person/id/" + response.data.id;
//                }, 1000);
//            }
//        });
//    };

    var Notify = function (type, msg) {
        noty({
            theme: 'app-noty',
            text: msg,
            type: type,
            timeout: 3000,
            layout: "topRight",
            closeWith: ['button', 'click'],
            animation: {
                open: 'noty-animation fadeIn',
                close: 'noty-animation fadeOut'
            }
        });
    };

    var _action_buttons = function (value, row, index) {
        return [
            '<a class="btn btn-default btn-icon btn-rounded edit cursor font-size-8">',
            '<i class="fa fa-pencil"></i>',
            '</a>'
        ].join('');
    };

    var _action_edit = function (e, value, row, index) {
        var href = '';
        if (row.tipo == 'P')
            href = 'person/id' + "/" + row.id;
        location.href = $controlerUrl + "/" + href;
    };

    var columns = function () {
        return  [
            {
                field: 'id',
                title: 'Código',
                align: 'center',
                sortable: true,
                width: "50px",
                formatter: function (value, row, index) {
                    var zerofield = (row.id < 10) ? "000" : "00";
                    return "<span class='text-info'><strong>#" + row.tipo + zerofield + row.id + "</strong></span>"
                }
            },
            {field: 'tipo', title: 'Tipo', align: 'center', sortable: true},
            {field: 'documento', title: 'Identificación', align: 'center', sortable: true},
            {field: 'nombre', title: 'Nombre', sortable: true},
            {field: 'fecha_registro', title: 'Fecha Registro', align: 'center', sortable: true},
            {
                field: 'action',
                title: ' ',
                align: 'center',
                sortable: false,
                width: "50px",
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
        idField: "id",
        url: $controlerUrl + "/list",
        columns: columns()
    });

}(window.jQuery));