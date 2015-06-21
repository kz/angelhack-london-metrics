(() => {
    'use strict';

    angular
        .module('app.results')
        .controller('ResultsController', ResultsController);

    function ResultsController($state, $stateParams, Results) {
        var vm = this;

        vm.loading = true;

        vm.companyName = $stateParams.companyName;
        vm.back = back;
        vm.companyData = null;

        init();

        ///////////////

        function init() {
            Results.queryCompany(vm.companyName).then(res => {
                vm.loading = false;
                vm.companyData = res.data;

                console.log(vm.companyData);
            });
        }

        function back() {
            $state.go('home');
        }
    }
})();