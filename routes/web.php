<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\FinePaymentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReturnController;
use App\Http\Resources\LoanResource;
use App\Models\Member;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Ramsey\Uuid\Converter\Time\UnixTimeConverter;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/test', function () {
    // $faker = Faker\Factory::create();
    // $date = $faker->unixTime($faker->dateTimeBetween());
    // echo date('Y-m-d H:i:s', $date);echo "<br>";
    // $date = strtotime("+7 days", $date);
    // return strtotime($date);return date('Y-m-d H:i:s',$date);

    // $loan = Loan::find(2);
    // return $loan;

    return new LoanResource(Loan::with(['fine'])->find(1));
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/members', MemberController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/authors', AuthorController::class);
    Route::resource('/books', BookController::class);
    Route::resource('/loans', LoanController::class);
    Route::resource('/fines', FineController::class);
    Route::resource('/fine-payments', FinePaymentController::class);

    Route::post('/returns', [ReturnController::class,'store'])->name('returns.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
