<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanCountResource;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DailyLoanCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = request()->has('from') ? date('Y-m-d', (int)request('from')) : 0;
        $to = request()->has('to') && request('to') ? date('Y-m-d', (int)request('to')) : Carbon::now();
        return Inertia::render('DailyLoanCount/Index', [
            'loansCount' => LoanCountResource::collection(
                Loan::select(DB::raw('DATE(loan_date) AS date'), DB::raw('count(*) as total'))
                ->whereDate('loan_date', '>=', $from)
                ->whereDate('loan_date', '<=', $to)
                ->groupBy('date')
                    ->paginate(10)
                    ->withQueryString()
            ),
            'filters' => [$from, $to]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
