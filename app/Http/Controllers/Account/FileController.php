<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\{StoreFileRequest, UpdateFileRequest};
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

    public function edit(File $file)
    {
        $this->authorize('touch', $file);

        $approval = $file->approvals()->first();

        return view('account.files.edit', compact('file', 'approval'));
    }

    public function update(File $file, UpdateFileRequest $request)
    {
        $this->authorize('touch', $file);

        $approvalProperties = $request->only(File::APPROVAL_PROPERTIES);

        if ($file->needsApproval($approvalProperties)) {
            $file->createApproval($approvalProperties);
            return back()->with('success', 'Thanks! We will review your changes soon.');
        }

        $file->update([
            'live' => $request->has('live'),
            'price' => $request->get('price'),
        ]);

        return back()->with('success', 'File updated');
    }

    public function store(StoreFileRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        $file->fill($request->only(['title', 'overview', 'overview_short', 'price']));
        $file->finished = true;
        $file->save();

        // Update this

        // Go to the file index
        return redirect()->route('account.files.index')->with('success', 'Thanks, submitted form review');
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
