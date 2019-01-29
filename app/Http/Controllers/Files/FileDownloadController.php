<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Sale;
use App\Http\Controllers\Controller;
use Chumper\Zipper\Zipper;

class FileDownloadController extends Controller
{
    /**
     * @var Zipper
     */
    private $zipper;

    /**
     * FileDownloadController constructor
     *
     * @param Zipper $zipper
     */
    public function __construct(Zipper $zipper)
    {
        $this->zipper = $zipper;
    }
    
    public function show(File $file, Sale $sale)
    {
        if (!$file->visible()) {
            return abort(403);
        }

        if (!$file->matchesSale($sale)) {
            return abort(403);
        }

        $file->getUploadList();

        $path = $this->generateTemporaryPath($file);

        $this->createZipForFileInPath($file, $path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    protected function createZipForFileInPath(File $file, $path)
    {
        $this->zipper->make($path)->add($file->getUploadList())->close();
    }

    public function generateTemporaryPath(File $file)
    {
        return public_path('tmp/' . $file->identifier . '.zip');
    }
}
