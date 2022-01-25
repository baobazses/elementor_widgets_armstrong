(function($) {
    var CarouselProgressBarScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.carousel-progressbar-container')[0];
        let autoplaySpeed = container.getAttribute("autoplay");

        //set initial datas
        let translateX = 0;
        let slideWidth = 0;
        let activeIndex = 0;

        //get progressBar, arrows & slide container
        let progressBar = container.querySelector('.progress-bar');
        let slidesContainer = container.querySelector('.slides');

        //get all slides
        let slidesList = container.getElementsByClassName('slide');
        let slidesCount = slidesList.length;
        if (slidesList && slidesCount > 1) {
            slideWidth = slidesList[0].offsetWidth + 30;

            let slidesWidth = 0;
            let slideId = 0;
            while (slidesWidth < container.offsetWidth) {
                let cloned = slidesList[0].cloneNode(true);
                if (slidesList.length > slideId) {
                    cloned = slidesList[slideId].cloneNode(true);
                }
                slidesContainer.appendChild(cloned);
                slidesWidth += slideWidth;
                slideId++;
            }

            slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

            //next arrow event listener
            setInterval(function() {
                //change slide showed
                slidesContainer.style.transition = "transform 0.5s";
                translateX -= slideWidth;
                activeIndex++;
                slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

                //if next is after last slide, new current is the first
                if (activeIndex >= slidesCount) {
                    activeIndex = 0;
                    translateX = 0;
                }
                progressBar.style.left = Math.round((100 / slidesCount) * activeIndex) + '%';

                setTimeout(function() {
                    slidesContainer.style.transition = "transform 0ms";
                    //after transition, return to first element for infinity loop
                    if (activeIndex == 0) {
                        slidesContainer.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, autoplaySpeed / 2)
            }, autoplaySpeed)
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/carousel_progressbar.default', CarouselProgressBarScript);
    });
})(jQuery);