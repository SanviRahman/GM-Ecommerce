/* Collection pages: four category cards per slide (2 x 2 on mobile). */
(function () {
    'use strict';
    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-lk-scroll]');
        if (!button) return;
        var track = document.getElementById('lk-collections-track');
        if (!track) return;
        var pages = track.querySelectorAll('.lk-collection-page');
        if (pages.length < 2) return;
        var width = track.clientWidth;
        if (!width) return;
        var current = Math.round(track.scrollLeft / width);
        var increment = button.getAttribute('data-lk-scroll') === 'next' ? 1 : -1;
        var target = Math.max(0, Math.min(pages.length - 1, current + increment));
        track.scrollTo({ left: target * width, behavior: 'smooth' });
    });

    document.addEventListener('keydown', function (event) {
        var track = document.getElementById('lk-collections-track');
        if (!track || document.activeElement !== track) return;
        if (event.key !== 'ArrowRight' && event.key !== 'ArrowLeft') return;
        var pages = track.querySelectorAll('.lk-collection-page');
        if (pages.length < 2 || !track.clientWidth) return;
        event.preventDefault();
        var current = Math.round(track.scrollLeft / track.clientWidth);
        var target = Math.max(0, Math.min(pages.length - 1, current + (event.key === 'ArrowRight' ? 1 : -1)));
        track.scrollTo({ left: target * track.clientWidth, behavior: 'smooth' });
    });
})();
