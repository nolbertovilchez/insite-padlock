import path from 'path';

module.exports = (function () {
    var exports = {};

    exports.isAsset = (nameFIle) => {
        var assets = ["js", "css"];
        var name = "" + nameFIle;
        var _explote = name.split(".");
        var extension = _explote[(_explote.length - 1)];

        if (assets.indexOf(extension) > -1) {
            return _explote[0] + ".min." + extension;
        }
        return name;
    };

    exports.backslash2slash = (_uri) => {
        return path.normalize(_uri).replace(new RegExp('[\\\\]+', 'gi'), '/');
    };

    exports.getDestPath = (pathFile, src, dist) => {
        let _path = path.resolve(__dirname, './../');
        var regex_str = exports.backslash2slash(_path) + '\\' + src + '(\\/)*';
        var regex = new RegExp(regex_str, 'gi');
        var dir = path.dirname(exports.backslash2slash(pathFile).replace(regex, dist));
        return dir;
    };

    exports.getFileName = (pathFile) => {
        let _path = pathFile.split('/');

        return _path[(_path.length - 1)];
    };

    return exports;
}());

