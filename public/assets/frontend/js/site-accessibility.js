/*
 * Accessibility tools panel and the header notice ticker.
 *
 * Each tool has levels 0 (off) .. n. The levels are written to <html> as
 * data-a11y-<tool>="<level>" attributes, which site-accessibility.css reacts to,
 * and kept in localStorage so they stay on while the visitor moves between pages.
 * This file loads in <head> so saved settings apply before the page paints.
 */
(function () {
    'use strict';

    var STORAGE_KEY = 'site-a11y';
    var root = document.documentElement;
    var state = {};

    try {
        state = JSON.parse(window.localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
        state = {};
    }

    // Colour tools are combined into one CSS filter, since a later filter would replace an earlier one.
    var FILTERS = {
        contrast: ['', 'contrast(1.45)', 'invert(1) hue-rotate(180deg)'],
        color: ['', 'grayscale(1)', 'sepia(0.85)', 'sepia(0.35) saturate(1.3) hue-rotate(-12deg)'],
        saturation: ['', 'saturate(0.5)', 'saturate(2)', 'saturate(0)']
    };

    function save() {
        try {
            window.localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        } catch (e) {
            // Private mode or blocked storage: settings still apply on this page.
        }
    }

    function apply() {
        Object.keys(state).forEach(function (tool) {
            if (state[tool] > 0) {
                root.setAttribute('data-a11y-' + tool, state[tool]);
            } else {
                root.removeAttribute('data-a11y-' + tool);
            }
        });

        var filter = Object.keys(FILTERS)
            .map(function (tool) { return FILTERS[tool][state[tool] || 0] || ''; })
            .filter(Boolean)
            .join(' ');
        if (filter) {
            root.style.setProperty('--a11y-filter', filter);
            root.setAttribute('data-a11y-filter', '');
        } else {
            root.style.removeProperty('--a11y-filter');
            root.removeAttribute('data-a11y-filter');
        }
    }

    function isPaused() {
        return state.pause > 0 || window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    function syncCarousels() {
        if (!window.bootstrap || !window.bootstrap.Carousel) return;
        document.querySelectorAll('.carousel').forEach(function (el) {
            var carousel = window.bootstrap.Carousel.getOrCreateInstance(el);
            if (state.pause > 0) {
                carousel.pause();
            } else if (el.hasAttribute('data-bs-ride')) {
                carousel.cycle();
            }
        });
    }

    apply();

    function setupPanel() {
        var wrap = document.querySelector('[data-a11y]');
        if (!wrap) return;

        var panel = wrap.querySelector('.a11y__panel');
        var openBtn = wrap.querySelector('[data-a11y-open]');
        var tools = wrap.querySelectorAll('[data-a11y-tool]');

        function render() {
            tools.forEach(function (btn) {
                var level = state[btn.getAttribute('data-a11y-tool')] || 0;
                btn.setAttribute('aria-pressed', level > 0 ? 'true' : 'false');
                btn.querySelectorAll('.a11y__levels span').forEach(function (bar, i) {
                    bar.classList.toggle('is-on', i < level);
                });
            });
        }

        function open() {
            panel.hidden = false;
            openBtn.setAttribute('aria-expanded', 'true');
            panel.querySelector('[data-a11y-close]').focus();
        }

        function close() {
            panel.hidden = true;
            openBtn.setAttribute('aria-expanded', 'false');
        }

        openBtn.addEventListener('click', function () {
            panel.hidden ? open() : close();
        });
        wrap.querySelector('[data-a11y-close]').addEventListener('click', function () {
            close();
            openBtn.focus();
        });
        wrap.querySelector('[data-a11y-reset]').addEventListener('click', function () {
            Object.keys(state).forEach(function (tool) { state[tool] = 0; });
            apply();
            save();
            render();
            syncCarousels();
        });

        tools.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var tool = btn.getAttribute('data-a11y-tool');
                var levels = parseInt(btn.getAttribute('data-levels'), 10) || 1;
                state[tool] = ((state[tool] || 0) + 1) % (levels + 1);
                apply();
                save();
                render();
                if (tool === 'pause') syncCarousels();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !panel.hidden) {
                close();
                openBtn.focus();
            }
        });
        document.addEventListener('click', function (e) {
            if (!panel.hidden && !wrap.contains(e.target)) close();
        });

        render();
        if (state.pause > 0) syncCarousels();
    }

    // "Important notices" in the header: shows one title at a time.
    function setupNoticeTicker() {
        var list = document.querySelector('[data-notice-ticker]');
        if (!list) return;
        var items = list.querySelectorAll('li');
        if (items.length < 2) return;

        var index = 0;
        var hovering = false;
        list.addEventListener('mouseenter', function () { hovering = true; });
        list.addEventListener('mouseleave', function () { hovering = false; });
        list.addEventListener('focusin', function () { hovering = true; });
        list.addEventListener('focusout', function () { hovering = false; });

        setInterval(function () {
            if (hovering || isPaused() || document.hidden) return;
            items[index].classList.remove('is-active');
            index = (index + 1) % items.length;
            items[index].classList.add('is-active');
        }, 4000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        setupPanel();
        setupNoticeTicker();
    });
})();
