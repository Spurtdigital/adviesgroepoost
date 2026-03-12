import "slick-carousel";
import "@fancyapps/fancybox";
// import bootstrap tabs
import "bootstrap/js/dist/tab";

jQuery(function ($) {
	const mq = {
		sm: 576,
		md: 768,
		lg: 992,
		xl: 1200,
		xxl: 1400,
	};

	$(document).on("click", ".js-nav-toggle", function (e) {
		e.preventDefault();
		$(this).toggleClass("is-active");
		$("html").toggleClass("lock");
	});

	function replaceMenus() {
		if ($(window).width() < mq.sm) {
			// Schermen kleiner dan mq.md
			$(".js-panel-inner").append($(".js-mega-menu"));
			$(".js-panel-inner").append($(".js-nav-bar-menu-right"));
			$(".js-nav-bar").prepend($(".js-nav-bar-top"));
			$(".js-panel-inner").append($(".js-top-menu"));
			$(".js-top-nav").prepend($(".menu-item-gtranslate"));
		} else if ($(window).width() >= mq.sm && $(window).width() < mq.lg) {
			// Schermen groter dan of gelijk aan mq.md maar kleiner dan mq.lg
			$(".js-panel-inner").append($(".js-mega-menu"));
			$(".js-panel-inner").append($(".js-nav-bar-menu-right"));
			$(".js-nav-bar").prepend($(".js-nav-bar-top"));
			$(".js-top-nav").append($(".js-top-menu"));
			$(".js-top-menu").append($(".menu-item-gtranslate"));
		} else {
			// Schermen groter dan of gelijk aan mq.lg
			$(".js-nav-bar-nav-left").prepend($(".js-mega-menu"));
			$(".js-nav-bar-nav-right").prepend($(".js-nav-bar-menu-right"));
			$(".js-nav-bar-right").prepend($(".js-nav-bar-top"));
			$(".panel, .nav-toggle").removeClass("panel-active is-active");
			$("html").removeClass("lock");
			$(".mega-menu__sub").show();
		}
	}

	$(".menu-item-has-children:not(.remove-arrow) > a").each(function () {
		if (!$(this).find(".fa-solid.fa-arrow-down").length) {
			$(this).append('<i class="fa-solid text-primary fa-angle-down"></i>');
		}
	});

	function handleWindowResize() {
		replaceMenus();
	}

	function setupResizeEvent() {
		$(window).on("resize", handleWindowResize);
	}

	function initialize() {
		replaceMenus();
		setupResizeEvent();
	}

	initialize();

	$(document).on("click", ".menu-item-has-children  a > i", function (e) {
		e.preventDefault();
		$(this).parent().next(".sub-menu").slideToggle();
		$(this).toggleClass("fa-chevron-down fa-chevron-up");
	});

	$(document).on("click", ".js-footer-toggle", function (e) {
		e.preventDefault();
		$(this).toggleClass("is-active");
		$(this).parent().next("nav > ul").slideToggle();
		$(this).parent().next("nav").children().slideToggle();
		// TO DO if schrijven als ul.active class heeft
	});

	//////////////////////////////////////
	//                                  //
	//              Toggles             //
	//                                  //
	//////////////////////////////////////
	// builder toggle
	$(document).on("click", ".layout-method-step__title", function (e) {
		e.preventDefault();
		$(this).toggleClass("is-active");
		const parent = $(this).closest(".layout-method-step");
		parent.removeClass("show");
		if (parent.hasClass("is-active")) {
			parent
				.removeClass("is-active")
				.find(".layout-method-step__content")
				.stop()
				.slideUp(300);
		} else {
			parent
				.addClass("is-active")
				.find(".layout-method-step__content")
				.stop()
				.slideDown(300);
		}
	});

	// builder toggle
	$(document).on("click", ".js-faq-toggle", function (e) {
		e.preventDefault();
		$(this).toggleClass("is-active");
		const parent = $(this).closest(".js-faq");
		if (parent.hasClass("is-active")) {
			parent
				.removeClass("is-active")
				.find(".js-faq-content")
				.stop()
				.slideUp(300);
		} else {
			parent
				.addClass("is-active")
				.find(".js-faq-content")
				.stop()
				.slideDown(300);
		}
	});

	$(document).on("click", ".js-open-price-form", function (e) {
		e.preventDefault();
		$(".js-price-form-wrapper").toggleClass("is-active");
		$("html").addClass("locking-scroll");
	});

	$(document).on("click", ".js-price-form-close", function (e) {
		e.preventDefault();
		$(".js-price-form-wrapper").removeClass("is-active");
		$("html").removeClass("locking-scroll");
	});

	/**
	 * Menu toggles
	 **/

	$(document).on("click", ".js-mega-menu-toggle i", function (e) {
		e.preventDefault();
		$(this).toggleClass("is-active");
		$(this).parent().next(".mega-menu-wrapper").addClass("is-active");
	});

	$(document).on("click", ".js-sub-menu-title i", function (e) {
		e.preventDefault();
		$(this).parent().toggleClass("is-active");
		$(this).parent().next(".mega-menu__sub").slideToggle();
	});

	$(document).on("click", ".js-mega-menu-return", function (e) {
		e.preventDefault();
		$(this).closest(".mega-menu-wrapper").removeClass("is-active");
	});

	//////////////////////////////////////
	//                                  //
	//          Slick sliders           //
	//                                  //
	//////////////////////////////////////

	$(".js-layout-nieuws").slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		rows: 0,
		arrows: false,
		dots: false,
		responsive: [
			{
				breakpoint: mq.xl,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.md,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
		],
	});

	$(".js-related-posts").slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		rows: 0,
		arrows: false,
		dots: false,
		responsive: [
			{
				breakpoint: mq.xl,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.md,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
		],
	});

	$(".js-reviews").slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		rows: 0,
		arrows: false,
		responsive: [
			{
				breakpoint: mq.xxl,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.md,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});

	$(".js-global-usps").slick({
		infinite: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		rows: 0,
		arrows: false,
		responsive: [
			{
				breakpoint: mq.xxl,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 2000,
				},
			},
			{
				breakpoint: mq.xl,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 2000,
				},
			},
			{
				breakpoint: mq.md,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 2000,
				},
			},
		],
	});

	// js-global-usps

	$(".js-gemeenten").slick({
		infinite: false,
		slidesToShow: 7,
		slidesToScroll: 1,
		draggable: true,
		arrows: false,
		responsive: [
			{
				breakpoint: mq.xxl,
				settings: {
					slidesToShow: 6,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.xl,
				settings: {
					slidesToShow: 5,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.lg,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: mq.sm,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
				},
			},
		],
	});

	$(window).on("scroll", function () {
		if ($(document).scrollTop() > 0) {
			$(".nav-bar").addClass("is-scrolled");
		} else {
			$(".nav-bar").removeClass("is-scrolled");
		}
	});
	var lastScrollTop = 0;
	$(window).on("scroll", function () {
		var currentScrollTop = $(this).scrollTop();
		if (currentScrollTop > lastScrollTop) {
			$(".nav-bar").removeClass("is-scrolled-up");
		} else {
			$(".nav-bar").addClass("is-scrolled-up");
		}
		lastScrollTop = currentScrollTop;
	});

	$(document).ready(function () {
		$(this).scrollTop(0);
	});

	$(window).on("scroll", function () {
		// Krijg de positie van het element met de class "fixed-cta"
		var fixedCtaOffset = $(".fixed-cta-top ").offset();

		// Krijg het element met de class "js-has-dark"
		var jsHasDarkElement = $(".js-has-dark");

		// Controleer of het element met de class "fixed-cta-top " over het element met de class "js-has-dark" ligt
		var overlapt = isElementOverlapping(fixedCtaOffset, jsHasDarkElement);

		// Voeg of verwijder de extra class met de naam '--white' op basis van de overlappende status
		var fixedCtaElement = $(".fixed-cta-top ");
		if (overlapt) {
			fixedCtaElement.addClass("--darker");
		} else {
			fixedCtaElement.removeClass("--darker");
		}
	});

	// Hulpmethode om te controleren of twee elementen overlappen
	function isElementOverlapping(elementOffset, targetElement) {
		var targetOffset = targetElement.offset();
		var elementWidth = $(".fixed-cta-top ").outerWidth();
		var elementHeight = $(".fixed-cta-top ").outerHeight();

		return (
			targetOffset.left < elementOffset.left + elementWidth &&
			targetOffset.left + targetElement.outerWidth() > elementOffset.left &&
			targetOffset.top < elementOffset.top + elementHeight &&
			targetOffset.top + targetElement.outerHeight() > elementOffset.top
		);
	}

	// Tijdelijk CF7-knop uitschakelen bij indiening
	var disableSubmit = false;
	jQuery('input.wpcf7-submit[type="submit"]').click(function () {
		jQuery(':input[type="submit"]').attr("value", "Versturen...");
		if (disableSubmit == true) {
			return false;
		}
		disableSubmit = true;
		return true;
	});

	var wpcf7Elm = document.querySelector(".wpcf7");
	if (wpcf7Elm) {
		wpcf7Elm.addEventListener(
			"wpcf7submit",
			function (event) {
				jQuery(':input[type="submit"]').attr("value", "send");
				disableSubmit = false;
			},
			false
		);
	}
	// Controleer of de cookie is ingesteld om de melding te verbergen

	if (getCookie("hideNotice") !== "true") {
		$(".js-notice").show();
	} else {
		$(".js-notice").hide();
	}

	// Functie uitvoeren wanneer er op '.js-notice-close' wordt geklikt
	$(".js-notice-close").click(function () {
		// De '.js-notice' verbergen
		$(".js-notice").hide();

		// Stel een cookie in met een vervaltijd van 1 uur (3600 seconden)
		setCookie("hideNotice", "true", 3600);
	});

	// Functie om een cookie in te stellen
	function setCookie(name, value, seconds) {
		var date = new Date();
		date.setTime(date.getTime() + seconds * 1000);
		var expires = "expires=" + date.toUTCString();
		document.cookie = name + "=" + value + ";" + expires + ";path=/";
	}

	// Functie om een cookie op te halen
	function getCookie(name) {
		var cookieName = name + "=";
		var cookies = document.cookie.split(";");
		for (var i = 0; i < cookies.length; i++) {
			var cookie = cookies[i];
			while (cookie.charAt(0) == " ") {
				cookie = cookie.substring(1);
			}
			if (cookie.indexOf(cookieName) == 0) {
				return cookie.substring(cookieName.length, cookie.length);
			}
		}
		return "";
	}
	const setFloatingLabelsGform = function () {
		if ($(document).find(".gform_wrapper").length) {
			$(document)
				.find(".gform_wrapper .form-group")
				.each(function () {
					const label = $(this).find("label");
					const floating = $(this).find(".form-floating");
					floating.append(label);
				});
		}
	};

	// Init
	$(function () {
		setFloatingLabelsGform();
	});

	window.onscroll = function (e) {
		$(".algolia-autocomplete").hide();
	};
});
