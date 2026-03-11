        <?php get_template_part( 'template-parts/layouts/layout','footer' ); ?>
        <?php get_template_part( 'template-parts/layouts/layout','panel' ); ?>
        <?php wp_footer(); ?>
<script>
/**
 * Stelt een cookie in met een opgegeven naam, waarde en aantal dagen.
 * @param {string} name - De naam van de cookie.
 * @param {string} value - De waarde van de cookie.
 * @param {number} days - Het aantal dagen voordat de cookie verloopt.
 */
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Cookie verlooptijd
    const expires = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${encodeURIComponent(value)}; ${expires}; path=/`;
    console.log(`Cookie ingesteld: ${name} = ${value}`);
}

/**
 * Haalt een cookie op met de opgegeven naam.
 * @param {string} name - De naam van de cookie.
 * @returns {string|null} - De waarde van de cookie, of null als deze niet bestaat.
 */
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return decodeURIComponent(parts.pop().split(';').shift());
    }
    return null;
}

/**
 * Detecteert de verkeersbron, inclusief organisch zoekverkeer, en stelt de cookie in.
 */
function detectTrafficSource() {
    const referrer = document.referrer; // Referrer URL
    const urlParams = new URLSearchParams(window.location.search); // UTM-parameters

    const source = urlParams.get('utm_source');
    const medium = urlParams.get('utm_medium');
    let trafficSource = '';

    if (source && medium) {
        // Campagneverkeer via UTM-parameters
        trafficSource = `Campaign - Source: ${source}, Medium: ${medium}`;
        console.log(`Campagneverkeer gedetecteerd: Bron=${source}, Medium=${medium}`);
    } else if (referrer) {
        // Organisch zoekverkeer of verwijzingsverkeer
        const referrerDomain = new URL(referrer).hostname;

        if (referrerDomain.includes('google.')) {
            trafficSource = 'Organic Search - Google';
            console.log('Organisch verkeer gedetecteerd: Google.');
        } else if (referrerDomain.includes('bing.')) {
            trafficSource = 'Organic Search - Bing';
            console.log('Organisch verkeer gedetecteerd: Bing.');
        } else if (referrerDomain.includes('yahoo.')) {
            trafficSource = 'Organic Search - Yahoo';
            console.log('Organisch verkeer gedetecteerd: Yahoo.');
        } else {
            trafficSource = `Referrer: ${referrerDomain}`;
            console.log(`Verwijzingsverkeer gedetecteerd van: ${referrerDomain}`);
        }
    } else {
        // Direct verkeer zonder referrer of UTM-parameters
        trafficSource = 'Direct Traffic';
        console.log('Direct verkeer gedetecteerd.');
    }

    const existingCookie = getCookie('traffic_source');

    // Stel de cookie alleen in als deze niet bestaat of de waarde anders is
    if (!existingCookie || existingCookie !== trafficSource) {
        setCookie('traffic_source', trafficSource, 30); // Stel de cookie in voor 30 dagen
    } else {
        console.log('Cookie blijft ongewijzigd. Huidige waarde:', existingCookie);
    }
}

// Detecteer de verkeersbron en stel de cookie in
detectTrafficSource();
</script>
    </body>
</html>