<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReservationResource;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Books/Index', [
            'books' => BookResource::collection(
                Book::query()
                    ->when(Request::input('search'), function ($query, $search) {
                        $query->where(fn ($query) => ($query->where('title', 'like', "%{$search}%")
                            ->orWhere('id', 'like', "%{$search}%")
                        ));
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
        return Inertia::render('Books/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Book\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->publication_date = $request->publication_date;
        $book->copies_owned = $request->copies_owned;
        $book->available = $request->available;
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return Inertia::render('Books/Show', [
            'book' => new BookResource($book),
            'reservations' => ReservationResource::collection(
                Reservation::query()
                    ->where('book_id', $book->id)
                    ->when(Request::input('reservation_search'), function ($query, $search) {
                        $query->where('member_id', 'like', "%{$search}%");
                    })
                    ->paginate(10)
                    ->withQueryString()
            ),
            'filters' => Request::only(['reservation_search']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Book\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->publication_date = $request->publication_date;
        $book->copies_owned = $request->copies_owned;
        $book->available = $request->available;
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->back();
    }
}
