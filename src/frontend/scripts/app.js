var noty = function (opt) {
    return new Noty(opt);
};
var moduleUrl = (Request.Host + Request.BaseUrl + Request.UrlHash.m);
var controllerUrl = moduleUrl + "/" + Request.UrlHash.c;

var _confirm = function (html, success, error, title, type) {
    var titulo = "¡Advertencia!";
    var tipo = "warning";
    if (typeof title !== "undefined") {
        titulo = title;
    }
    if (typeof type !== "undefined") {
        tipo = type;
    }
    swal({
        title: titulo,
        html: html,
        type: tipo,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '<i class="fa fa-thumbs-o-up"></i> Estoy seguro de lo que hago.',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            if (typeof success != "undefined")
                success();
        } else if (result.dismiss === 'cancel') {
            if (typeof error != "undefined")
                error();
        }
    });
};

var _alert = function (html, success, error, title, type) {
    var titulo = "¡Advertencia! ";
    var tipo = "warning";
    if (typeof title !== "undefined") {
        titulo = title;
    }
    if (typeof type !== "undefined") {
        tipo = type;
    }
    swal({
        title: titulo,
        html: html,
        type: tipo,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    }).then(function () {
        if (typeof success != "undefined")
            success();
    }, function () {
        if (typeof error != "undefined")
            error();
    });
};

var _success = function (html, success, error, title, type) {
    var titulo = "¡Conforme! ";
    var tipo = "success";
    if (typeof title !== "undefined") {
        titulo = title;
    }
    if (typeof type !== "undefined") {
        tipo = type;
    }
    swal({
        title: titulo,
        html: html,
        type: tipo,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    }).then(function () {
        if (typeof success != "undefined")
            success();
    }, function () {
        if (typeof error != "undefined")
            error();
    });
};

var reset_string = function (str) {
    var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÇçĆǴḰĹḾŃṔŔŚǗẂÝŹ",
            to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuuccCGKLMNPRSVWYZ",
            mapping = {};

    for (var i = 0, j = from.length; i < j; i++) {
        mapping[ from.charAt(i) ] = to.charAt(i);
    }

    var ret = [];
    for (var i = 0, j = str.length; i < j; i++) {
        var c = str.charAt(i);
        if (mapping.hasOwnProperty(str.charAt(i))) {
            ret.push(mapping[ c ]);
        } else {
            ret.push(c);
        }
    }
    return ret.join('');
};

jQuery.extend(jQuery.validator.messages, {
    required: "Este campo es obligatorio",
    remote: "Por favor corrija este campo.",
    email: "Por favor ingrese una direccion valida.",
    url: "Por favor ingrese una URL valida.",
    date: "Por favor ingrese una fecha valida.",
    number: "Por favor ingrese un numero valido.",
    digits: "Por favor ingrese solo digitos.",
    equalTo: "Por favor ingrese el mismo valor de nuevo.",
    maxlength: jQuery.validator.format("Por favor ingrese no mas que {0} caracteres."),
    minlength: jQuery.validator.format("Por favor ingrese al menos {0} caracteres."),
    rangelength: jQuery.validator.format("Por favor ingrese un valor entre {0} y {1} caracteres."),
    range: jQuery.validator.format("Por favor ingrese un valor entre {0} y {1}."),
    max: jQuery.validator.format("Por favor ingrese un valor menor o igual que {0}."),
    min: jQuery.validator.format("Por favor ingrese un valor mayor o igual que {0}.")
});