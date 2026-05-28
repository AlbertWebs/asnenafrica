@php
    $siteName = config('seo.site_name');
    $pageTitle = $title ?? $siteName;
    $fullTitle = str_contains($pageTitle, $siteName) ? $pageTitle : $pageTitle.' · '.$siteName;
    $description = $description ?? 'Register your school team for the Inclusive by Design three-day masterclass (14–16 July 2026, Nairobi). Presented by ASNEN and Acorn Special Tutorials.';
    $canonical = $canonical ?? url()->current();
    $image = $image ?? config('seo.og_image');
    $imageAlt = $imageAlt ?? config('seo.og_image_alt');
    $robots = $robots ?? 'index, follow';
    $ogType = $ogType ?? 'website';
    $locale = config('seo.locale', 'en_KE');
@endphp
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="author" content="{{ config('seo.organization') }}">
<meta name="theme-color" content="#1c1a17">

<meta property="og:locale" content="{{ str_replace('_', '-', $locale) }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:secure_url" content="{{ $image }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="{{ config('seo.og_image_width') }}">
<meta property="og:image:height" content="{{ config('seo.og_image_height') }}">
<meta property="og:image:alt" content="{{ $imageAlt }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:image:alt" content="{{ $imageAlt }}">
@if (config('seo.twitter_site'))
<meta name="twitter:site" content="{{ config('seo.twitter_site') }}">
@endif

@if (! empty($jsonLd))
<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
