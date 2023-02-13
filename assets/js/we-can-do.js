(function($) {
    var WeCanDoScript = function($scope, $) {
        //get current widget
        let select = $scope.find('#we-can-do-select');
        let profil_arguments = $scope.find('.arguments-wrapper');
        select.change(function() {
            let option_select = $scope.find("#we-can-do-select option:selected")[0];

            //remove active class for all arguments
            profil_arguments.each(function(index) {
                $(this).removeClass("active");
            });

            //add active class in new current argument
            let argument_id = option_select.getAttribute("show-profil");
            $scope.find('#' + argument_id).addClass("active");
        });
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/we-can-do.default', WeCanDoScript);
    });
})(jQuery);