<?php
/**
 * Created by AlicFeng at 2019-02-13 15:33
 */

namespace App\Http\Controllers\Platform;


use App\Http\Controllers\Controller;
use App\Service\Platform\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $request;
    private $fileService;

    public function __construct(Request $request, FileService $fileService)
    {
        $this->request     = $request;
        $this->fileService = $fileService;
    }

    public function upload()
    {
        return $this->fileService->upload();
    }
}