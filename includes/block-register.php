<?php
/**
 * Registrierung des Blocks via block.json
 */

defined('ABSPATH') || exit;

function ud_register_contact_card_associations_music_block() {
    register_block_type_from_metadata(__DIR__ . '/../', [
        'render_callback' => 'ud_render_contact_card_associations_music_block',
    ]);
}
add_action('init', 'ud_register_contact_card_associations_music_block');
