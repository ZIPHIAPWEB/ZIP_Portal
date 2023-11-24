<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\StudentPayment;
use Illuminate\Http\Response;

class AccountingController extends Controller
{
    public function acknowledgePayment($userId, $requirementId)
    {
        $payment = StudentPayment::query()
            ->where('user_id', $userId)
            ->where('requirement_id', $requirementId);

        if (!$payment->exists()) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Student payment not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $payment->update([
            'acknowledgement' => true
        ]);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Student payment acknowledged'
        ], Response::HTTP_OK);
    }
}
