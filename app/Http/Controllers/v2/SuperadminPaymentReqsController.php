<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequirementCreateUpdateRequest;
use App\Http\Resources\SuperadminPaymentRequirementResource;
use App\PaymentRequirement;
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
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return SuperadminPaymentRequirementResource::collection($reqs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequirementCreateUpdateRequest $request)
    {
        $createdReqs = PaymentRequirement::create([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Payment requirement successfully created',
            'data' => new SuperadminPaymentRequirementResource($createdReqs)
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
        if(!$paymentRequirement->exists()) {

            abort(404, 'Payment requirement not found');
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully loaded',
            'data' => new SuperadminPaymentRequirementResource($paymentRequirement)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentRequirement  $paymentRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequirementCreateUpdateRequest $request, PaymentRequirement $paymentRequirement)
    {
        if(!$paymentRequirement->exists()) {

            abort(404, 'Payment requirement not found');
        }

        $paymentRequirement->update([
            'program_id' => $request->input('program_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active') == 'true' ? 1 : 0
        ]);

        $paymentRequirement->refresh();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully updated',
            'data' => new SuperadminPaymentRequirementResource($paymentRequirement)
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
        if(!$paymentRequirement->exists()) {

            abort(404, 'Payment requirement not found');
        }

        $paymentRequirement->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Payment requirement successfully deleted'
        ], Response::HTTP_OK);
    }
}
