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

        vm.iconClass = 'glyphicon glyphicon-minus';

        init();

        ///////////////

        function init() {
            Results.queryCompany(vm.companyName).then(res => {
                vm.loading = false;
                vm.companyData = res.data;

                if (vm.companyData.aggregate.score_change > 0 ) {
                    vm.iconClass = 'glyphicon glyphicon-triangle-top text-success';
                }

                if (vm.companyData.aggregate.score_change < 0 ) {
                    vm.iconClass = 'glyphicon glyphicon-triangle-bottom text-danger';
                }

                console.log(vm.companyData);
            });
        }

        function back() {
            $state.go('home');
        }
    }
})();