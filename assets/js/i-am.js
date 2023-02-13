(function($) {
    var IAm = function($scope, $) {
        //get current widget
        let select = $scope.find('#i-am-select');
        let button = $scope.find('#i-am-button');
        console.log(button);
        select.change(function() {
            let option_select = $scope.find("#i-am-select option:selected")[0];

            //add active class in new current argument
            let profil_link = option_select.getAttribute("profil-url");
            console.log(profil_link);
            button.attr("href", profil_link);
        });
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/i-am.default', IAm);
    });
})(jQuery);