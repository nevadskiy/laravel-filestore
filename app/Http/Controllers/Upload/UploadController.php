<?php

namespace App\Http\Controllers\Upload;

use App\File;
use App\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * UploadController constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(File $file, Request $request)
    {
        $this->authorize('touch', $file);

        $uploadedFile = $request->file('file');

        $upload = $this->storeUpload($file, $uploadedFile);

        Storage::disk('local')->putFileAs("files/{$file->identifier}", $uploadedFile, 'test.png');

        return response()->json([
            'id' => 1,
        ]);
    }

    private function storeUpload(File $file, UploadedFile $uploadedFile)
    {
        $upload = new Upload();

        $upload->fill([
            'filename' => $this->generateFilename($uploadedFile),
            'size' => $uploadedFile->getSize(),
        ]);

        $upload->file()->associate($file);
        $upload->user()->associate(auth()->user());

        $upload->save();

        return $upload;
    }

    protected function generateFilename(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getClientOriginalName();
    }
}
