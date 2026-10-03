// Vite-compatible imports
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

// Import slick-carousel
import "slick-carousel/slick/slick.min.js";

import { Fancybox } from "@fancyapps/ui";

// Bootstrap breakpoints
window.mq = {
    xs: 0,
    sm: 576,
    md: 768,
    lg: 992,
    xl: 1200,
    xxl: 1400,
};

// Bind Fancybox to all links with data-fancybox attribute
Fancybox.bind("[data-fancybox]", {
    // Options
});

const mq = {
    sm: 576,
    md: 768,
    lg: 992,
    xl: 1200,
    xxl: 1400
};

// Zelfde breakpoint als de CSS (media-breakpoint-up(xl)).
// matchMedia vuurt ook bij browserzoom, i.p.v. enkel window.resize.
const mqDesktop = window.matchMedia(`(min-width: ${mq.xl}px)`);

// Toggle panel
$(document).on("click", ".js-toggle-panel", function (e) {
    e.preventDefault();
    $(this).toggleClass("is-active");
    $("body").toggleClass("lock");
});

// Close Panel
$(document).on("click", ".js-close-panel", function (e) {
    e.preventDefault();
    $(".js-toggle-panel").removeClass("is-active");
    $("body").removeClass("lock");
});

var replaceMenu = function () {
    var isMobile = !mqDesktop.matches;
    
    if (isMobile) {
        // Verplaats menus naar panel op mobiel
        $(".js-panel").append($(".js-main-menu"));
        $(".js-panel").append($(".js-header-top-menu"));
        // Mega-menu blijft in header, maar wordt drawer menu
        $(".header-main__nav > ul > li .mega-menu").each(function() {
            if (!$(this).hasClass("drawer-menu")) {
                $(this).prepend('<button class="js-mega-menu-back"><i class="fa-solid fa-chevron-left"></i> Terug</button>');
                $(this).addClass("drawer-menu");
            }
        });
    } else {
        // Zet menus terug in header op desktop
        $(".js-header-top").append($(".js-header-top-menu"));
        $(".js-main-nav").prepend($(".js-main-menu"));
        // Reset drawer menus
        $(".mega-menu.drawer-menu").each(function() {
            $(this).removeClass("drawer-menu active");
            $(this).find(".js-mega-menu-back").remove();
        });
        $(".js-panel").removeClass("panel-active");
        $(".js-toggle-panel").removeClass("is-active");
        $("body").removeClass("lock");
    }
};

replaceMenu();

if (mqDesktop.addEventListener) {
    mqDesktop.addEventListener("change", replaceMenu);
} else {
    mqDesktop.addListener(replaceMenu);
}

// Mega-menu drawer navigation
$(document).on("click", ".header-main__nav > ul > li > a", function (e) {
    if (!mqDesktop.matches && $(this).siblings(".drawer-menu").length) {
        e.preventDefault();
        $(this).siblings(".drawer-menu").addClass("active");
        $("body").addClass("lock");
    }
});

// Mega-menu back button
$(document).on("click", ".js-mega-menu-back", function (e) {
    e.preventDefault();
    $(this).closest(".drawer-menu").removeClass("active");
    // NIET body.lock verwijderen - panel moet zichtbaar blijven
});

// Close mega-menu drawer when clicking a link inside
$(document).on("click", ".drawer-menu a:not(.js-mega-menu-back)", function (e) {
    if (!mqDesktop.matches) {
        $(this).closest(".drawer-menu").removeClass("active");
        $("body").removeClass("lock");
    }
});

// Search toggle on mobile
$(document).on("click", ".js-search-toggle", function (e) {
    e.preventDefault();
    $(".js-search-wrapper").toggleClass("active");
    if ($(".js-search-wrapper").hasClass("active")) {
        $(".js-search-wrapper input").focus();
    }
});

// Close search when clicking outside
$(document).on("click", function (e) {
    if (!mqDesktop.matches) {
        if (!$(e.target).closest(".header__search-wrapper, .js-search-toggle").length) {
            $(".js-search-wrapper").removeClass("active");
        }
    }
});

// Search on Enter key
$(document).on("keypress", ".js-search-input", function (e) {
    if (e.which == 13) {
        e.preventDefault();
        const searchTerm = $(this).val();
        if (searchTerm) {
            window.location.href = "/?s=" + encodeURIComponent(searchTerm);
        }
    }
});

// Footer menu toggle on mobile
$(document).on("click", ".footer-menu-toggle", function (e) {
    e.preventDefault();
    const $button = $(this);
    const $menu = $button.siblings(".footer-menu");
    
    $menu.slideToggle(300);
    $button.toggleClass("is-active");
});

