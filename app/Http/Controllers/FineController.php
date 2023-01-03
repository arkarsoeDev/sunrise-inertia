<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Fine\StoreFineRequest;
use App\Http\Requests\Fine\UpdateFineRequest;
use App\Http\Resources\FineResource;
use Inertia\Inertia;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Fines/Index', [
            'fines' => FineResource::collection(
                Fine::query()
                    ->when(Request::input('search'), function ($query, $search) {
                        $query->where('member_id', 'like', "%{$search}%");
                    })
                    ->paginate(10)
                    ->withQueryString()
            ),
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
        if (request()->has('member_id') && request()->has('loan_id')) {
            return Inertia::render('Fines/Create', [
                'member_id' => request()->member_id,
                'loan_id' => request()->loan_id
            ]);
        }
        return Inertia::render('Fines/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Fine\StoreFineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFineRequest $request)
    {
        $fine = new fine();
        $fine->member_id = $request->member_id;
        $fine->loan_id = $request->loan_id;
        $fine->fine_date = date('Y-m-d', $request->fine_date);
        $fine->fine_amount = $request->fine_amount;
        $fine->save();

        return redirect()->route('fines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function show(Fine $fine)
    {
        return Inertia::render('Fines/Show', [
            'fine' => new FineResource($fine)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function edit(Fine $fine)
    {
        return Inertia::render('Fines/Edit', [
            'fine' => new FineResource($fine)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Fine\UpdateFineRequest  $request
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFineRequest $request, Fine $fine)
    {
        $fine->member_id = $request->member_id;
        $fine->loan_id = $request->loan_id;
        $fine->fine_date = date('Y-m-d', $request->fine_date);
        $fine->fine_amount = $request->fine_amount;
        $fine->save();

        return redirect()->route('fines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();
        return redirect()->back();
    }
}
