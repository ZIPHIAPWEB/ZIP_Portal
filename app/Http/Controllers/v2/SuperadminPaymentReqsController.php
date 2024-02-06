<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\PaymentRequirement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperadminPaymentReqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqs = PaymentRequirement::query()
            ->orderBy('created_at', 'ASC')
            ->paginate(20);

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirements successfully loaded',
            'data' => $reqs
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdReqs = PaymentRequirement::create([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Payment requirement successfully created',
            'data' => $createdReqs
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentRequirement  $paymentRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentRequirement $paymentRequirement)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully loaded',
            'data' => $paymentRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentRequirement  $paymentRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentRequirement $paymentRequirement)
    {
        $paymentRequirement->update([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $paymentRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully updated',
            'data' => $paymentRequirement
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentRequirement  $paymentRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentRequirement $paymentRequirement)
    {
        $paymentRequirement->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully deleted'
        ], Response::HTTP_OK);
    }
}