$(document).on("click", ".home-about-step__title", function () {
    const $step = $(this).closest(".home-about-step");
    const $steps = $step.closest(".home-about-steps").find(".home-about-step");

    $steps.not($step).removeClass("is-active show").find(".home-about-step__content").stop(true, true).slideUp(200);

    if ($step.hasClass("show")) {
        $step.removeClass("is-active show");
        $step.find(".home-about-step__content").stop(true, true).slideUp(200);
        return;
    }

    $step.addClass("is-active show");
    $step.find(".home-about-step__content").stop(true, true).slideDown(200);
});

$(document).on("click", ".js-faq-toggle", function () {
    const $item = $(this).closest(".js-faq");
    const $wrapper = $item.closest(".faq-wrapper");
    const $otherItems = $wrapper.find(".js-faq").not($item);

    $otherItems.removeClass("is-active");
    $otherItems.find(".js-faq-toggle").removeClass("is-active");
    $otherItems.find(".js-faq-content").stop(true, true).slideUp(200);

    $item.toggleClass("is-active");
    $(this).toggleClass("is-active");
    $item.find(".js-faq-content").stop(true, true).slideToggle(200);
});

const animateValueCounters = function () {
    const counters = document.querySelectorAll(".value[data-target]");
    const speed = 250;

    counters.forEach((counter) => {
        const target = Number(counter.getAttribute("data-target"));
        if (!target || Number.isNaN(target)) {
            return;
        }

        const animate = () => {
            const currentValue = Number(counter.innerText) || 0;
            const step = target / speed;

            if (currentValue < target) {
                counter.innerText = String(Math.min(target, Math.ceil(currentValue + step)));
                window.setTimeout(animate, 50);
                return;
            }

            counter.innerText = String(target);
        };

        animate();
    });
};

const initAdviceCategoryPicker = function () {
    const $categoriesWrap = $('.js-advice-categories');
    if (!$categoriesWrap.length || !Array.isArray(window.creatorsAdviceCategories)) {
        return;
    }

    const categories = window.creatorsAdviceCategories;
    const $groupsWrap = $('.js-advice-groups');
    const $summaryWrap = $('.js-advice-summary');

    const state = {
        cats: new Set(),
        subs: {} // catId -> Set of variant labels
    };

    const escapeHtml = function (value) {
        return $('<div>').text(value).html();
    };

    const renderGroups = function () {
        $groupsWrap.empty();

        categories
            .filter((cat) => state.cats.has(cat.id) && cat.variants && cat.variants.length)
            .forEach((cat) => {
                const chosen = state.subs[cat.id] || new Set();
                const iconHtml = cat.icon_url
                    ? '<span class="advice-page__category-icon"><img src="' + escapeHtml(cat.icon_url) + '" alt=""></span>'
                    : '<span class="advice-page__category-icon advice-page__category-icon--fallback" aria-hidden="true"><i class="fa-sharp fa-solid fa-plus"></i></span>';

                const $group = $(
                    '<div class="advice-page__group" data-advice-group="' + cat.id + '">' +
                        '<div class="advice-page__group-header">' +
                            iconHtml +
                            '<span>' + escapeHtml(cat.label) + ' — wat voor soort?</span>' +
                            '<button type="button" class="advice-page__group-remove" data-advice-cat-remove="' + cat.id + '">verwijderen</button>' +
                        '</div>' +
                        '<div class="advice-page__chips"></div>' +
                    '</div>'
                );

                const $chips = $group.find('.advice-page__chips');
                cat.variants.forEach((variant) => {
                    const $chip = $('<button type="button" class="advice-page__chip"></button>')
                        .text(variant)
                        .attr('data-advice-sub', variant)
                        .toggleClass('is-active', chosen.has(variant));
                    $chips.append($chip);
                });

                $groupsWrap.append($group);
            });
    };

    const renderSummary = function () {
        const parts = [];

        categories
            .filter((cat) => state.cats.has(cat.id))
            .forEach((cat) => {
                const chosen = cat.variants && cat.variants.length ? Array.from(state.subs[cat.id] || []) : [];
                if (!chosen.length) {
                    parts.push(cat.label);
                } else {
                    chosen.forEach((variant) => parts.push(variant));
                }
            });

        $summaryWrap.empty();

        if (!parts.length) {
            $summaryWrap.append($('<span class="advice-page__summary-empty"></span>').text('Nog geen keuze — adviseur denkt mee'));
            return;
        }

        parts.forEach((part) => {
            $summaryWrap.append($('<span></span>').text(part));
        });
    };

    // #select-boxes is een verborgen [text]-veld in het CF7-formulier (geen
    // [checkbox]): CF7 valideert checkbox-waarden tegen de opties die letterlijk
    // in de shortcode staan, en die zijn hier leeg omdat de lijst dynamisch is —
    // dat gaf altijd "ongedefinieerde waarde" bij versturen. Een tekstveld heeft
    // die validatie niet.
    const syncHiddenField = function () {
        const values = new Set();

        categories
            .filter((cat) => state.cats.has(cat.id))
            .forEach((cat) => {
                const chosen = cat.variants && cat.variants.length ? Array.from(state.subs[cat.id] || []) : [];
                if (!chosen.length) {
                    values.add(cat.label);
                } else {
                    chosen.forEach((variant) => values.add(variant));
                }
            });

        const hiddenField = document.getElementById('select-boxes');
        if (hiddenField) {
            hiddenField.value = Array.from(values).join(', ');
        }
    };

    const update = function () {
        renderGroups();
        renderSummary();
        syncHiddenField();
    };

    $categoriesWrap.on('click', '[data-advice-cat]', function () {
        const catId = $(this).data('advice-cat');
        const cat = categories.find((c) => c.id === catId);
        if (!cat) {
            return;
        }

        if (state.cats.has(catId)) {
            state.cats.delete(catId);
            delete state.subs[catId];
        } else {
            state.cats.add(catId);
        }

        $(this).toggleClass('is-active', state.cats.has(catId));
        update();
    });

    $groupsWrap.on('click', '[data-advice-sub]', function () {
        const $group = $(this).closest('[data-advice-group]');
        const catId = $group.data('advice-group');
        const variant = $(this).data('advice-sub');

        if (!state.subs[catId]) {
            state.subs[catId] = new Set();
        }

        if (state.subs[catId].has(variant)) {
            state.subs[catId].delete(variant);
        } else {
            state.subs[catId].add(variant);
        }

        $(this).toggleClass('is-active', state.subs[catId].has(variant));
        renderSummary();
        syncHiddenField();
    });

    $groupsWrap.on('click', '[data-advice-cat-remove]', function () {
        const catId = $(this).data('advice-cat-remove');
        state.cats.delete(catId);
        delete state.subs[catId];
        $categoriesWrap.find('[data-advice-cat="' + catId + '"]').removeClass('is-active');
        update();
    });

    update();
};

