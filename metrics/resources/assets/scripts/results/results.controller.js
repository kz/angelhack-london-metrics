(() => {
    'use strict';

    angular
        .module('app.results')
        .controller('ResultsController', ResultsController);

    function ResultsController($state, $stateParams, Results) {
        var vm = this;

        vm.companyName = $stateParams.companyName;
        vm.back = back;

        init()

        ///////////////

        function init() {
            Results.queryCompany(vm.companyName).then(res => {
                console.log(res);
            });
        }

        function back() {
            $state.go('home');
        }
    }
})();