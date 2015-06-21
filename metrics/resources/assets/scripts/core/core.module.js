(() => {
    'use strict';

    angular
        .module('app.core', [
            'ngAnimate',
            'ngSanitize',

            'ui.router'
        ])
        .config(routeConfig);

    function routeConfig($locationProvider) {
        $locationProvider.html5Mode(true);
    }
})();