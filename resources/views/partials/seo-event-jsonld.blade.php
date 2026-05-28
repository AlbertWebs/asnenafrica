@php
    $event = config('seo.event');
    $eventDescription = $eventDescription ?? 'A three-day professional masterclass for school leaders and teachers on inclusive, future-ready classrooms for diverse learners.';
    $payload = [
        '@context' => 'https://schema.org',
        '@type' => 'EducationEvent',
        'name' => $event['name'],
        'description' => $eventDescription,
        'startDate' => $event['start'],
        'endDate' => $event['end'],
        'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
        'eventStatus' => 'https://schema.org/EventScheduled',
        'location' => [
            '@type' => 'Place',
            'name' => $event['venue'],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Nairobi',
                'addressCountry' => 'KE',
            ],
        ],
        'organizer' => [
            [
                '@type' => 'Organization',
                'name' => config('seo.organization'),
                'url' => 'https://asnenafrica.org',
            ],
            [
                '@type' => 'Organization',
                'name' => config('seo.partner'),
            ],
        ],
        'image' => config('seo.og_image'),
        'url' => url('/'),
        'offers' => [
            '@type' => 'Offer',
            'url' => url('/'),
            'availability' => 'https://schema.org/InStock',
            'priceCurrency' => 'KES',
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
