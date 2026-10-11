/* Accessible desktop search toggle; no changes to mobile V1 sidebar. */
(function () {
    'use strict';
    function ready() {
        var box = document.querySelector('.section-header .search-box');
        if (!box) return;
        var trigger = box.querySelector('.leatherket-desktop-search-trigger');
        var input = box.querySelector('form.search input[name="q"]');
        if (!trigger || !input) return;

        function setOpen(open) {
            box.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (open) input.focus();
        }
        trigger.addEventListener('click', function () {
            setOpen(!box.classList.contains('is-open'));
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && box.classList.contains('is-open')) {
                setOpen(false);
                trigger.focus();
            }
        });
        document.addEventListener('click', function (event) {
            if (!box.contains(event.target) && box.classList.contains('is-open')) setOpen(false);
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', ready);
    else ready();
})();
