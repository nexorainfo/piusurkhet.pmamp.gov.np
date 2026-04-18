<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function destroy(File $file)
    {
        $this->deleteFile($file->url);
        $file->delete();
        toast('File Deleted', 'success');
        return back();
    }
}
