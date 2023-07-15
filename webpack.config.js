const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry("profile", "./assets/styles/logged/profile.css")
    .addEntry("post", './assets/styles/logged/post.css')
    .addEntry("base_unlogged", './assets/styles/unlogged/base.css')
    .addEntry("home", './assets/styles/unlogged/home.css') // unlogged
    .addEntry('login', './assets/styles/unlogged/login.css')
    .addEntry('register', './assets/styles/unlogged/register.css')
    .addEntry('base_logged', './assets/styles/logged/base.css') 
    .addEntry("about", "./assets/styles/unlogged/about.css")
    .addEntry("dashboard", "./assets/dashboard.js")

    .enableStimulusBridge('./assets/controllers.json')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

module.exports = Encore.getWebpackConfig();