const prefillAdviceFieldsFromQuery = function () {
    const params = new URL(window.location.href).searchParams;
    const postcode = params.get("postcode");
    const huisnummer = params.get("huisnummer");

    window.setTimeout(() => {
        const postcodeInput = document.getElementById("postcode");
        const huisnummerInput = document.getElementById("huisnummer");

        if (postcode && postcodeInput) {
            postcodeInput.value = postcode;
        }

        if (huisnummer && huisnummerInput) {
            huisnummerInput.value = huisnummer;
        }
    }, 300);
};

$(document).ready(function() {
    animateValueCounters();
    initAdviceCategoryPicker();
    prefillAdviceFieldsFromQuery();

    $('.js-header-usps-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        dots: false,
        infinite: true,
        rows: 0,
        pauseOnHover: true,
        fade: true,
    });

    if ($('.js-advice-how-slider').length) {
        $('.js-advice-how-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button type="button" class="slick-arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-arrow slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
            dots: false,
            infinite: false,
            rows: 0,
            responsive: [
                {
                    breakpoint: mq.lg,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: mq.md,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    if ($('.js-layout-nieuws').length) {
        $('.js-layout-nieuws').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button type="button" class="slick-arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-arrow slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
            dots: false,
            infinite: false,
            rows: 0,
            responsive: [
                {
                    breakpoint: mq.lg,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: mq.md,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    if ($('.js-service-slider').length) {
        $('.js-service-slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button type="button" class="slick-arrow slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-arrow slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
            dots: false,
            infinite: false,
            rows: 1,
            responsive: [
                {
                    breakpoint: mq.xxl,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: mq.lg,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: mq.md,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }

    if ($('.js-global-reviews').length) {
        $('.js-global-reviews').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: false,
            nextArrow: '<button type="button" class="slick-arrow slick-next" style="right:8px"><i class="fa-solid fa-chevron-right"></i></button>',
            dots: false,
            infinite: false,
            responsive: [
                {
                    breakpoint: mq.xxl,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: mq.lg,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: mq.md,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    if ($('.js-gemeenten').length) {
        $('.js-gemeenten').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            rows: 1,
            responsive: [
                {
                    breakpoint: mq.lg,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: mq.md,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: mq.sm,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }

});

// Keyword Switcher
(function () {
    const switcher = document.querySelector('.keyword-switcher');
    if (!switcher) return;

    const keywords = JSON.parse(switcher.dataset.keywords || '[]');
    if (keywords.length < 2) return;

    const wordEl = switcher.querySelector('.keyword-switcher__word');
    let currentIndex = 0;
    const interval = 3000;
    const animDuration = 400;

    setInterval(() => {
        wordEl.classList.add('is-leaving');

        setTimeout(() => {
            currentIndex = (currentIndex + 1) % keywords.length;
            wordEl.textContent = keywords[currentIndex];
            wordEl.classList.remove('is-leaving');
            wordEl.classList.add('is-entering');

            // Force reflow then remove entering class
            wordEl.offsetHeight;
            wordEl.classList.remove('is-entering');
        }, animDuration);
    }, interval);
})();
