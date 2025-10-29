<?php
/**
 * Enqueue Editor & Frontend Assets für UD Kontaktkarte für Vereine und Musikgruppen
 */

defined('ABSPATH') || exit;

function ud_contact_card_associations_music_enqueue_editor_assets() {
    // Editor-JS
    wp_enqueue_script(
        'ud-contact-card-editor-script',
        plugins_url('../build/editor-script.js', __FILE__),
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
        null,
        true
    );

    // Editor-CSS
    wp_enqueue_style(
        'ud-contact-card-editor-style',
        plugins_url('../build/editor-style.css', __FILE__),
        [],
        null
    );

    // Platzhalterbild im Editor bereitstellen
    wp_add_inline_script(
        'ud-contact-card-editor-script',
        'window.udPersonalCardPlaceholder = "' . plugins_url('../assets/img/platzhalterbild.svg', __FILE__) . '";',
        'before'
    );
}
add_action('enqueue_block_editor_assets', 'ud_contact_card_associations_music_enqueue_editor_assets');

function ud_contact_card_associations_music_enqueue_frontend_assets() {
    wp_enqueue_script(
        'ud-contact-card-frontend-script',
        plugins_url('../build/frontend-script.js', __FILE__),
        [],
        null,
        true
    );

    wp_enqueue_style(
        'ud-contact-card-frontend-style',
        plugins_url('../build/frontend-style.css', __FILE__),
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'ud_contact_card_associations_music_enqueue_frontend_assets');
