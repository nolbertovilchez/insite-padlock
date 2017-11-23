const config = {
    isProd: false,
    phpmin: {silent: true},
    RenameAssets: {suffix: '.min'},
    bSyncReload: {stream: true},
    browserSync: {
        proxy: {target: "padlock.dev"},
        open: false,
        notify: true
    }
};

module.exports = config;