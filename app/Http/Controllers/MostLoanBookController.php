<?php

namespace App\Http\Controllers;

use App\Http\Resources\MostLoanBookResource;
use App\Models\Book;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MostLoanBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('MostLoanBooks/Index', [
            'books' => MostLoanBookResource::collection(
                Book::select('title','id')
                    ->withCount('loans')
                    ->orderBy('loans_count', 'DESC')
                    ->when(request('search'), function ($query, $search) {
                        $query->where('title', 'like', "%$search%");
                    })
                    ->paginate(10,)
                    ->withQueryString()
            ),
            'filters' => Request::only(['search']),
        ]);
        //return Book::select('title')->withCount('loans')->where('loans_count','>',0)->orderBy('loans_count', 'DESC')->get();
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
