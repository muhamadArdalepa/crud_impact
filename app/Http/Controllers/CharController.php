<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Char;
use Illuminate\Http\Request;

class CharController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $chars = Char::all();
        return datatables()
            ->of($chars)
            ->addColumn('action', function ($char) {
                return '
                <div class="btn-group"><button type="button" onclick="editForm(`' .  $char->id . '`)" class="btn btn-warning btn-sm"data-bs-toggle="modal" data-bs-target="#ModalEdit">Edit</button><button type="button" onclick="delete(`' . $char->id . '`)" class="btn btn-danger btn-sm">Delete</button>
            ';
            })
            ->editColumn('rarity', function ($char) {
                $star = '';
                $n = $char == '4' ? 4 : 5;
                for ($i = 0; $i < $n; $i++) {
                    $star .= '<i class="fas fa-star color-warning"></i>';
                }
                return $star;
            })
            ->rawColumns(['action', 'rarity'])
            ->addIndexColumn()
            ->make(true);
    }
    public function index()
    {
        return view('char.index')->with('title', 'Character Table')->with('menu', 'char');
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
