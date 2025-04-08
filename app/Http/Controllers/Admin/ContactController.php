<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Contact::create($request->all());
        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được thêm.');
    }

    // public function show(Contact $contact)
    // {
    //     return view('admin.contacts.show', compact('contact'));
    // }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $contact->update($request->all());
        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được cập nhật.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã bị xóa.');
    }

    public function trash()
    {
        $contacts = Contact::onlyTrashed()->paginate(10);
        return view('admin.contacts.trash', compact('contacts'));
    }

    public function restore($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('admin.contacts.trash')->with('success', 'Liên hệ đã được khôi phục.');
    }

    public function forceDelete($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('admin.contacts.trash')->with('success', 'Liên hệ đã bị xóa vĩnh viễn.');
    }
}
