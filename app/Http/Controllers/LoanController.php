<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Loan\StoreLoanRequest;
use App\Http\Requests\Loan\UpdateLoanRequest;
use App\Http\Resources\LoanResource;
use App\Models\Book;
use Inertia\Inertia;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Loans/Index', [
            'loans' => LoanResource::collection(
                Loan::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('id', 'like', "%{$search}%");
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
        if (request()->has('member_id') || request()->has('book_id')) {
            return Inertia::render('Loans/Create', [
                'member_id' => request()->member_id,
                'book_id' => request()->book_id,
            ]);
        }

        return Inertia::render('Loans/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Loan\StoreLoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        $book = Book::find($request->book_id);
        $book->available = $book->available - 1;

        if(! ($book->available >= 1)) {
            return redirect()->back()->withErrors(['message' =>'Sorry this book is not available']);
        }
        
        $loan = new Loan();
        $loan->member_id = $request->member_id;
        $loan->book_id = $request->book_id;
        $loan->duration = $request->duration;
        $loan->loan_date = date('Y-m-d', $request->loan_date);
        $loan->return_date = date('Y-m-d', $request->return_date);
        
        $loan->save();
        $book->save();

        return redirect()->route('loans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return Inertia::render('Loans/Show', [
            'loan' => new LoanResource($loan)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        $loan = Loan::with(['fine'])->find($loan->id);
        return Inertia::render('Loans/Edit', [
            'loan' => new LoanResource($loan)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Loan\UpdateLoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $loan->member_id = $request->member_id;
        $loan->book_id = $request->book_id;
        $loan->duration = $request->duration;
        $loan->loan_date = date('Y-m-d', $request->loan_date);
        $loan->return_date = date('Y-m-d', $request->return_date);
        $loan->save();

        return redirect()->route('loans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->back();
    }
}
