<?php

namespace App\Http\Controllers\User;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return view('user.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
 	public function updateProfile(UserRequest $request)
 	{
	    $user = Auth::user();
	    if($request->dob){
	    	$request->merge(['dob' => date("Y-m-d", strtotime($request->get('dob')))]);
	    }
        $user->fill($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $user->upload($request->file('picture'));
        }
        $user->save();
	    
	    Session::flash('flash_message', 'Your account has been updated!');
	    return back();

 	}

    
    /**
     * Show the form for editing the specified resource.
     */
    public function changePassword()
    {
        $user = Auth::user();
        return view('user.profile.change_password', compact('user'));
    }

     /**
     * Update the specified resource in storage.
     */
    public function storePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|check_password',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        $request->merge(['password' => bcrypt($request->get('password'))]);
        $user->fill($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $user->upload($request->file('picture'));
        }
        $user->save();
       
        Session::flash('flash_message', 'Password updated!');

        return back();
    }

}
