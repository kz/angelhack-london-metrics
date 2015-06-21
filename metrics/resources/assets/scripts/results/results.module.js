(() => {
    'use strict';

    angular
        .module('app.results', ['ui.router'])
        .config(routeConfig);

    function routeConfig($stateProvider) {
        $stateProvider
            .state('results', {
                url: '/results/:companyName',
                templateUrl: 'templates/results.html',
                controller: 'ResultsController as vm'
            })
        ;
    }
})();