<?php /* Template Name: Page - Script */ get_header(); wp_enqueue_script('jquery');  ?>
<div>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="https://adviesgroepoost.involve.me/embed?type=popup"></script>

</div>
            <section class="py-5 text-center">
                <a href="#" class="js-open-price-form">Open magie</a>
            </section>

            <div class="js-price-form-wrapper price-form__wrapper">
                <div class="price-form">
                    <div class="js-price-form-close price-form__close">X</div>
                    <div class="price-form-header d-flex justify-content-between">
                        <div class="price-form-header__step is-active">
                            <i class="fa-light fa-comments"></i>
                            <strong>Isolatie</strong>
                        </div>
                        <div class="price-form-header__step">
                            <i class="fa-light fa-comments"></i>
                            <strong>Zonnepanelen</strong>
                        </div>
                        <div class="price-form-header__step">
                            <i class="fa-light fa-comments"></i>
                            <strong>Airco</strong>
                        </div>
                    </div>
                    <div class="price-form-content">
                        <strong class="d-block display-5 mb-sm-2 mb-1"><?php echo the_field( 'pricecalc_subtitel', 'options' );?></strong>
                        <p class="mb-0 small"><?php echo the_field( 'pricecalc_tekst', 'options' );?></p>
                        <div class="price-form-content-dynamic" data-attribute="isolatie">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="spouwmuur">
                                <label class="form-check-label" for="spouwmuur">
                                    Spouwmuur
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="Dakofzolder" checked>
                                <label class="form-check-label" for="Dakofzolder">
                                    Dak of zolder
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="vloer">
                                <label class="form-check-label" for="vloer">
                                    Vloer of bodem
                                </label>
                            </div>
                        </div>
                        <div class="price-form-content-dynamic" style="display:none" data-attribute="zonnepanelen"></div>
                        <div class="price-form-content-dynamic" style="display:none" data-attribute="airco"></div>
                        <div class="js-form row g-2">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="js-postcode form-control" placeholder="postcode">
                                <label for="postcode">Postcode</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="js-huisnummer form-control" placeholder="huisnummer">
                                <label for="huisnummer">Huisnummer</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="js-telefoonnummer form-control" placeholder="telefoonnummer">
                                <label for="telefoonnummer">Telefoonnummer</label>
                            </div>
                        </div>
                        </div>
                        <div class="mt-2">
                            <a class="js-price-form-button price-form-button spourmuur-button" style="display:none">Volgende stap
                                <i class="fa-solid fa-angle-right"></i>
                                <button class="involveme_popup" data-project="<?php echo get_field( 'formulier_spouwmuur', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
                            </a>
                            <a class="js-price-form-button price-form-button dakofzolder-button" style="display:block">Volgende stap
                                <i class="fa-solid fa-angle-right"></i>
                                <button class="involveme_popup" data-project="<?php echo get_field( 'formulier_dakisolatie', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
                            </a>
                            <a class="js-price-form-button price-form-button vloer-button" style="display:none">Volgende stap
                                <i class="fa-solid fa-angle-right"></i>
                                <button class="involveme_popup" data-project="<?php echo get_field( 'formulier_vloerisolatie', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
                            </a>
                            <a class="js-price-form-button price-form-button zonnepanelen-button" style="display:none">Volgende stap
                                <i class="fa-solid fa-angle-right"></i>
                                <button class="involveme_popup" data-project="<?php echo get_field( 'formulier_zonnepanelen', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
                            </a>
                            <a class="js-price-form-button price-form-button airco-button" style="display:none">Volgende stap
                                <i class="fa-solid fa-angle-right"></i>
                                <button class="involveme_popup" data-project="<?php echo get_field( 'formulier_airco', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
                            </a>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="f0be7e9" title="Test"]'); ?>
                    </div>
                    <div class="price-form-footer d-flex justify-content-between">
                        <ul class="pricing-form-footer__stars reset-list d-flex align-items-center">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <span>9.8 uit 350 reviews</span>
                    </div>
                </div>
            </div>


