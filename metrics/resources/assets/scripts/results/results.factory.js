(() => {
    'use strict';

    angular
        .module('app.results')
        .factory('Results', Results);

    function Results($http) {
        return {
            queryCompany: queryCompany
        };

        ////////////////

        function queryCompany(name) {
            return $http.get('/api/analyse?keyword=' + name);
        }

    }

})();