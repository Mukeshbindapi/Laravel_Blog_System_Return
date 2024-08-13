<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use App\Http\Requests\auth\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function OpenProfilePage(){
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function StoreProfile(ProfileRequest $request){
        $user = auth()->user();

        try{
            if(! $request->password){
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }else{
                $user->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
            }

            $request->session()->flash('alert-success','Profile Updated Successfully');
            return to_route('auth.profile.index');

        }catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }


    }
}
