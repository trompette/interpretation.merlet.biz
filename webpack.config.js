const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

const production = Encore.isProduction();

Encore
    .setOutputPath(production ? 'public/assets/' : 'public/build/')
    .setPublicPath(production ? '/assets' : '/build')

    .addEntry('app', './assets/app.js')
    .enableStimulusBridge('./assets/controllers.json')

    .cleanupOutputBeforeBuild()
    .disableSingleRuntimeChunk()
    .enableSourceMaps(!production)
    .enableVersioning(production)
    .enableSassLoader()

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
;

module.exports = Encore.getWebpackConfig();
