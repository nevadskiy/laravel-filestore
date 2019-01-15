<?php

namespace App\Http\Controllers\Account;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createSkeletonFile();

            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        // TODO: wip
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
