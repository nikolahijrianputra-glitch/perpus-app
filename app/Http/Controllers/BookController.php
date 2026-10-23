<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku.
     */
    public function index()
    {
        // Ambil semua buku, urut dari yang terbaru, 10 data per halaman
        $books = Book::latest()->paginate(10);

        // Nama halaman: 'Books/Index' (tanpa .vue, tanpa path lengkap)
        return inertia('Books/Index', [
            'books' => $books,
        ]);
    }

    /**
     * Menampilkan form tambah buku.
     */
    public function create()
    {
        return inertia('Books/Create');
    }

    /**
     * Validasi lalu simpan buku baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi di sisi server
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books',   // wajib & tidak boleh kembar
            'judul'     => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit'  => 'nullable|max:255',        // boleh kosong
            'tahun'     => 'nullable|digits:4',       // kalau diisi harus 4 digit
            'stok'      => 'required|integer|min:0',  // tidak boleh negatif
        ]);

        // 2. Simpan ke tabel books
        Book::create($validated);

        // 3. Balik ke daftar buku + pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Dikerjakan di Pertemuan 7.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}