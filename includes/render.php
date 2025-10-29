<?php

/**
 * Server-side Rendering für den Block „Kontaktkarte für Vereine und Musikgruppen“
 */

defined('ABSPATH') || exit;

function ud_render_contact_card_associations_music_block($attributes) {
    $name           = trim($attributes['name'] ?? '');
    $description           = trim($attributes['description'] ?? '');
    $contactPerson  = trim($attributes['contactPerson'] ?? '');
    $address        = trim($attributes['address'] ?? '');
    $email          = wp_strip_all_tags(trim($attributes['email'] ?? ''));
    $phoneRaw       = wp_strip_all_tags(trim($attributes['phone'] ?? ''));
    $imageId        = $attributes['imageId'] ?? 0;
    $showImage      = $attributes['showImage'] ?? false;
    $websiteUrl     = esc_url(trim($attributes['websiteUrl'] ?? ''));
    $websiteLabel   = trim($attributes['websiteLabel'] ?? 'Zur Website');

    $phoneLink  = ud_associationcard_normalize_swiss_phone($phoneRaw);
    $phoneLabel = $phoneLink ? ud_associationcard_format_ch_phone_display($phoneLink) : '';



    ob_start();
?>
    <div class="wp-block-ud-contact-card-associations-music">
        <?php if ($showImage && $imageId): ?>
            <div class="ud-contact-image-left">
                <?php echo wp_get_attachment_image($imageId, 'large', false, ['class' => 'ud-contact-image']); ?>
            </div>
        <?php endif; ?>

        <div class="ud-contact-content">
            <?php if ($name): ?>
                <div class="ud-contact-meta">
                    <?php if ($name): ?>
                        <div class="ud-contact-meta">
                            <div class="ud-contact-name">
                                <?php if ($websiteUrl): ?>
                                    <a href="<?php echo esc_url($websiteUrl); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($name); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html($name); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($description): ?>
                        <div class="ud-contact-description"><?php echo esc_html($description); ?></div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if ($contactPerson || $address || $phoneLink || $email || $websiteUrl): ?>
                <div class="ud-contact-details">
                    <?php if ($contactPerson): ?><div class="ud-contact-person"><?php echo esc_html($contactPerson); ?></div><?php endif; ?>
                    <?php if ($address): ?><div class="ud-contact-address"><?php echo esc_html($address); ?></div><?php endif; ?>
                    <?php if ($phoneLink): ?><div class="ud-contact-phone"><a href="tel:<?php echo esc_attr($phoneLink); ?>"><?php echo esc_html($phoneLabel); ?></a></div><?php endif; ?>
                    <?php if ($email): ?><div class="ud-contact-email"><a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></div><?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
<?php
    return ob_get_clean();
}

// === Hilfsfunktionen ===

if (!function_exists('ud_associationcard_normalize_swiss_phone')) {
    function ud_associationcard_normalize_swiss_phone($input) {
        $input = preg_replace('/[\s\p{Z}\xA0]+/u', '', $input);

        if (preg_match('/^0([1-9][0-9])([0-9]{3})([0-9]{2})([0-9]{2})$/', $input, $m)) {
            return '+41' . $m[1] . $m[2] . $m[3] . $m[4];
        }

        if (preg_match('/^\\+41\\d{9}$/', $input)) {
            return $input;
        }

        return '';
    }
}

if (!function_exists('ud_associationcard_format_ch_phone_display')) {
    function ud_associationcard_format_ch_phone_display($phone) {
        if (preg_match('/^\\+41(\\d{2})(\\d{3})(\\d{2})(\\d{2})$/', $phone, $m)) {
            return '0' . $m[1] . ' ' . $m[2] . ' ' . $m[3] . ' ' . $m[4];
        }
        return $phone;
    }
}
