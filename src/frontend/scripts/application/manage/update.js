(function ($) {
    'use-strict';
    var $tabs = $(".tabApplications");
    var $btnAdd = $(".btnAddPartial");
    var $imgUpload = $("#img-upload");

    var columns = function (type) {
        var format;
        if (type == "roles") {
            format = [
                {
                    field: 'code_role',
                    title: 'Código',
                    align: 'center',
                    sortable: true,
                    width: '50px',
                },
                {field: 'name', title: 'Nombre', align: 'center', sortable: true},
                {field: 'description', title: 'Descripción', align: 'center', sortable: true},
                {field: 'hierarchy', title: 'Jerarquía', sortable: true},
                {field: 'state', title: 'Estado', align: 'center', sortable: true},
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
        } else if (type == "actions") {
            format = [
                {
                    field: 'id_action',
                    title: 'Código',
                    align: 'center',
                    sortable: true,
                    width: '50px',
                },
                {field: 'name', title: 'Nombre', align: 'center', sortable: true},
                {field: 'description', title: 'Descripción', align: 'center', sortable: true},
                {field: 'state', title: 'Estado', align: 'center', sortable: true},
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

        }
        return format;
    };

    var _action_buttons = function (value, row, index) {
        return [
            '<a class="btn btn-default btn-icon btn-rounded edit cursor font-size-8" title="Editar"><i class="fa fa-pencil"></i></a>',
            '<a class="btn btn-default btn-icon btn-rounded delete cursor font-size-8" title="Eliminar"><i class="fa fa-trash"></i></a>'
        ].join('');
    };

    var _action_edit = function (e, value, row, index) {
        _edit_type(row);
    };

    var _action_delete = function (e, value, row, index) {
        var $row = row;
        _confirm("<h5 class='text-center'>Está por eliminar el role <strong>" + row.name + "</strong>, ¿Seguro que desea continuar?</h5>", function () {
            _delete_type($row);
        }, function () {
            console.log("CANCELAR");
        });
    };

    var _edit_type = function (data) {
        var type = data.type;
        var mdCreate = $("#md-manage-create-" + data.type);
        var frmCreate = "#form-create-" + data.type;
        var table = $("#tb-" + data.type);
        $.each(data, function (key, ele) {
            mdCreate.find(frmCreate + ' [name="' + data.type + '[' + key + ']"]').val(ele);
        });
        mdCreate.find(frmCreate + ' input,select').removeClass('valid').removeClass('error');
        mdCreate.find(frmCreate + ' label.error').remove();
        mdCreate.modal('show');
        mdCreate.find(frmCreate).validate({
            submitHandler: function (form) {
                var btn = $(form).find('button[type=submit]');
                var data = $(form).serialize() + '&id=' + Request._GET.id;
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
    };

    var _delete_type = function (data) {
        $.post(moduleUrl + '/' + data.type + '/delete', data, function (response) {
            if (!response.error) {
                $("#tb-" + data.type).bootstrapTable('refresh');
                noty({type: 'success', text: response.message, timeout: 1000}).show();
            }
        }, "json").fail(function (xhr, status, error) {
            if (xhr.status != 200) {
                noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
            }
        });
    };

    $tabs.on("click", function () {
        var type = $(this).attr("data-id");
        var list = $(this).attr("data-list");
        if (list === "true") {
            var table = $("#tb-" + type);
            table.bootstrapTable("destroy");
            table.bootstrapTable({
                escape: false,
                locale: 'es-SP',
                search: true,
                pagination: true,
                pageSize: 10,
                idField: 'id',
                url: moduleUrl + '/' + type + '/list?id=' + Request._GET.id,
                columns: columns(type)
            });
        }
    });

    $("#form-update-application").validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
//            var data = $(form).serialize() + '&type=general';
            var data = new FormData($(form)[0]);
            data.append("type", "general");
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

    $("#form-setting-application").validate({
        submitHandler: function (form) {
            var btn = $(form).find('button[type=submit]');
            var data = new FormData($(form)[0]);
            data.append("type", "setting");
//            var data = $(form).serialize() + '&type=setting';
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

    var update_application = function (data, btn) {
        btn.prop({disabled: true}).html('Cargando...');
        $.ajax({
            url: controllerUrl + '/update',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            type: 'POST',
            success: function (response) {
                console.log(response);
                if (!response.error) {
                    btn.prop({disabled: false}).html('Actualizar');
                    noty({type: 'success', text: response.message, timeout: 1000}).show();
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status != 200) {
                    noty({type: 'error', text: xhr.responseText, timeout: 1000}).show();
                    btn.prop({disabled: false}).html('Guardar');
                }
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
                var data = $(form).serialize() + '&id=' + Request._GET.id;
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
        $.post(moduleUrl + '/' + type + '/save', data, function (response) {
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

    $imgUpload.on("change", function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $("#img-preview").attr("src", e.target.result);
        };

        if (this.files.length != 0) {
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        }
    });

    $(".genera_abreviatura").on("keyup", function () {
        var abreviaturaFinal = "";
        var _exp = this.value.toUpperCase().split(" ");
        if (_exp.length > 1) {
            var nombreValidos = [];
            var nombresAbreviados = [];
            for (var i in _exp) {
                var cadena_valida = "";
                for (var j = 0; j < _exp[i].length; j++) {
                    if ((_exp[i].charCodeAt(j) >= 65 && _exp[i].charCodeAt(j) <= 90) || (_exp[i].charCodeAt(j) >= 48 && _exp[i].charCodeAt(j) <= 57)) {
                        if (_exp[i].length >= 3) {
                            cadena_valida += _exp[i].charAt(j).toUpperCase();
                        }
                    }
                }
                if (cadena_valida != "") {
                    nombreValidos.push(cadena_valida);
                }
            }

            for (var j in nombreValidos) {
                var normalize = reset_string(nombreValidos[j]);
                var substr = normalize.substring(0, 3).toUpperCase();
                nombresAbreviados.push(substr);
            }

            for (var n in nombresAbreviados) {
                abreviaturaFinal += nombresAbreviados[n] + "_";
            }
            abreviaturaFinal = abreviaturaFinal.substring(0, (abreviaturaFinal.length) - 1);
        } else {
            var normalize = reset_string(this.value);
            for (var i = 0; i < normalize.length; i++) {
                if ((normalize.charCodeAt(i) >= 65 && normalize.charCodeAt(i) <= 90) || (normalize.charCodeAt(i) >= 48 && normalize.charCodeAt(i) <= 57)) {
                    abreviaturaFinal += normalize.charAt(i).toUpperCase();
                }
            }
        }
        $("#code_role").val(abreviaturaFinal);
    });

}(window.jQuery));

