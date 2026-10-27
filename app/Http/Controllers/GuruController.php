<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
$gurus = Guru::all();

    
    return view('guru.index', compact('gurus'));    }

    public function create()
    {
    return view('guru.create');    }

    public function store(Request $request)
    {
$request->validate([
        'nip'           => 'required|unique:gurus,nip',
        'nama'          => 'required',
        'jenis_kelamin' => 'required',
        'email'         => 'required|email|unique:gurus,email',
        'no_hp'         => 'nullable',
        'alamat'        => 'nullable',
    ]);

    Guru::create($request->all());

    return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');    }

    public function edit(Guru $guru)
    {
    return view('guru.edit', compact('guru'));    }

    public function update(Request $request, Guru $guru)
    {
$request->validate([
        'nip'           => 'required|unique:gurus,nip,' . $guru->id,
        'nama'          => 'required',
        'jenis_kelamin' => 'required',
        'email'         => 'required|email|unique:gurus,email,' . $guru->id,
        'no_hp'         => 'nullable',
        'alamat'        => 'nullable',
    ]);

    $guru->update($request->all());

    return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');    }

    public function destroy(Guru $guru)
    {
$guru->delete();

    return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');    }
}

