<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Http\Requests\StoreSubKriteriaRequest;
use App\Http\Requests\UpdateSubKriteriaRequest;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSubKriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subKriteria, $kriteria_id)
    {
        for ($i=0; $i < count($subKriteria); $i++) {
            $sub = SubKriteria::where( 'nama',$subKriteria[$i])->first();
            if($sub == null){
                SubKriteria::create([
                    'kriteria_id' => $kriteria_id,
                    'nama' => $subKriteria[$i],
                ]);
            }else{
                SubKriteria::where('nama', '=', $subKriteria[$i])->update([
                    'nama' => $subKriteria[$i],
                ]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubKriteriaRequest  $request
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubKriteria $subKriteria, $id)
    {
        $subKriteria->find($id)->delete();
        return redirect()->back();
    }
}
