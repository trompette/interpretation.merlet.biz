const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
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

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })
;

module.exports = Encore.getWebpackConfig();
