<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard', [
            'bookCount' => Book::count(),
            'memberCount' => Member::count(),
            'loanCount' => Loan::count(),
            'fineCount' => Fine::count(),
            'loanCountPerDay' => $this->loanCountPerDay(),
            'mostLoanBooks' => $this->mostLoanBooks(),
        ]);
    }

    public function loanCountPerDay()
    {
        $from = Carbon::now()->subDays(8);
        $to = Carbon::now();
        $loans = Loan::select(DB::raw('DATE(loan_date) AS date'), DB::raw('count(*) as total'))->whereDate('loan_date', '<=', $to)->whereDate('loan_date', '>=', $from)->groupBy('date')->get();

        $totalDate = 8;
        $dateArr = [];
        for ($i = 0; $i <= $totalDate; $i++) {
            $date = date('Y-m-d', Carbon::now()->subDays($i)->getTimestamp());
            $dateArr[] = $date;
            if (!isset($loans[$i])) {
                $object = new stdClass();
                $object->total = 0;
                $object->date = $date;
                $loans[$i] = $object;
            }
            $loans[$i]->date = $date;
        }

        return [
            'date' => $dateArr,
            'total' => collect($loans)->map(fn ($loan) => $loan->total)->toArray()
        ];
    }

    public function mostLoanBooks()
    {
        $books = Book::select('title')->withCount('loans')->orderBy('loans_count', 'DESC')->take(8)->get();
        return [
            'total' => collect($books)->map(fn($book) => $book->loans_count)->toArray(),
            'title' => collect($books)->map(fn ($book) => $book->title)->toArray(),
        ];
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
