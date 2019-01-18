<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\StoreFileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function index()
    {
        $files = auth()->user()->files()->latest()->finished()->get();

        return view('account.files.index', compact('files'));
    }

    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createSkeletonFile();

            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        return view('account.files.create', compact('file'));
    }

    public function store(StoreFileRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        $file->fill($request->only(['title', 'overview', 'overview_short', 'price']));
        $file->finished = true;
        $file->save();

        // Update this
        // Flash message
        // Go to the file index
        return redirect()->route('account.files.index');
    }

    private function createSkeletonFile(): File
    {
        return auth()->user()->files()->create([
            'title' => 'Untitled',
            'overview' => 'None',
            'overview_short' => 'None',
            'price' => 0,
            'finished' => false,
        ]);
    }
}
