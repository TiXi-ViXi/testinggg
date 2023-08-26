<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class Hospital extends Controller
{
    public function HospitalIndex()
    {   
        $user = auth()->user();
        if($user->type === 'hospital'){
        return view ('hospital');
        }
        else{
            return view('restricted_permission_message');
        }

        return view ('hospital');
    }
    
    public function storeHospital(Request $request)
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    $data = array(
        'user_id' => $userId, // Associate the user ID with the Hpspital record
        'Name' => $request->hospitalname,
        'City' => $request->city,
        'TotalSeat' => $request->totalseat,
        'Phone_No' => $request->phone,
    );

    DB::table('_hospital')->insert($data);
    return redirect()->back()->with('success', 'Successfully inserted!');

}

public function checkHospitalInfo()
{
    $user = auth()->user();

    $hospitalInfo = DB::table('_hospital')->where('user_id', $user->id)->first();

    if (!$hospitalInfo) {
        // Donor information doesn't exist for the user, redirect to input page
        return redirect()->route('hospital_route');
    }

    // Donor information exists, perform your logic here
    // For example, you could redirect to a page to view/edit donor information
    return redirect()->route('hospital_info_page');
}

public function hospitalInfoPage()
{
    $user = auth()->user();

    $hospitalInfo = DB::table('_hospital')->where('user_id', $user->id)->first();

    return view('hospitalinfo', compact('hospitalInfo'));
}

public function updateHospitalInfo(Request $request)
{
    $user = Auth::user();

    // Update hospital information based on the form fields
    DB::table('_hospital')
        ->where('user_id', $user->id)
        ->update([
            'Name' => $request->input('name'),
            'City' => $request->input('city'),
            'Hospital_Rating' => $request->input('hospital_rating'),
            'TotalSeat' => $request->input('total_seat'),
            'Phone_No' => $request->input('phone_no'),
            // Update other fields here
        ]);

    return redirect()->route('hospital_info_page')->with('success', 'Hospital information updated successfully.');
}
}