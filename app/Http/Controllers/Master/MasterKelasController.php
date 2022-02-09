<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterKelasRequest;

use App\Models\Master\MasterKelas;

use Datatables;

class MasterKelasController extends Controller
{
    //
    public function index()
    {
        $kelas = MasterKelas::paginate(10);

        return view('master.kelas', compact('kelas'));
    }

    public function create(MasterKelasRequest $request)
    {
        // dd($request->all());

        $create = MasterKelas::create([
            'namakelas' => $request->namakelas,
            'kodekelas' => $request->kodekelas,
            'tingkat' => $request->tingkat,
        ]);

        return back()->with(['success' => 'Success entry kelas']);
    }

    public function delete($id)
    {
        // dd($id);
        $delete = MasterKelas::destroy($id);

        return response()->json(['success' => 'Berhasil hapus data kelas'], 200);
    }

    public function getData()
    {
        return Datatables::of(MasterKelas::query())
        ->addIndexColumn()->make(true);
    }
}
