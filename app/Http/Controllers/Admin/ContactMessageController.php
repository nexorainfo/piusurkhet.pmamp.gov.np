<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ContactMessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('contact_message_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $contactMessages = ContactMessage::latest()->get();

        return view('admin.contact_message', compact('contactMessages'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        abort_if(
            Gate::denies('contact_message_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $contactMessage->delete();

        toast('Contact Message Deleted Successfully', 'success');

        return back();
    }
}
