var noty = function (opt) {
    return new Noty(opt);
};
var moduleUrl = (Request.Host + Request.BaseUrl + Request.UrlHash.m);
var controllerUrl = moduleUrl + "/" + Request.UrlHash.c;

