<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\EducationalContent;
use Illuminate\Http\Request;


class EducationalContentController extends Controller
{

    // Menampilkan semua konten edukasi
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari request
        $search = $request->input('search');

        // Query data berdasarkan title atau description
        $contents = EducationalContent::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->get();

        return view('educational_contents.index', compact('contents', 'search'));
    }


    // Menampilkan form untuk mengunggah konten
    public function create()
    {
        return view('educational_contents.create');
    }

    // Menyimpan konten edukasi yang diunggah
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,mp4|max:10240',
        ]);

        // Menyimpan file di folder 'educational_contents' tanpa menggunakan disk 'public'
        $filePath = $request->file('file')->store('educational_contents');

        // Menyimpan data konten edukasi ke database
        EducationalContent::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath, // Menyimpan relative path
        ]);

        return redirect()->route('educational-contents.index')->with('success', 'Content uploaded successfully!');
    }


    public function download(EducationalContent $content)
    {
        // Mendapatkan path file fisik dari penyimpanan
        $filePath = storage_path('app/' . $content->file_path);

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found!');
        }

        // Mengembalikan file untuk diunduh
        return response()->download($filePath, $content->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
