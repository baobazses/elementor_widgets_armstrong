(function($) {
    var historyWithImageScript = function($scope, $) {
        //get current widget
        let container = $scope.find('.history-with-image-events-container')[0];

        //set initial datas
        let translateX = -440;
        let activeIndex = 0;

        //get arrows & event wrapper
        let prevArrow = container.querySelector('.prev-arrow');
        let nextArrow = container.querySelector('.next-arrow');
        let historyEvents = container.querySelector('.history-with-image-events');

        //get all titles & descriptions
        let titles = container.getElementsByClassName('title');
        let descriptions = container.getElementsByClassName('description');

        //get all events
        let historyEvent = container.getElementsByClassName('history-with-image-event');
        let historyEventsCount = historyEvent.length;
        if (historyEvent && historyEvent.length > 1) {
            //cloned elements to infinity loop
            let clonedFirst = historyEvent[0].cloneNode(true);
            clonedFirst.className = '';
            clonedFirst.className = "history-with-image-event history-with-image-event-firstlast";
            let title = clonedFirst.querySelector('.title');
            title.classList.remove('title-active');
            let description = clonedFirst.querySelector('.description');
            description.classList.remove('description-active');

            let clonedSecond = historyEvent[1].cloneNode(true);
            let clonedThird = clonedFirst.cloneNode(true);
            if (historyEvent.length > 2) {
                clonedThird = historyEvent[2].cloneNode(true);
            }
            clonedSecond.className = '';
            clonedSecond.className = "history-with-image-eventhistory-with-image-event-secondlast";
            clonedThird.className = '';
            clonedThird.className = "history-with-image-event history-with-image-event-thirdlast";
            let clonedLast = historyEvent[historyEventsCount - 1].cloneNode(true);
            clonedLast.className = '';
            clonedLast.className = "history-with-image-event history-with-image-event-newfirst";

            historyEvents.appendChild(clonedFirst);
            historyEvents.appendChild(clonedSecond);
            historyEvents.appendChild(clonedThird);
            historyEvents.insertBefore(clonedLast, historyEvents.firstChild);

            historyEvents.style.transform = 'translateX(' + translateX + 'px)';

            //prev arrow event listener
            prevArrow.addEventListener('click', function() {
                //change event showed
                historyEvents.style.transition = "transform 1s";
                translateX += 440;
                activeIndex--;
                historyEvents.style.transform = 'translateX(' + translateX + 'px)';

                //remove all titles & description active
                for (let title of titles) {
                    title.classList.remove('title-active');
                }
                for (let description of descriptions) {
                    description.classList.remove('description-active');
                }
                //set title & description active to new current
                let currentHistoryEvent = container.querySelector('.history-with-image-event-' + activeIndex);
                //if return to the start of events, new current is the last
                if (activeIndex < 0) {
                    activeIndex = historyEventsCount - 1;
                    translateX = -(440 * (activeIndex + 1));
                    currentHistoryEvent = container.querySelector('.history-with-image-event-newfirst');
                }

                let title = currentHistoryEvent.querySelector('.title');
                title.classList.add('title-active');
                let description = currentHistoryEvent.querySelector('.description');
                description.classList.add('description-active');

                setTimeout(function() {
                    historyEvents.style.transition = "transform 0ms";
                    //after transition, return to last element for infinity loop
                    if (activeIndex == historyEventsCount - 1) {
                        historyEvents.style.transform = 'translateX(' + translateX + 'px)';

                        let currentHistoryEvent = container.querySelector('.history-with-image-event-' + activeIndex);
                        let title = currentHistoryEvent.querySelector('.title');
                        title.classList.add('title-active');

                        let description = currentHistoryEvent.querySelector('.description');
                        description.classList.add('description-active');
                    }
                }, 1000)
            })

            //next arrow event listener
            nextArrow.addEventListener('click', function() {
                //change event showed
                historyEvents.style.transition = "transform 1s";
                translateX -= 440;
                activeIndex++;
                historyEvents.style.transform = 'translateX(' + translateX + 'px)';

                //remove all titles & description active
                for (let title of titles) {
                    title.classList.remove('title-active');
                }
                for (let description of descriptions) {
                    description.classList.remove('description-active');
                }

                //set title & description active to new current
                let currentHistoryEvent = container.querySelector('.history-with-image-event-' + activeIndex);
                //if next is after last event, new current is the first
                if (activeIndex >= historyEventsCount) {
                    activeIndex = 0;
                    translateX = -440;
                    currentHistoryEvent = container.querySelector('.history-with-image-event-firstlast');
                }

                let title = currentHistoryEvent.querySelector('.title');
                title.classList.add('title-active');
                let description = currentHistoryEvent.querySelector('.description');
                description.classList.add('description-active');

                setTimeout(function() {
                    historyEvents.style.transition = "transform 0ms";
                    //after transition, return to first element for infinity loop
                    if (activeIndex == 0) {
                        historyEvents.style.transform = 'translateX(' + translateX + 'px)';
                        let currentHistoryEvent = container.querySelector('.history-with-image-event-' + activeIndex);
                        let title = currentHistoryEvent.querySelector('.title');
                        title.classList.add('title-active');

                        let description = currentHistoryEvent.querySelector('.description');
                        description.classList.add('description-active');
                    }
                }, 1000)
            })
        }
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/history_with_image.default', historyWithImageScript);
    });
})(jQuery);