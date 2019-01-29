<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function show(File $file)
    {
        if (!$file->visible()) {
            abort(404);
        }

        $uploads = $file->uploads()->approved()->get();

        return view('files.show', compact('file', 'uploads'));
    }
}
