(function($) {
    var CarouselProgressBarScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.carousel-progressbar-container')[0];
        let autoplaySpeed = container.getAttribute("autoplay");
        let transitionspeed = container.getAttribute("transition-speed");

        //set initial datas
        let translateX = 0;
        let slideWidth = 0;
        let activeIndex = 0;

        //get progressBar, arrows & slide container
        let progressBar = container.querySelector('.progress-bar');
        let prevArrow = container.querySelector('.prev-arrow');
        let nextArrow = container.querySelector('.next-arrow');
        let slidesContainer = container.querySelector('.slides');

        //get all slides
        let slidesList = container.getElementsByClassName('slide');
        let slidesCount = slidesList.length;
        if (slidesList && slidesCount > 1) {
            slideWidth = slidesList[0].offsetWidth + 30;
            translateX = -slideWidth;

            let slidesWidth = 0;
            let slideId = 0;
            let clonedLast = slidesList[slidesCount - 1].cloneNode(true);
            while (slidesWidth < container.offsetWidth) {
                let cloned = slidesList[0].cloneNode(true);
                if (slidesList.length > slideId) {
                    cloned = slidesList[slideId].cloneNode(true);
                }
                slidesContainer.appendChild(cloned);
                slidesWidth += slideWidth;
                slideId++;
            }

            slidesContainer.insertBefore(clonedLast, slidesContainer.firstChild);

            slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

            //prev arrow event listener
            prevArrow.addEventListener('click', function() {
                //change slide showed
                slidesContainer.style.transition = "transform " + transitionspeed + "ms";
                translateX += slideWidth;
                activeIndex--;
                slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

                //if return to the start of slides, new current is the last
                if (activeIndex < 0) {
                    activeIndex = slidesCount - 1;
                    translateX = -(slideWidth * (activeIndex + 1));
                }
                progressBar.style.left = (100 / slidesCount) * activeIndex + '%';

                setTimeout(function() {
                    slidesContainer.style.transition = "transform 0ms";
                    //after transition, return to last element for infinity loop
                    if (activeIndex == slidesCount - 1) {
                        slidesContainer.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, transitionspeed)
            })

            //next arrow event listener
            nextArrow.addEventListener('click', function() {
                //change slide showed
                slidesContainer.style.transition = "transform " + transitionspeed + "ms";
                translateX -= slideWidth;
                activeIndex++;
                slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

                //if next is after last slide, new current is the first
                if (activeIndex >= slidesCount) {
                    activeIndex = 0;
                    translateX = -slideWidth;
                }
                progressBar.style.left = Math.round((100 / slidesCount) * activeIndex) + '%';

                setTimeout(function() {
                    slidesContainer.style.transition = "transform 0ms";
                    //after transition, return to first element for infinity loop
                    if (activeIndex == 0) {
                        slidesContainer.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, transitionspeed)
            })

            //autoplay mode
            if (autoplaySpeed && autoplaySpeed >= 1000) {
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
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/carousel_progressbar.default', CarouselProgressBarScript);
    });
})(jQuery);