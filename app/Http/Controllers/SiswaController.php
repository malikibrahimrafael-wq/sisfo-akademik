<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa beserta relasi kelas dan tampilkan ke view 'siswa.index'
        $siswas = Siswa::with('kelas')->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        // Ambil data kelas dan tampilkan view 'siswa.create'
        $kelas = Kelas::all();

        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validasi input (nis, nama, jenis_kelamin, alamat, no_hp, kelas_id) lalu simpan data siswa baru
        $request->validate([
            'nis'           => 'required|unique:siswas,nis|max:20',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        // Tampilkan detail data siswa beserta relasi kelas dan nilai ke view 'siswa.show'
        $siswa->load(['kelas', 'nilais.mapel']);

        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        // Ambil data siswa dan kelas untuk ditampilkan di form edit 'siswa.edit'
        $kelas = Kelas::all();

        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        // Validasi data input lalu perbarui data siswa
        $request->validate([
            'nis'           => 'required|max:20|unique:siswas,nis,' . $siswa->id,
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'kelas_id'      => 'required|exists:kelas,id',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        // Hapus data siswa yang dipilih
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}