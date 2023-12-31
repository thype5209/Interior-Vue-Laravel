<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiBobotKriteria;
use App\Models\NilaiBobotAlternatif;
use App\Http\Controllers\SubKriteriaController;
use App\Models\Alternatif;
use App\Models\MatrixAlternatifJson;
use App\Models\MatrixJson;
use App\Models\SubAlternatif;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class KriteriaController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode', 'asc')->paginate(10);
        return Inertia::render('Kriteria/Index', [
            'kriteria'=> $kriteria,
            'kode'=> $this->createCode()
        ]);
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
     * @param  \App\Http\Requests\StoreKriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // dd($request->all());
       $valid= Request::validate([
            'kode'=> 'required|unique:kriterias,kode',
            'name'=> 'required|unique:kriterias,name',
            'subkriteria'=> 'required|array',
        ]);
        // dd($valid);
        $kriteria = Kriteria::create([
            'kode'=> Request::input('kode'),
            'name'=> Request::input('name'),
        ]);
        // Tambah Sub Kriteria
        $subKriteria = new SubKriteriaController();
        $subKriteria->store(Request::input('subkriteria'), $kriteria->id);
        // Tambah NilaiBobotKriteriaController
        $tbKriteria = new NilaiBobotKriteriaController();
        $tbKriteria->store(Request::input('kode'));
        // Tambah NilaiBobotAlternatifController
        $tbKriteria = new NilaiBobotAlternatifController();
        $tbKriteria->store();

        $alternatif = Alternatif::all();
        foreach($alternatif as $key=>$value){
            SubAlternatif::create([
                'alternatif_id'=> $value->id,
                'sub_kriteria' => Request::input('subkriteria')[0],
                'kriteria_kode'=> Request::input('kode'),
            ]);
        }
        return redirect()->route('Kriteria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        return Inertia::render('Kriteria/Show', [
            'kriteria'=> Kriteria::with(['subKriteria'])->where('kode',Request::input('slug'))->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria, $id)
    {
        $data = $kriteria->find($id);
        return Inertia::render('Kriteria.Form', [
            'kriteria'=> $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKriteriaRequest  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Kriteria $kriteria, $id)
    {
        // dd($request->all());
        $kriteria->find($id)->update([
            'kode'=> Request::input('kode'),
            'name'=> Request::input('name'),
        ]);
         // Tambah Sub Kriteria
         $subKriteria = new SubKriteriaController();
         $subKriteria->store(Request::input('subkriteria'), $id);
        return redirect()->route('Kriteria.index')->with('success', 'Berhasil Ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        $data = Kriteria::find(Request::input('id'));
        $nilaiA = NilaiBobotAlternatif::where('kriteria_id', $data->kode)->get();
        $m = MatrixJson::all();
        $a = MatrixAlternatifJson::all();
        foreach($m as $item){
            MatrixJson::where('id',$item->id)->delete();
        }
        foreach($a as $item){
            MatrixAlternatifJson::where('id',$item->id)->delete();
        }
        SubAlternatif::where('kriteria_kode', $data->kode)->delete();
        $nilaiK = NilaiBobotKriteria::where('kriteria1', $data->kode)->orWhere('kriteria2', $data->kode)->get();
        // dd($nilaiA,$nilaiK);
        $data->delete();
    }
    private function createCode()
    {
        $alternatif = Kriteria::max('kode');
        if ($alternatif == null) {
            $kode = "C01";
        } else {
            $parse_kode = substr($alternatif, 1, 2);
            $parse_kode++;
            $huruf = "C";
            $kode = sprintf($huruf ."%02s",  $parse_kode);
        }
        return $kode;
    }
}
