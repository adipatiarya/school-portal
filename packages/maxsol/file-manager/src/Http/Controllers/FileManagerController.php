<?php

namespace Maxsol\FileManager\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class FileManagerController extends Controller
{
private function getDirectoryTree($path)
{
    $dirs = Storage::disk('public')->directories($path);
    // Ambil semua file di direktori ini
    $files = Storage::disk('public')->files($path);

    return [
        'name' => basename($path),
        'path' => $path,
        'files' => collect($files)->map(function ($file) {
            return [
                'name'          => basename($file),
                'path'          => $file,
                'size'          => Storage::disk('public')->size($file),
                'last_modified' => date('Y-m-d H:i:s', Storage::disk('public')->lastModified($file)),
                'mime_type'     => Storage::disk('public')->mimeType($file),
                'url'           => Storage::url($file),
            ];
        }),
        'directories' => collect($dirs)->map(function ($dir) {
            return $this->getDirectoryTree($dir); // rekursif
        })
    ];

}


public function index()
{
    $root = 'uploads';
    $tree = $this->getDirectoryTree($root);

    return response()->json($tree);
}


   // List semua file
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048'
        ]);

        $file = $request->file('file');

        // Ambil nama asli + ekstensi
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        // Buat folder default: uploads/tahun/tanggal
        $folder = 'uploads/' . date('Y') . '/' . date('m-d');

        // Buat nama file baru
        $filename = $originalName . '_' . time() . '.' . $extension;

        // Simpan file ke folder sesuai tahun/tanggal
        $path = $file->storeAs($folder, $filename, 'public');
        
        return response()->json([
            'message'   => 'File uploaded successfully',
            'path'      => $path,
            'folder'    => $folder,
            'filename'  => $filename,
            'extension' => $extension
        ]);
    }



}