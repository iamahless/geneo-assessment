<?php

namespace App\Http\Controllers;

use App\Geneo\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function process(ContactRequest $request)
    {
        try {
            $data = $request->validated();
            Contact::createNewContact($data);
            return redirect()->route('contact.index')->withSuccess('Contact Form Submitted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->withError($e->getMessage());
        }

    }
}
