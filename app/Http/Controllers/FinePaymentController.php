<?php

namespace App\Http\Controllers;

use App\Models\FinePayment;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\FinePayment\StoreFinePaymentRequest;
use App\Http\Requests\FinePayment\UpdateFinePaymentRequest;
use App\Http\Resources\FinePaymentResource;
use App\Models\Fine;
use Inertia\Inertia;

class FinePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FinePayments/Index', [
            'fine_payments' => FinePayment::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('member_id', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'filters' => Request::only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->has('member_id') && request()->has('fine_id') && request()->has('payment_amount')) {
            return Inertia::render('FinePayments/Create', [
                'member_id' => request()->member_id,
                'fine_id' => request()->fine_id,
                'payment_amount' => request()->payment_amount
            ]);
        }
        return Inertia::render('FinePayments/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FinePayment\StoreFinePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinePaymentRequest $request)
    {
        $finePayment = new FinePayment();
        $finePayment->member_id = $request->member_id;
        $finePayment->fine_id = $request->fine_id;
        $finePayment->payment_date = date('Y-m-d', $request->payment_date);
        $finePayment->payment_amount = $request->payment_amount;
        $finePayment->save();
        
        $fine = Fine::find($request->fine_id);
        $fine->paid = true;
        $fine->save();
        
        return redirect()->route('fine-payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinePayment  $finePayment
     * @return \Illuminate\Http\Response
     */
    public function show(FinePayment $finePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinePayment  $finePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(FinePayment $finePayment)
    {
        return Inertia::render('FinePayments/Edit', [
            'fine_payment' => new FinePaymentResource($finePayment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FinePayment\UpdateFinePaymentRequest  $request
     * @param  \App\Models\FinePayment  $finePayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinePaymentRequest $request, FinePayment $finePayment)
    {
        $finePayment->member_id = $request->member_id;
        $finePayment->fine_id = $request->fine_id;
        $finePayment->payment_date = date('Y-m-d', $request->payment_date);
        $finePayment->payment_amount = $request->payment_amount;
        $finePayment->save();

        return redirect()->route('fine-payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinePayment  $finePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinePayment $finePayment)
    {
        $finePayment->delete();
        return redirect()->back();
    }
}
