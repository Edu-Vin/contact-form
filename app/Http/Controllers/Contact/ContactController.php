<?php

namespace App\Http\Controllers\Contact;

use App\Contracts\Contact\ContactInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{

    protected $interface;

    public function __construct(ContactInterface $interface)
    {
        $this->interface = $interface;
    }

    public function create()
    {
        return view('contact');
    }

    public function store(ContactFormRequest $request)
    {
        try {

            $contact = $this->interface->create($request->validated());
            return redirect()->route('contact')->with('success', 'Form Submitted Successfully');

        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', $e->getMessage());
        }

    }
}
