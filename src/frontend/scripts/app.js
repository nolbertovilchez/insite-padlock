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
        confirmButtonText: '<i class="fa fa-thumbs-o-up"></i> Estoy seguro de lo que hago.'
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