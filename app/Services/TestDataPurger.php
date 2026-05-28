<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TestDataPurger
{
    /** @var list<string> */
    public const REFERENCE_PATTERNS = ['%SAMPLE%', '%TEST%', '%DEMO%', 'ASNEN-%'];

    /** @var list<string> */
    public const SCHOOL_PATTERNS = ['%sample%', '%demo%', '%test school%', '%(demo)%', '%(test)%'];

    /** @var list<string> */
    public const EMAIL_PATTERNS = ['%@example.com', '%@example.org', '%@test.%', '%+test@%'];

    public static function query(): Builder
    {
        return Registration::query()->where(function (Builder $q) {
            $q->where(function (Builder $ref) {
                foreach (self::REFERENCE_PATTERNS as $pattern) {
                    $ref->orWhere('reference', 'like', $pattern);
                }
            })->orWhere(function (Builder $school) {
                foreach (self::SCHOOL_PATTERNS as $pattern) {
                    $school->orWhereRaw('LOWER(school_name) LIKE ?', [strtolower($pattern)]);
                }
            })->orWhere(function (Builder $email) {
                foreach (self::EMAIL_PATTERNS as $pattern) {
                    $needle = strtolower($pattern);
                    $email->orWhereRaw('LOWER(lead_email) LIKE ?', [$needle])
                        ->orWhereRaw('LOWER(school_email) LIKE ?', [$needle]);
                }
            })->orWhereRaw('LOWER(lead_name) LIKE ?', ['%sample%'])
                ->orWhereRaw('LOWER(lead_name) LIKE ?', ['%demo user%']);
        });
    }

    public static function count(): int
    {
        return self::query()->count();
    }

    /** @return \Illuminate\Support\Collection<int, Registration> */
    public static function preview(int $limit = 10): \Illuminate\Support\Collection
    {
        return self::query()
            ->withCount('participants')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get(['id', 'reference', 'school_name', 'lead_name', 'created_at']);
    }

    public static function purge(): int
    {
        return DB::transaction(function () {
            $ids = self::query()->pluck('id');

            if ($ids->isEmpty()) {
                return 0;
            }

            Registration::query()->whereIn('id', $ids)->delete();

            return $ids->count();
        });
    }
}
