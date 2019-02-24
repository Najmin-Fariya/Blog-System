<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorSettingsController extends Controller
{
    public function index(){
        return view('author.authorSettings');
    }
    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required',
            'image'=> 'required'
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }
            //delete old pic
            if(Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            $profileImageResize = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profileImageResize);
        }else{
            $imageName = $user->image;
        }
        
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $imageName;
            $user->about = $request->about;
            $user->save();
            
            Toastr::success('Your Profile successfully Updated','success');
            return redirect()->back();
    }
    
    public function updatePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hashedPasswordFromDB = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPasswordFromDB))
        {
            if(!Hash::check($request->password, $hashedPasswordFromDB))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Your password successfully Changed :):)','success');
                Auth::logout();
                return redirect()->back();
            }else{
                Toastr::error('You gave a old password','error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Current password not matched','error');
            return redirect()->back();
        }
        
    }
}
