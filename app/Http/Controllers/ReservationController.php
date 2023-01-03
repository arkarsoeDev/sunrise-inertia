<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use Inertia\Inertia;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Reservations/Index', [
            'reservations' => ReservationResource::collection(
                Reservation::query()
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
        if (request()->has('book_id')) {
            return Inertia::render('Reservations/Create', [
                'book_id' => request()->book_id,
            ]);
        }

        return Inertia::render('Reservations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Reservation\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = new Reservation();
        $reservation->member_id = $request->member_id;
        $reservation->book_id = $request->book_id;
        $reservation->reservation_date = date('Y-m-d', $request->reservation_date);
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return Inertia::render('Reservations/Edit', [
            'reservation' => new ReservationResource($reservation)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\Reservation\UpdateReservationRequest  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->member_id = $request->member_id;
        $reservation->book_id = $request->book_id;
        $reservation->reservation_date = date('Y-m-d', $request->reservation_date);
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->back();
    }
}
