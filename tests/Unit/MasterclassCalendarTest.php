<?php

namespace Tests\Unit;

use App\Models\Registration;
use App\Services\MasterclassCalendar;
use PHPUnit\Framework\TestCase;

class MasterclassCalendarTest extends TestCase
{
    public function test_ics_contains_three_masterclass_days(): void
    {
        $registration = new Registration([
            'reference' => 'IBD-TEST01',
            'school_name' => 'Test School',
            'participant_count' => 2,
        ]);

        $ics = MasterclassCalendar::icsFor($registration);

        $this->assertStringContainsString('BEGIN:VCALENDAR', $ics);
        $this->assertStringContainsString('METHOD:PUBLISH', $ics);
        $this->assertStringContainsString('TZID=Africa/Nairobi:20260714T083000', $ics);
        $this->assertStringContainsString('TZID=Africa/Nairobi:20260715T083000', $ics);
        $this->assertStringContainsString('TZID=Africa/Nairobi:20260716T083000', $ics);
        $this->assertSame(3, substr_count($ics, 'BEGIN:VEVENT'));
    }
}
