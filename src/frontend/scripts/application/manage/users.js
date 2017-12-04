(function ($) {
    'use-strict';

    var $modalCreateUsuario = $("#md-manage-create-users");

    $modalCreateUsuario.on("shown.bs.modal", function () {
        $("#cbo_usuario").select2({
            language: "es",
            ajax: {
                url: moduleUrl + '/users/list_users_no_app?id=' + Request._GET.id,
                dataType: 'json',
                delay: 250,
                allowClear: true,
                processResults: function (data) {
                    return {
                        results: data.response.items,
                        pagination: {
                            more: false
                        }
                    };
                },
            },
            placeholder: 'Seleccione Usuario',
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 3,
            templateResult: function (repo) {
                var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title fs-10'>" + repo.text + "</div></div>";
                return markup;
            },
            templateSelection: function (repo) {
                return repo.text;
            },
            dropdownParent: $modalCreateUsuario
        });
    }).on("hidden.bs.modal", function () {
        if ($('#cbo_usuario').hasClass("select2-hidden-accessible")) {
            // Select2 has been initialized
            $('#cbo_usuario').select2('destroy');
        }
        $modalCreateUsuario.find("#content-edit").addClass("d-none");
        $modalCreateUsuario.find("#content-create").removeClass("d-none");
    });

}(window.jQuery));
