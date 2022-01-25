(function($) {
    var ImageTitleDescriptionScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.image-container')[0];
        let title = container.querySelector('.image_title');
        let description = container.querySelector('.image_description');
        if (description != null) {
            description.style.transitionProperty = 'opacity, transform';

            container.addEventListener('mouseenter', function() {
                title.style.bottom = description.offsetHeight + 10 + 'px';
            })
            container.addEventListener('mouseleave', function() {
                title.style.bottom = '0px';
            })
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/image_title_description.default', ImageTitleDescriptionScript);
    });
})(jQuery);