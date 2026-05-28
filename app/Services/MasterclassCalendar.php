<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Support\Carbon;

class MasterclassCalendar
{
    public const VENUE = 'Maison Ubuntu Training & Conference Centre, Dagoretti, Nairobi';

    /** @var list<array{date: string, label: string}> */
    private const DAYS = [
        ['date' => '2026-07-14', 'label' => 'Day 1'],
        ['date' => '2026-07-15', 'label' => 'Day 2'],
        ['date' => '2026-07-16', 'label' => 'Day 3'],
    ];

    public static function icsFor(Registration $registration): string
    {
        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//ASNEN Africa//Inclusive by Design Masterclass//EN',
            'CALSCALE:GREGORIAN',
            'METHOD:PUBLISH',
            'NAME:Inclusive by Design Masterclass',
            'X-WR-CALNAME:Inclusive by Design Masterclass',
            'X-WR-TIMEZONE:Africa/Nairobi',
            self::timezoneBlock(),
        ];

        foreach (self::DAYS as $day) {
            $lines = array_merge($lines, self::eventBlock($registration, $day['date'], $day['label']));
        }

        $lines[] = 'END:VCALENDAR';

        return implode("\r\n", $lines)."\r\n";
    }

    private static function timezoneBlock(): string
    {
        return implode("\r\n", [
            'BEGIN:VTIMEZONE',
            'TZID:Africa/Nairobi',
            'BEGIN:STANDARD',
            'DTSTART:19700101T000000',
            'TZOFFSETFROM:+0300',
            'TZOFFSETTO:+0300',
            'TZNAME:EAT',
            'END:STANDARD',
            'END:VTIMEZONE',
        ]);
    }

    /** @return list<string> */
    private static function eventBlock(Registration $registration, string $date, string $dayLabel): array
    {
        $start = Carbon::parse($date.' 08:30:00', 'Africa/Nairobi');
        $end = Carbon::parse($date.' 15:30:00', 'Africa/Nairobi');
        $uid = sprintf(
            'ibd-%s-%s@asnenafrica.org',
            $registration->reference,
            str_replace('-', '', $date),
        );

        $description = self::escapeIcs(implode('\n', [
            'Inclusive by Design — Building Future-Ready Classrooms for Diverse Learners',
            'Registration reference: '.$registration->reference,
            'School: '.$registration->school_name,
            'Participants: '.$registration->participant_count,
            'Secretariat: info@asnenafrica.org',
        ]));

        return [
            'BEGIN:VEVENT',
            'UID:'.$uid,
            'DTSTAMP:'.now()->utc()->format('Ymd\THis\Z'),
            'DTSTART;TZID=Africa/Nairobi:'.$start->format('Ymd\THis'),
            'DTEND;TZID=Africa/Nairobi:'.$end->format('Ymd\THis'),
            'SUMMARY:'.self::escapeIcs('Inclusive by Design Masterclass — '.$dayLabel),
            'LOCATION:'.self::escapeIcs(self::VENUE),
            'DESCRIPTION:'.$description,
            'STATUS:CONFIRMED',
            'SEQUENCE:0',
            'TRANSP:OPAQUE',
            'END:VEVENT',
        ];
    }

    private static function escapeIcs(string $value): string
    {
        return str_replace(
            ['\\', ';', ',', "\r\n", "\n", "\r"],
            ['\\\\', '\\;', '\\,', '\\n', '\\n', ''],
            $value,
        );
    }
}
