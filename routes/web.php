<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DailyLoanCountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\FinePaymentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MostLoanBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use App\Http\Resources\LoanCountResource;
use App\Http\Resources\LoanResource;
use App\Models\Book;
use App\Models\Member;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect()->route('dashboard');
});

Route::get('/test', function () {
    return Book::select('id', 'title')
        ->withCount('loans')
        ->orderBy('loans_count', 'DESC')
        ->when(request()->has('search'), function ($query, $search) {
            $query->where('title', 'like', "%$search%");
        })
        ->paginate(10)
        ->withQueryString();
    //     $from = Carbon::now()->subDays(8);
    // $to = Carbon::now();
    // return LoanCountResource::collection(
    //             Loan::select(DB::raw('DATE(loan_date) AS date'), DB::raw('count(*) as total'))
    //                 ->whereDate('loan_date', '<=', $to)
    //                 ->whereDate('loan_date', '>=', $from)
    //                 ->groupBy('date')
    //                 ->paginate(10)
    //                 ->withQueryString()
    // );

    // $from = Carbon::now()->subDays(8);
    // $to = Carbon::now();
    // $loans = Loan::select(DB::raw('DATE(loan_date) AS date'), DB::raw('count(*) as total'))->whereDate('loan_date', '<=', $to)->whereDate('loan_date', '>=', $from)->groupBy('date')->get();
    // return $loans;
    // $totalDate = 8;
    // $dateArr = [];
    // for ($i = 0; $i <= $totalDate; $i++) {
    //     $date = date('Y-m-d', Carbon::now()->subDays($i)->getTimestamp());
    //     $dateArr[] = $date;
    //     if (!isset($loans[$i])) {
    //         $object = new stdClass();
    //         $object->total = 0;
    //         $object->date = $date;
    //         $loans[$i] = $object;
    //     }
    //     $loans[$i]->date = $date;
    // }

    // return [
    //     'date' => $dateArr,
    //     'total' => collect($loans)->map(fn ($loan) => $loan->total)->toArray()
    // ];
    // return new LoanResource(Loan::with(['fine'])->find(1));
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/members', MemberController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/authors', AuthorController::class);
    Route::resource('/books', BookController::class);
    Route::resource('/loans', LoanController::class);
    Route::resource('/fines', FineController::class);
    Route::resource('/fine-payments', FinePaymentController::class);

    Route::get('daily-loan-count', [DailyLoanCountController::class, 'index'])->name('daily-loan-count.index');
    Route::get('most-loan-books', [MostLoanBookController::class, 'index'])->name('most-loan-books.index');

    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
