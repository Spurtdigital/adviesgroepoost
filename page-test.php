<?php /*Template Name: Page - Test */ get_header(); ?>

<button class="involveme_popup" data-project="<?php echo get_field( 'formulier_spouwmuur', 'options' );?>" data-embed-mode="sidePanel" data-trigger-event="button" data-popup-size="medium" data-organization-url="https://adviesgroepoost.involve.me" data-button-color="#2679ff" data-position="right" >Launch pop-up</button>
<script></script>
<?php /*
<section>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-8">
                <div class="vc-container">
                    <div class="vc-header bg-primary p-xl-3 p-2">
                        <span class="display-5 text-white">Isolatie test</span>
                    </div>
                    <!-- Stap 1: Selectie van diensten -->
                    <div class="vc-step active" id="stap-1">
                        <div class="vc-step-header d-flex align-items-center">
                            <span class="vc-step-header__count">1</span>
                            <strong>Kies de diensten</strong>
                        </div>
                        <div class="vc-step-content">
                            <div class="row gy-lg-2 gy-1 mb-lg-4 mb-2">
                                <div class="col-lg-12">
                                    <div class="js-service form-check">
                                        <input class="form-check-input" type="checkbox" value="isolatie" id="isolatie" checked>
                                        <label class="form-check-label" for="isolatie">
                                            Isolatie
                                        </label>
                                    </div>
                                    <div class="js-service form-check">
                                        <input class="form-check-input" type="checkbox" value="airco" id="airco">
                                        <label class="form-check-label" for="airco">
                                            Airco
                                        </label>
                                    </div>
                                    <div class="js-service form-check">
                                        <input class="form-check-input" type="checkbox" value="zonnepanelen" id="zonnepanelen">
                                        <label class="form-check-label" for="zonnepanelen">
                                            Zonnepanelen
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <span class="js-next-step vc-step-content__next text-center">Volgende stap <i class="ms-1 fa-sharp fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </div>

                    <!-- Stap 2: Isolatie -->
                    <div class="vc-step" id="isolatie">
                        <div class="vc-step-header d-flex align-items-center">
                            <span class="vc-step-header__count">2</span>
                            <strong>Isolatie</strong>
                        </div>
                        <div class="vc-step-content">
                            <div class="row gy-lg-2 gy-1 mb-lg-4 mb-2">
                                <div class="col-lg-12">
                                    <span class="vc-step-form__label">Vierkante meter</span>
                                    <input type="number" class="form-control js-isolatie-meters" value="0">
                                </div>
                                <div class="col-lg-12">
                                    <strong>Ventelatie roosters</strong>
                                    <div class="js-ventilation form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ja" value="ja">
                                        <label class="form-check-label" for="ja">
                                            Ja
                                        </label>
                                    </div>
                                    <div class="js-ventilation form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="nee" value="nee" checked>
                                        <label class="form-check-label" for="nee">
                                            Nee
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <span>Pricing: <span class="js-isolatie-prijs">€0.00</span></span>
                            <span class="js-next-step vc-step-content__next text-center">Volgende stap <i class="ms-1 fa-sharp fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </div>

                    <!-- Stap 3: Airco -->
                    <div class="vc-step" id="airco">
                        <div class="vc-step-header d-flex align-items-center">
                            <span class="vc-step-header__count">3</span>
                            <strong>Airco</strong>
                        </div>
                        <div class="vc-step-content">
                            <div class="row gy-lg-2 gy-1 mb-lg-4 mb-2">
                                <div class="col-lg-12">
                                    <strong>Airco</strong>
                                    <div class="js-ventilation form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioAirco" id="ruimte-1" value="ruimte-1" price="30">
                                        <label class="form-check-label" for="ruimte-1">
                                            Een ruimte
                                        </label>
                                    </div>
                                    <div class="js-ventilation form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioAirco" id="ruimte-2" value="ruimte-2" price="20">
                                        <label class="form-check-label" for="ruimte-2">
                                            Twee ruimtes
                                        </label>
                                    </div>
                                    <div class="js-ventilation form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioAirco" id="ruimte-3" value="ruimte-3" price="10">
                                        <label class="form-check-label" for="ruimte-3">
                                            Drie ruimtes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <span>Pricing: <span class="airco-pricing">€0.00</span></span>
                            <span class="js-next-step vc-step-content__next text-center">Volgende stap <i class="ms-1 fa-sharp fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </div>

                    <!-- Stap 4: Zonnepanelen -->
                    <div class="vc-step" id="zonnepanelen">
                        <div class="vc-step-header d-flex align-items-center">
                            <span class="vc-step-header__count">4</span>
                            <strong>Zonnepanelen</strong>
                        </div>
                        <div class="vc-step-content">
                            <div class="row gy-lg-2 gy-1 mb-lg-4 mb-2">
                                <!-- Content voor zonnepanelen -->
                            </div>
                            <span class="js-next-step vc-step-content__next text-center">Volgende stap <i class="ms-1 fa-sharp fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h3>Totaalprijs</h3>
                <span class="total-price">€0.00</span>
            </div>
        </div>
    </div>
</section>

<script>
 

 jQuery(document).ready(function($) {

        // Functie om de geselecteerde waarden van de checkboxes op te halen
        function getSelectedCheckboxValues(containerSelector) {
            var selectedValues = [];
            // Selecteer alle aangevinkte checkboxes binnen de gespecificeerde container
            $(containerSelector + ' .js-service .form-check-input:checked').each(function() {
                // Voeg de waarde van elke geselecteerde checkbox toe aan de array
                selectedValues.push($(this).val());
            });
            return selectedValues;
        }

        // Functie om de vc-step secties te activeren of deactiveren
        function updateStepsStatus(selectedValues) {
            // Itereer over elke vc-step
            $('.vc-step').each(function() {
                var stepId = $(this).attr('id'); // Haal de id van de vc-step op

                if (stepId === 'stap-1') {
                    // Zorg ervoor dat de eerste stap altijd zichtbaar is
                    $(this).removeClass('disabled').removeClass('hidden');
                } else if (selectedValues.includes(stepId)) {
                    // Als de id van de vc-step in de geselecteerde waarden staat, activeer de step
                    $(this).removeClass('disabled').removeClass('hidden');
                } else {
                    // Anders, deactiveer de step
                    $(this).addClass('disabled').addClass('hidden');
                }
            });
        }

        // Functie om de volgende actieve stap te openen
        function openNextStep(currentStep) {
            var steps = $('.vc-step'); // Selecteer alle stappen
            var foundCurrent = false;

            // Itereer over elke stap om de volgende actieve stap te vinden
            steps.each(function() {
                if (foundCurrent) {
                    if (!$(this).hasClass('disabled')) {
                        // Open de volgende niet-gedisablede stap
                        $(this).removeClass('hidden');
                        $(this).addClass('active');
                        return false; // Stop de iteratie
                    }
                }

                // Markeer de huidige stap als gevonden
                if ($(this).is(currentStep)) {
                    foundCurrent = true;
                    // Verberg de huidige stap alleen als het niet de eerste stap is
                    if ($(this).attr('id') !== 'stap-1') {
                        // $(this).addClass('hidden');
                    }
                }
            });
        }

        // Event handler voor elke wijziging in de checkboxes
        $('.col-lg-12 .js-service .form-check-input').change(function() {
            // Roep de functie aan om de geselecteerde waarden op te halen
            var selectedValues = getSelectedCheckboxValues('.col-lg-12');
            // Log de geselecteerde waarden naar de console
            console.log(selectedValues);
            // Werk de status van de vc-step secties bij
            updateStepsStatus(selectedValues);
        });

        // Initialiseer de status van de vc-step secties bij pagina laden
        var initialSelectedValues = getSelectedCheckboxValues('.col-lg-12');
        updateStepsStatus(initialSelectedValues);

        // Event handler voor de "Volgende stap" knoppen
        $('.js-next-step').click(function() {
            var currentStep = $(this).closest('.vc-step'); // Vind de huidige stap
            openNextStep(currentStep); // Open de volgende actieve stap
        });

        // Zorg ervoor dat de eerste stap altijd zichtbaar is bij het laden van de pagina
        $('#stap-1').removeClass('hidden').removeClass('disabled');
        });

        $('.js-isolatie-meters, .js-ventilation').on('input change', changeTotal);
        function changeTotal() {
            var meters = $('.js-isolatie-meters').val();
            var prijs = meters * 10;

            // js-ventilation
            var ventilation = $('.js-ventilation .form-check-input:checked').val();
            if (ventilation === 'nee') {
                var ventilationPrijs = 100; // Variabele om ventilatieprijs aan te geven
                prijs = prijs + ventilationPrijs; // Voeg ventilatieprijs toe aan prijs
                console.log('123');
                console.log('Ventilatie toegevoegd, nieuwe prijs: ' + prijs);
            }   
            $('.js-isolatie-prijs').text('€' + prijs);
        }
        function calculateAircoPrice() {
        var selectedOption = $('input[name="flexRadioDefault"]:checked');
        var price = parseFloat(selectedOption.attr('price')) || 0;

        // Toon de berekende prijs in de HTML
        $('.airco-pricing').text('€' + price.toFixed(2));
    }

    // Event listener voor veranderingen in de radio buttons
    $('input[name="flexRadioDefault"]').on('change', calculateAircoPrice);

    // Initialiseer de prijsweergave bij pagina laden
    calculateAircoPrice();


    // Functie om de totale prijs te berekenen
    function calculateTotalPrice() {
        var totalPrice = 0;

        // Bereken de isolatieprijs
        var isolatieMeters = parseFloat($('.js-isolatie-meters').val()) || 0;
        var isolatiePrijs = isolatieMeters * 10; // Voorbeeld: 10 is de prijs per vierkante meter voor isolatie
        var ventilation = $('.js-ventilation input[name="flexRadioDefault"]:checked').val();
        if (ventilation === 'ja') {
            isolatiePrijs += 100; // Extra kosten voor ventilatie als 'ja' is geselecteerd
        }
        $('.js-isolatie-prijs').text('€' + isolatiePrijs.toFixed(2)); // Toon de berekende isolatieprijs

        totalPrice += isolatiePrijs;

        // Bereken de aircoprijs
        var aircoPrice = 0;
        var selectedAircoOption = $('input[name="flexRadioAirco"]:checked');
        if (selectedAircoOption.length > 0) {
            aircoPrice = parseFloat(selectedAircoOption.attr('price')) || 0;
            $('.airco-pricing').text('€' + aircoPrice.toFixed(2)); // Toon de berekende aircoprijs
        }

        totalPrice += aircoPrice;

        // Update de totale prijs
        $('.total-price').text('€' + totalPrice.toFixed(2)); // Toon de totale prijs
    }

    // Event listener voor veranderingen in de inputvelden
    $('.js-isolatie-meters, .js-ventilation input[name="flexRadioDefault"], input[name="flexRadioAirco"]').on('input change', calculateTotalPrice);

    // Initialiseer de prijsweergave bij pagina laden
    calculateTotalPrice();
</script>
<?php get_footer();?> */ ?>