let Encore = require('@symfony/webpack-encore');
let Webpack = require('webpack');
let CopyWebpackPlugin = require('copy-webpack-plugin');
let ImageminPlugin = require('imagemin-webpack-plugin').default;
let fs = require('fs');
let path = require('path');
let _ = require('lodash');

Encore
    .setOutputPath('public/assets')
    .setPublicPath('/assets')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // .enableVersioning(Encore.isProduction())

    .createSharedEntry('vendor', [
        'jquery',
        './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css',
        './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js',
        './node_modules/venobox/venobox/venobox.js',
        './node_modules/venobox/venobox/venobox.css',
        'paroller.js',
        'slick-carousel'
    ])

    .enableSassLoader()
    .autoProvidejQuery()

    // .addPlugin(new webpack.IgnorePlugin(requestRegExp, contextRegExp))
    .addPlugin(new CopyWebpackPlugin([{
        context: './assets/images/',
        from: '**',
        to: 'images'
    }]))
    .addPlugin(new ImageminPlugin({ test: /\.(jpe?g|png|gif)$/i }))

    .configureUglifyJsPlugin(function () {
        'use strict';

        return Encore.isProduction()  ? {
            // Eliminate comments
            comments: false,

            // Extract comments to separate file
            extractComments: true,

            // Compression specific options
            compress: {
                // Drop console statements
                dropConsole: true
            },
        } : {};
    })
;

function getFiles(dir, exclude, fileType) {
    'use strict';

    let files = fs.readdirSync(dir)
        .filter(function (file) {
            return -1 === exclude.indexOf(file) && !fs.statSync(path.join(dir, file)).isDirectory();
        });

    return _.map(files, function (filename) {
        let lastDotPosition = filename.lastIndexOf(".");
        let ext;
        if (lastDotPosition !== -1) {
            ext = filename.substr(lastDotPosition + 1);
            if (ext === fileType) {
                return filename.substr(0, lastDotPosition);
            }
        }
    });
}

let jsFiles = getFiles(__dirname + '/assets/js', [], 'js');
_.forEach(jsFiles, function (fileName) {
    'use strict';

    Encore.addEntry('js/' + fileName, ['./assets/js/' + fileName + '.js']);
});

let scssFiles = getFiles(__dirname + '/assets/scss', [], 'scss');
_.forEach(scssFiles, function (fileName) {
    'use strict';

    Encore.addStyleEntry('css/' + fileName, ['./assets/scss/' + fileName + '.scss']);
});

let config = Encore.getWebpackConfig();

module.exports = config;
