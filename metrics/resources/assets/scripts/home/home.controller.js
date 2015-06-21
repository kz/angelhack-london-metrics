(() => {
    'use strict';

    angular
        .module('app.home')
        .controller('HomeController', HomeController);

    function HomeController($state) {
        var vm = this;

        vm.companyName = '';
        vm.submit = submit;

        ///////////////

        function submit() {
            $state.go('results', {
                companyName: vm.companyName
            });
        }


    }
})();