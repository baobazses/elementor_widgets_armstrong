(function($) {
    var historyScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.history-events-container')[0];

        //set initial datas
        let translateX = 0;
        let slideWidth = 0;
        let activeIndex = 0;

        //get arrows & event wrapper
        let prevArrow = container.querySelector('.prev-arrow');
        let nextArrow = container.querySelector('.next-arrow');
        let historyEvents = container.querySelector('.history-events');

        //get all titles, separators & descriptions
        let titles = container.getElementsByClassName('title');
        let separators = container.getElementsByClassName('separator');
        let descriptions = container.getElementsByClassName('description');

        //get all events
        let historyEvent = container.getElementsByClassName('history-event');
        let historyEventsCount = historyEvent.length;
        if (historyEvent && historyEvent.length > 1) {
            //cloned elements to infinity loop
            slideWidth = historyEvent[0].offsetWidth + 30;
            translateX = -slideWidth;

            let slidesWidth = 0;
            let slideId = 0;
            let clonedLast = historyEvent[historyEventsCount - 1].cloneNode(true);
            while (slidesWidth < container.offsetWidth) {
                let cloned = historyEvent[0].cloneNode(true);
                if (historyEvent.length > slideId) {
                    cloned = historyEvent[slideId].cloneNode(true);
                }
                if (slideId == 0) {
                    cloned.className = '';
                    cloned.className = "history-event history-event-firstlast";
                }
                historyEvents.appendChild(cloned);
                slidesWidth += slideWidth;
                slideId++;
            }

            clonedLast.className = '';
            clonedLast.className = "history-event history-event-newfirst";
            historyEvents.insertBefore(clonedLast, historyEvents.firstChild);

            historyEvents.style.transform = 'translateX(' + translateX + 'px)';

            //prev arrow event listener
            prevArrow.addEventListener('click', function() {
                //change event showed
                historyEvents.style.transition = "transform 1s";
                translateX += slideWidth;
                activeIndex--;
                historyEvents.style.transform = 'translateX(' + translateX + 'px)';

                //remove all titles, separators & description active
                for (let title of titles) {
                    title.classList.remove('title-active');
                }
                for (let separator of separators) {
                    separator.classList.remove('separator-active');
                }
                for (let description of descriptions) {
                    description.classList.remove('description-active');
                }
                //set title, separator & description active to new current
                let currentHistoryEvent = container.querySelector('.history-event-' + activeIndex);
                //if return to the start of events, new current is the last
                if (activeIndex < 0) {
                    activeIndex = historyEventsCount - 1;
                    translateX = -(slideWidth * (activeIndex + 1));
                    currentHistoryEvent = container.querySelector('.history-event-newfirst');
                }

                let title = currentHistoryEvent.querySelector('.title');
                title.classList.add('title-active');
                let separator = currentHistoryEvent.querySelector('.separator');
                separator.classList.add('separator-active');
                let description = currentHistoryEvent.querySelector('.description');
                description.classList.add('description-active');

                if (activeIndex == historyEventsCount - 1) {
                    currentHistoryEvent = container.querySelector('.history-event-' + activeIndex);

                    title = currentHistoryEvent.querySelector('.title');
                    title.classList.add('title-active');

                    separator = currentHistoryEvent.querySelector('.separator');
                    separator.classList.add('separator-active');

                    description = currentHistoryEvent.querySelector('.description');
                    description.classList.add('description-active');
                }
                setTimeout(function() {
                    historyEvents.style.transition = "transform 0ms";
                    //after transition, return to last element for infinity loop
                    if (activeIndex == historyEventsCount - 1) {
                        historyEvents.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, 1000)
            })

            //next arrow event listener
            nextArrow.addEventListener('click', function() {
                //change event showed
                historyEvents.style.transition = "transform 1s";
                translateX -= slideWidth;
                activeIndex++;
                historyEvents.style.transform = 'translateX(' + translateX + 'px)';

                //remove all titles, separator & description active
                for (let title of titles) {
                    title.classList.remove('title-active');
                }
                for (let separator of separators) {
                    separator.classList.remove('separator-active');
                }
                for (let description of descriptions) {
                    description.classList.remove('description-active');
                }

                //set title, separator & description active to new current
                let currentHistoryEvent = container.querySelector('.history-event-' + activeIndex);
                //if next is after last event, new current is the first
                if (activeIndex >= historyEventsCount) {
                    activeIndex = 0;
                    translateX = -slideWidth;
                    currentHistoryEvent = container.querySelector('.history-event-firstlast');
                }

                let title = currentHistoryEvent.querySelector('.title');
                title.classList.add('title-active');
                let separator = currentHistoryEvent.querySelector('.separator');
                separator.classList.add('separator-active');
                let description = currentHistoryEvent.querySelector('.description');
                description.classList.add('description-active');

                if (activeIndex == 0) {;
                    currentHistoryEvent = container.querySelector('.history-event-' + activeIndex);

                    title = currentHistoryEvent.querySelector('.title');
                    title.classList.add('title-active');

                    separator = currentHistoryEvent.querySelector('.separator');
                    separator.classList.add('separator-active');

                    description = currentHistoryEvent.querySelector('.description');
                    description.classList.add('description-active');
                }

                setTimeout(function() {
                    historyEvents.style.transition = "transform 0ms";
                    //after transition, return to first element for infinity loop
                    if (activeIndex == 0) {
                        historyEvents.style.transform = 'translateX(' + translateX + 'px)';
                    }
                }, 1000)
            })
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/history.default', historyScript);
    });
})(jQuery);