<?php

namespace App\Http\Controllers;

use App\Models\Char;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Validator;

class CharAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chars = Char::all();
        return datatables()
            ->of($chars)
            ->addColumn('action', function ($char) {
                return view('component.datatable-action-btn')->with('data', $char);
            })
            ->editColumn('rarity', function ($char) {
                $star = '';
                for ($i = 0; $i < $char->rarity; $i++) {
                    $star .= '<i class="fas fa-star color-warning"></i>';
                }
                return $star;
            })
            ->editColumn('weapon', function ($char) {
                return ucfirst($char->weapon);
            })
            ->editColumn('vision', function ($char) {
                return ucfirst($char->vision);
            })
            ->editColumn('birthday', function ($char) {

                return date_format(date_create($char->birthday), "F jS");
            })
            ->rawColumns(['action', 'rarity'])
            ->addIndexColumn()
            ->make(true);
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
        $validator = Validator::Make($request->all(), [
            'name' => 'required|min:3',
            'rarity' => 'required|in:4,5',
            'weapon' => 'required|in:"sword","claymore","polearm","catalyst","bow"',
            'vision' => 'required|in:"pyro","hydro","electro","cryo","dendro","anemo","geo"',
            'birthday' => 'required|date',
            'constellation' => 'required|min:3',
            'region' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $data = [
                'name' => ucwords(trim($request->name)),
                'rarity' => $request->rarity,
                'weapon' => $request->weapon,
                'vision' => $request->vision,
                'Birthday' => $request->birthday,
                'constellation' => ucwords(trim($request->constellation)),
                'region' => ucwords(trim($request->region))
            ];
            Char::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'New Character successfully added',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $char = Char::findOrFail($id);
        return response()->json($char);
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
        $validator = Validator::Make($request->all(), [
            'name' => 'required|min:3',
            'rarity' => 'required|in:4,5',
            'weapon' => 'required|in:"sword","claymore","polearm","catalyst","bow"',
            'vision' => 'required|in:"pyro","hydro","electro","cryo","dendro","anemo","geo"',
            'birthday' => 'required|date',
            'constellation' => 'required|min:3',
            'region' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $data = [
                'name' => ucwords(trim($request->name)),
                'rarity' => $request->rarity,
                'weapon' => $request->weapon,
                'vision' => $request->vision,
                'Birthday' => $request->birthday,
                'constellation' => ucwords(trim($request->constellation)),
                'region' => ucwords(trim($request->region))
            ];
            Char::where('id', $id)
                ->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Character successfully updated',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Char::destroy($id)) {
            return response()->json([
                'status' => 400,
                'errors' => 'Failed Deleted'
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Character successfully deleted',
        ]);
    }
}