<script>
    $(document).ready(function() {
    // Functie om de juiste content en buttons weer te geven op basis van de gekozen stap
    function updateStepContent(stepName) {
        // Verberg alle dynamische content en buttons eerst
        $('.price-form-content-dynamic').hide();
        $('.spourmuur-button, .dakofzolder-button, .vloer-button, .zonnepanelen-button, .airco-button').hide();
        
        // Toon de juiste dynamische content en buttons op basis van de gekozen stap
        switch (stepName) {
            case 'Isolatie':
                $('.price-form-content-dynamic[data-attribute="isolatie"]').show();
                updateIsolatieButtons();
                break;
            case 'Zonnepanelen':
                $('.price-form-content-dynamic[data-attribute="zonnepanelen"]').show();
                $('.zonnepanelen-button').show();
                break;
            case 'Airco':
                $('.price-form-content-dynamic[data-attribute="airco"]').show();
                $('.airco-button').show();
                break;
            default:
                break;
        }
    }
    
    // Functie om de juiste isolatie buttons weer te geven op basis van de geselecteerde radio optie
    function updateIsolatieButtons() {
        var selectedType = $('input[name="type"]:checked').attr('id');
        
        // Verberg alle isolatie buttons eerst
        $('.spourmuur-button, .dakofzolder-button, .vloer-button').hide();
        
        // Toon de juiste isolatie button op basis van de geselecteerde radio optie
        switch (selectedType) {
            case 'spouwmuur':
                $('.spourmuur-button').show();
                break;
            case 'Dakofzolder':
                $('.dakofzolder-button').show();
                break;
            case 'vloer':
                $('.vloer-button').show();
                break;
            default:
                break;
        }
    }
    
    // Roep de functie aan bij het laden van de pagina voor de eerste stap
    updateStepContent('Isolatie');
    
    // Voeg een click event handler toe aan alle price-form-header__step elementen
    $('.price-form-header__step').on('click', function() {
        // Verwijder eerst de 'is-active' class van alle stappen
        $('.price-form-header__step').removeClass('is-active');
        
        // Voeg de 'is-active' class toe aan de geklikte stap
        $(this).addClass('is-active');
        
        // Haal de tekst op van de geklikte stap
        var stepName = $(this).text().trim();
        
        // Update de content en buttons op basis van de gekozen stap
        updateStepContent(stepName);
    });
    
    // Voeg een event listener toe voor veranderingen in de radio opties binnen de isolatie sectie
    $('input[name="type"]').on('change', function() {
        updateIsolatieButtons();
    });

   // Validatie functies
   function isValidPostcode(postcode) {
        // Nederlandse postcodes hebben het formaat 1234 AB
        var postcodePattern = /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/;
        return postcodePattern.test(postcode);
    }

    function isValidPhoneNumber(phoneNumber) {
        // Nederlandse telefoonnummers hebben het formaat 0612345678 of +31612345678
        var phoneNumberPattern = /^(\+31|0)[1-9][0-9]{8}$/;
        return phoneNumberPattern.test(phoneNumber);
    }

    // Functie om de waarden uit de formulierinputs bij te werken en te valideren
    function updateFormValues() {
        var telefoonnummerValue = $('.js-telefoonnummer').val();
        var postcodeValue = $('.js-postcode').val();
        var huisnummerValue = $('.js-huisnummer').val();
        
        if (!isValidPostcode(postcodeValue)) {
            alert('Vul een geldige postcode in (bijv. 1234 AB).');
            return false;
        }
        
        if (!isValidPhoneNumber(telefoonnummerValue)) {
            alert('Vul een geldig telefoonnummer in (bijv. 0612345678 of +31612345678).');
            return false;
        }
        
        $('#telefoonnummer').val(telefoonnummerValue);
        $('#postcode').val(postcodeValue);
        $('#huisnummer').val(huisnummerValue);
        return true;
    }
    
    // Voeg een event listener toe voor de klik op de prijsformulier knop
    $('.js-price-form-button').on('click', function(e) {
        e.preventDefault();

        // Controleer of alle velden zijn ingevuld en valide
        if (!updateFormValues()) {
            return;
        }

        var postcodeValue = $('.js-postcode').val();
        var huisnummerValue = $('.js-huisnummer').val();
        var telefoonnummerValue = $('.js-telefoonnummer').val();
        var activeStep = $('.price-form-header__step.is-active strong').text().trim();
        $('#keuze').val(activeStep);

        // Als alle velden zijn ingevuld, roep de CF7-submit aan
        $(this).children('.involveme_popup')[0].click();
        $('.wpcf7-submit').click();
    });
});
</script>

<?php get_footer(); ?>