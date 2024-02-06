<?php

namespace App\Actions;

class ProgressToNextStatus
{
    public function execute(string $currentStatus): array
    {
        $applicationStatuses = collect([
            ['status' => 'Cancel', 'pos' => 0],
            ['status' => 'New Applicant', 'pos' => 1],
            ['status' => 'Assessed', 'pos' => 2],
            ['status' => 'Confirmed', 'pos' => 3],
            ['status' => 'Hired', 'pos' => 4],
            ['status' => 'For Visa Interview', 'pos' => 5],
            ['status' => 'For PDOS & CFO', 'pos' => 6],
            ['status' => 'Program Proper', 'pos' => 7],
            ['status' => 'Returnee', 'pos' => 8]
        ]);

        $current = $applicationStatuses->where('status', $currentStatus)->first();

        if (!isset($current)) {

            return null;
        }

        return $applicationStatuses->where('pos', $current['pos']++)->first();
    }
}
