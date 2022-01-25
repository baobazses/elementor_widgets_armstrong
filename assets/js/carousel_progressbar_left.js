(function($) {
    var CarouselProgressBarLeftScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.carousel-progressbar-left-container')[0];

        //set initial datas
        let translateX = -446;
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
            //cloned elements to infinity loop
            let clonedFirst = slidesList[0].cloneNode(true);
            clonedFirst.className = 'slide';
            let clonedSecond = slidesList[1].cloneNode(true);
            let clonedThird = clonedFirst.cloneNode(true);
            clonedSecond.className = 'slide';
            let clonedLast = slidesList[slidesCount - 1].cloneNode(true);
            clonedLast.className = 'slide';

            slidesContainer.appendChild(clonedFirst);
            slidesContainer.appendChild(clonedSecond);
            slidesContainer.appendChild(clonedThird);
            slidesContainer.insertBefore(clonedLast, slidesContainer.firstChild);

            slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

            //prev arrow event listener
            prevArrow.addEventListener('click', function() {
                //change slide showed
                slidesContainer.style.transition = "transform 0.5s";
                translateX += 446;
                activeIndex--;
                slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

                //if return to the start of slides, new current is the last
                if (activeIndex < 0) {
                    activeIndex = slidesCount - 1;
                    translateX = -(446 * (activeIndex + 1));
                }
                progressBar.style.left = (100 / slidesCount) * activeIndex + '%';

                setTimeout(function() {
                    slidesContainer.style.transition = "transform 0ms";
                    //after transition, return to last element for infinity loop
                    if (activeIndex == slidesCount - 1) {
                        slidesContainer.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, 500)
            })

            //next arrow event listener
            nextArrow.addEventListener('click', function() {
                //change slide showed
                slidesContainer.style.transition = "transform 0.5s";
                translateX -= 446;
                activeIndex++;
                slidesContainer.style.transform = 'translateX(' + translateX + 'px)';

                //if next is after last slide, new current is the first
                if (activeIndex >= slidesCount) {
                    activeIndex = 0;
                    translateX = -446;
                }
                progressBar.style.left = Math.round((100 / slidesCount) * activeIndex) + '%';

                setTimeout(function() {
                    slidesContainer.style.transition = "transform 0ms";
                    //after transition, return to first element for infinity loop
                    if (activeIndex == 0) {
                        slidesContainer.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, 500)
            })
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/carousel_progressbar_left.default', CarouselProgressBarLeftScript);
    });
})(jQuery);