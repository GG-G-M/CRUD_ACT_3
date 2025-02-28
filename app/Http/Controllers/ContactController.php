<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // For DB::select() or DB::table()

class ContactController extends Controller
{
    public function index()
    {
        // If you want to call the stored procedure:
        // $contacts = DB::select('CALL ListAllContacts()');

        // Or just select from the contacts table directly:
        // $contacts = DB::table('contacts')->get();

        // Example using stored procedure:
        $contacts = DB::select('CALL ListAllContacts()');

        return view('contacts', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Validate as needed
        // $request->validate([...]);

        // Example: If you just want to do a plain insert:
        DB::table('contacts')->insert([
            'firstname' => $request->input('firstname'),
            'lastname'  => $request->input('lastname'),
            'birthdate' => $request->input('birthdate'),
            'workphone' => $request->input('workphone'),
            'homephone' => $request->input('homephone'),
            'email'     => $request->input('email'),
            // If you need createdByID, set it here or default
            'createdByID' => 1,
            'createdDate' => now(),
        ]);

        return redirect()->route('contacts.index');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        // Example: update the record
        DB::table('contacts')
            ->where('id', $id)
            ->update([
                'firstname' => $request->input('firstname'),
                'lastname'  => $request->input('lastname'),
                'birthdate' => $request->input('birthdate'),
                'workphone' => $request->input('workphone'),
                'homephone' => $request->input('homephone'),
                'email'     => $request->input('email'),
            ]);

        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        DB::table('contacts')->where('id', $id)->delete();
        return redirect()->route('contacts.index');
    }
}
