# Copilot Standards

Deze theme-conventies gelden als standaard bij nieuwe ACF-velden, templates en componenten.

## ACF

- Gebruik voor nieuwe ACF field groups een `tab` met `placement: left` voor secties die als blokken in de editor worden opgebouwd.
- Houd veldnamen kort, voorspelbaar en herbruikbaar.
- Gebruik clone fields waar mogelijk om knop- en basisvelden te hergebruiken.

## Buttons

- Gebruik `spurt_add_btns()` voor button-renders in templates.
- Gebruik de bestaande `group_buttons` clone-structuur voor buttonvelden.
- Gebruik `creators_markdown()` voor titels of teksten die markdown mogen ondersteunen.

## Naming

- Gebruik `creators_` als prefix voor theme helpers of markdown rendering.
- Gebruik `spurt_` voor button helpers en button-gerelateerde output.

## Template stijl

- Gebruik voor ACF-data in templates altijd directe `echo get_field(...)` of `get_field(...)` checks.
- Geen ACF-tussenvariabelen aanmaken voor `get_field()`-waarden.
- Gebruik in blocks voor titel en link direct `echo get_the_title();` en `echo get_the_permalink();`.