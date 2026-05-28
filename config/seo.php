<?php

return [

    'site_name' => env('SEO_SITE_NAME', 'Inclusive by Design Masterclass'),

    'organization' => env('SEO_ORGANIZATION', 'Africa Special Needs Education Network'),

    'partner' => env('SEO_PARTNER', 'Acorn Special Tutorials'),

    'og_image' => env(
        'SEO_OG_IMAGE',
        'https://registration.asnenafrica.org/wp-content/uploads/2026/05/logo-Asnen.png'
    ),

    'og_image_width' => (int) env('SEO_OG_IMAGE_WIDTH', 1200),

    'og_image_height' => (int) env('SEO_OG_IMAGE_HEIGHT', 630),

    'og_image_alt' => env(
        'SEO_OG_IMAGE_ALT',
        'Africa Special Needs Education Network (ASNEN) logo'
    ),

    'twitter_site' => env('SEO_TWITTER_SITE'),

    'locale' => env('SEO_LOCALE', 'en_KE'),

    'event' => [
        'name' => 'Inclusive by Design Masterclass',
        'start' => '2026-07-14',
        'end' => '2026-07-16',
        'venue' => 'Maison Ubuntu Training & Conference Centre, Dagoretti, Nairobi',
    ],

];
