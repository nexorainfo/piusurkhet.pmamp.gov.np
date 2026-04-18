<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function imageUpload(Request $request)
    {
        $image =  $request->upload->store('file/uploads', 'public');
        return ([
            'fileName'=>'file.jpg',
            'uploaded'=>1,
            'url' => Storage::disk('public')->url($image)
        ]);
    }
}
