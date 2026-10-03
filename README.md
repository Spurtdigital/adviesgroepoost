# Starter Theme

WordPress starter theme door Spurt Digital.

## Installatie

```bash
npm install
```

## Development

```bash
npm run dev
```

Start Vite dev server met hot reloading.

## Production build

```bash
npm run build
```

Output komt in `/dist` folder.

## Structuur

```
├── assets/
│   ├── js/
│   │   └── app.js              # JS entry point
│   ├── scss/
│   │   ├── app.scss            # SCSS entry point
│   │   ├── base/
│   │   │   ├── _fonts.scss     # Lokale fonts
│   │   │   ├── _reset.scss     # Reset & basis styles
│   │   │   └── _type.scss      # Typography
│   │   ├── components/
│   │   │   └── _buttons.scss   # Bootstrap buttons (volledig)
│   │   ├── layout/
│   │   │   └── _header.scss    # Header met toggle (hamburger)
│   │   ├── pages/              # Page-specifieke styles
│   │   ├── utils/
│   │   │   ├── _variables.scss # Bootstrap variables (volledig)
│   │   │   ├── _variables-dark.scss
│   │   │   ├── _functions.scss
│   │   │   └── _mixins.scss
│   │   └── vendors/
│   │       └── _bootstrap.scss # Bootstrap imports
│   ├── fontawesome/            # Font Awesome 7 Pro
│   └── img/
├── dist/                       # Build output
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── inc/
│   ├── cleanup.php
│   ├── contactform7.php
│   ├── menus.php
│   ├── scripts.php             # Enqueue styles & scripts
│   └── setup.php
├── template-parts/
├── functions.php
├── header.php
├── footer.php
├── index.php
├── style.css                   # Theme info
├── package.json
└── vite.config.js
```

## Dependencies

| Package | Versie | Beschrijving |
|---------|--------|--------------|
| Bootstrap | 5.3.8 | CSS framework |
| jQuery | 4.0.0 | JS library |
| Fancybox | 6.1.14 | Lightbox |
| Slick Carousel | 1.8.1 | Slider |
| Font Awesome | 7 Pro | Icons (lokaal) |

## Design tokens

### Spacers (8px grid)

`$spacer: 8px` met classes `.m-{0-30}` en `.p-{0-30}`

| Class | Waarde |
|-------|--------|
| 0 | 0 |
| 1 | 8px |
| 2 | 16px |
| 3 | 24px |
| 4 | 32px |
| 5 | 40px |
| ... | ... |
| 30 | 240px |

### Border radius (4px grid)

| Variable | Waarde |
|----------|--------|
| `$border-radius-sm` | 4px |
| `$border-radius` | 8px |
| `$border-radius-lg` | 12px |
| `$border-radius-xl` | 16px |
| `$border-radius-xxl` | 20px |

### Border radius utility

De utility in `assets/scss/base/_reset.scss` maakt afgeronde overgangen tussen secties.

- `border-radius-top` maakt een afgeronde bovenkant
- `border-radius-bottom` maakt een afgeronde onderkant
- `border-radius-fill--*` bepaalt de kleur van de afgeronde vorm
- `border-radius-bg--*` bepaalt de achtergrondkleur achter die vorm
- `border-radius-top--center` en `border-radius-bottom--center` plaatsen de ronding halverwege het element

Beschikbare kleuren:

- `white`
- `light`
- `primary`
- `secondary`
- `dark`

Voorbeelden:

```html
<section class="border-radius-top border-radius-fill--primary border-radius-bg--white">
```

Primary ronding op witte achtergrond.

```html
<section class="border-radius-top border-radius-fill--light border-radius-bg--primary">
```

Grijze ronding op primary achtergrond.

```html
<div class="border-radius-bottom border-radius-fill--white border-radius-bg--light">
```

Witte onder-ronding op grijze achtergrond.

### Breakpoints

| Breakpoint | Min-width |
|------------|-----------|
| sm | 576px |
| md | 768px |
| lg | 992px |
| xl | 1200px |
| xxl | 1400px |

## Customization

### Kleuren aanpassen

Edit `assets/scss/utils/_variables.scss`:

```scss
$primary: #0d6efd;
$secondary: #6c757d;
```

### Bootstrap componenten

Volledige Bootstrap SCSS bestanden staan in theme voor maximale controle:
- `_variables.scss` - Alle Bootstrap variables
- `_buttons.scss` - Button component

## Font Awesome 7 Pro

Lokaal ingeladen vanuit `/assets/fontawesome/`.

Beschikbare styles:
- `fa-solid` (fas)
- `fa-regular` (far)
- `fa-light` (fal)
- `fa-thin` (fat)
- `fa-duotone` (fad)
- `fa-brands` (fab)

```html
<i class="fa-solid fa-user"></i>
<i class="fa-light fa-envelope"></i>
```

## Fancybox

Automatisch geactiveerd op `[data-fancybox]` attributen:

```html
<a href="image.jpg" data-fancybox="gallery">
    <img src="thumb.jpg" alt="">
</a>
```

## Slick Carousel

```js
import $ from 'jquery';
import 'slick-carousel';

$('.slider').slick({
    dots: true,
    arrows: true
});
```
