<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;

class FileUpdatedController extends Controller
{
    public function index()
    {
        $files = File::has('approvals')->oldest()->get();

        return view('admin.files.updated.index', compact('files'));
    }
}
