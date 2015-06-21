(() => {
    'use strict';

    angular
        .module('app.home', ['ui.router', 'app.results'])
        .config(routeConfig);

    function routeConfig($stateProvider) {
        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'templates/homepage.html',
                controller: 'HomeController as vm'
            })
        ;
    }
})();