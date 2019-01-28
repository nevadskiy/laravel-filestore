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

    public function update(File $file)
    {
        $file->mergeApprovalProperties();
        $file->approveAllUploads();
        $file->deleteAllApprovals();

        return back()->with('success', "{$file->title} changes have been approved.");
    }

    public function destroy(File $file)
    {
        $file->deleteAllApprovals();
        $file->deleteUnapprovedUploads();

        return back()->with('success', "{$file->title} changes have been rejected.");
    }
}
