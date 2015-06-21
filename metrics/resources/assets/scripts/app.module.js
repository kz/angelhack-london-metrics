(() => {
    'use strict';

    angular
        .module('app', [
            'app.core',
            'app.home',

            'ngAnimate',
            'ngSanitize',

            'ui.router'
        ])
        .config(appConfig)
    ;

    function appConfig($compileProvider) {
        // TODO: Uncomment when pushing to production
        // $compileProvider.debugInfoEnabled(false);
    }
})();