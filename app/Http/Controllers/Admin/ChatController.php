<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        return view('admin.chat');
    }
}
