<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
$mapels = Mapel::all();

    return view('mapel.index', compact('mapels'));    }

    public function create()
    {
    return view('mapel.create');    }

    public function store(Request $request)
    {
$request->validate([
        'kode_mapel' => 'required|unique:mapels,kode_mapel',
        'nama_mapel' => 'required',
        'kkm'        => 'required|numeric|min:0|max:100',
    ]);

    Mapel::create($request->all());

    return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan!');    }

    public function edit(Mapel $mapel)
    {
    return view('mapel.edit', compact('mapel'));    }

    public function update(Request $request, Mapel $mapel)
    {
$request->validate([
        'kode_mapel' => 'required|unique:mapels,kode_mapel,' . $mapel->id,
        'nama_mapel' => 'required',
        'kkm'        => 'required|numeric|min:0|max:100',
    ]);

    $mapel->update($request->all());

    return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui!');    }

    public function destroy(Mapel $mapel)
    {
$mapel->delete();

    return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus!');    }
}

