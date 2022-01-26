(function($) {
    var VerticalCarouselScript = function($scope, $) {
        //get current widget
        let slideTitlesContainer = $scope.find('.slidetitle_container');
        let slideTitlesIcon = $scope.find('.slidetitle_icon');
        let slideTitles = $scope.find('.slidetitle');
        let slides = $scope.find('.slide');
        slideTitlesContainer.each(function(index) {
            $(this).click(function() {
                //remove active class for all icons and titles
                slideTitlesIcon.each(function(index) {
                    $(this).removeClass("slidetitle_icon-min_size slidetitle_icon-active");
                });
                slideTitles.each(function(index) {
                    $(this).removeClass("slidetitle-active");
                });

                //add active class in current icon and title
                $(this).find('.slidetitle').addClass('slidetitle-active');
                $(this).find('.slidetitle_icon').addClass('slidetitle_icon-min_size slidetitle_icon-active');

                //remove active class for all slides
                slides.each(function(index) {
                    $(this).removeClass("slide-active");
                });

                //add active class in new current video
                let slide_class = $(this).attr("slide-to");
                $scope.find('.' + slide_class).addClass("slide-active");
            })
        });
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/vertical_carousel.default', VerticalCarouselScript);
    });
})(jQuery);