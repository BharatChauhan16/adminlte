<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adduser;
use App\Models\UserProfile;
use App\Models\Permission;


class EdituserController extends Controller
{
    public function edit($userId)
{   
      $users = Adduser::find($userId);
    return view('users.edit_users', [
        'users' => $users
    ]);

}

public function editUser(Request $request)
     {
        // Validate the data before saving into the database
        $validatedData = $request->validate([
            'address' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'employee_code' => 'nullable|string',
            'academic_documents' => 'nullable|file|mimes:pdf',
            'identification_documents' => 'nullable|file|mimes:pdf',
            'offer_letter' => 'nullable|file|mimes:pdf',
            'joining_letter' => 'nullable|file|mimes:pdf',
            'contract' => 'nullable|file|mimes:pdf',
        ]);

        // Upload files
        $files = [];
        foreach (['academic_documents', 'identification_documents', 'offer_letter', 'joining_letter', 'contract'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $files[$fileField] = $request->file($fileField)->store('documents');
            }
        }

        // Create user profile
        $userProfile = new UserProfile($validatedData);
        $userProfile->user_id = auth()->id(); // Assuming user is logged in
        $userProfile->fill($files);
        $userProfile->save();

        // UserProfile::create($validatedData);

        return redirect('/admin/users');
        // dd($request->all()); $validatedData  
    }

}