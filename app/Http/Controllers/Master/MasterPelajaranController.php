<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterPelajaranRequest;

use App\Models\Master\MasterPelajaran;

class MasterPelajaranController extends Controller
{
    //
    public function index()
    {
        $pelajaran = MasterPelajaran::paginate(10);

        return view('master.pelajaran', compact('pelajaran'));
    }

    public function create(MasterPelajaranRequest $request)
    {
        // dd($request->all());

        $create = MasterPelajaran::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        return back()->with(['success' => 'Success entry kelas']);
    }

    public function delete($id)
    {
        $delete = MasterPelajaran::destroy($id);

        return response()->json(['success' => 'Berhasil hapus data kelas'], 200);
    }
}
