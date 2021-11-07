<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Media;

use DataTables;
use Session;
use DB;
class UserController extends Controller
{
    public function merchants(Request $request){
        $merchants = DB::table("users")->select('users.*', DB::raw('group_concat(case profiles.key when "address_line_1" then profiles.value end) as address_line_1'), DB::raw('group_concat(case profiles.key when "address_line_2" then profiles.value end) as address_line_2'), DB::raw('group_concat(case profiles.key when "business_name" then profiles.value end) as business_name'))->leftJoin("profiles", 'users.id', '=', 'profiles.user_id')->groupBy('users.id')->where('role','merchant')->get()->toArray();
        if($request->ajax()) {
            return DataTables::of($merchants)
                ->addColumn('name', function($merchants){
                    $html = '<div class="text-name">'.$merchants->name.'</div>';
                    $html .= '<div class="action-buttons">';
                    $html .= '<a class="text-info" href="#">View</a> | <a class="text-info" href="'.route('admin.merchants.edit',['id'=>$merchants->id]).'">Edit</a>';
                    if ($merchants->active)
                    $html .= ' | <a class="text-warning" href="'.route('admin.merchants.deactive', ['id'=>$merchants->id]).'">Deactive</a>';
                    else
                    $html .= ' | <a class="text-warning" href="'.route('admin.merchants.active', ['id'=>$merchants->id]).'">Active</a>';
                    $html .= ' | <form class="d-inline" method="POST" action="'.route('admin.merchants.destroy', ['id'=>$merchants->id]).'">'.csrf_field().method_field('DELETE').'<button class="btn-link text-danger delete-user" type="submit">Delete</button></form> |  <a class="text-danger" href="'.route('admin.merchants.changepassword', ['id'=>$merchants->id]).'">Change Password</a>';
                    $html .= '<div>';
                    return $html;
                })
                ->addColumn('address', function($merchants){
                    $html = '';
                    if ($merchants->business_name) $html .= '<strong>' .$merchants->business_name.'</strong><br/>';
                    $html .= $merchants->address_line_1 . ' ' .$merchants->address_line_2;
                    return $html;

                })
                ->addColumn('active', function($merchants){
                    if ($merchants->active) return '<span class="text-success">Active</span>';
                    return '<span class="text-danger">On Hold</span>';
                })
                ->rawColumns(['name','active','address'])
//                ->make(true);
                ->toJson();
        }
        return view('admin.merchant.index', compact('merchants'));
    }
    public function merchantsRegister(){
        return view('admin.merchant.register');
    }
    public function usersStore(Request $request){
        $this->validate($request,[
            'avatar' => array("required","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'name'=>array("required","max:255","regex:/^[A-Za-z .'-]+$/i"),
            'email'=>array("nullable","max:255","email",'unique:users'),
            'username'=>array("required","max:255",'unique:users'),
            'mobile'=>array("nullable","max:255"),
            'password'=>array("required","max:255","confirmed","regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/"),
            'buseness_logo' => array("image","max:2000",function ($attribute, $value, $fail) use($request) {
                if ($request->role == 'merchant' && !$value ) {
                    $fail('Please enter Business Logo.');
                }
            }), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'business_name'=>array("max:255",function ($attribute, $value, $fail) use($request) {
                if ($request->role == 'merchant' && !$value ) {
                    $fail('Please enter Business Logo.');
                }
            }),
            'address_line_1'=>array("required","max:255"),
            'address_line_2'=>array("nullable","max:255"),
            'nid'=>array("nullable","max:255"),
            'religion'=>array("nullable","max:255"),
            'gender'=>array("nullable","max:255"),
            'permanent_address_line_1'=>array("nullable","max:255"),
            'permanent_address_line_2'=>array("nullable","max:255"),
            'role'=>array("required","max:255"),
        ]);
        $remember_token = Str::random(10);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'active' => 1,
            'remember_token' => $remember_token,
        ]);

        Profile::create(['user_id' => $user->id, 'key' => 'mobile', 'value' => $request->mobile]);
        Profile::create(['user_id' => $user->id, 'key' => 'business_name', 'value' => $request->business_name]);
        Profile::create(['user_id' => $user->id, 'key' => 'address_line_1', 'value' => $request->address_line_1]);
        Profile::create(['user_id' => $user->id, 'key' => 'address_line_2', 'value' => $request->address_line_2]);
        Profile::create(['user_id' => $user->id, 'key' => 'nid', 'value' => $request->nid]);
        Profile::create(['user_id' => $user->id, 'key' => 'religion', 'value' => $request->religion]);
        Profile::create(['user_id' => $user->id, 'key' => 'gender', 'value' => $request->gender]);
        Profile::create(['user_id' => $user->id, 'key' => 'permanent_address_line_1', 'value' => $request->permanent_address_line_1]);
        Profile::create(['user_id' => $user->id, 'key' => 'permanent_address_line_2', 'value' => $request->permanent_address_line_2]);

        if ($request->hasFile('avatar')){
            $image = $request->avatar;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('avatar')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $avatar_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::create(['user_id' => $user->id, 'key' => 'avatar', 'value' => $avatar_media->id]);
        }

        if ($request->hasFile('buseness_logo')){
            $image = $request->buseness_logo;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('buseness_logo')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $buseness_logo_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::create(['user_id' => $user->id, 'key' => 'buseness_logo', 'value' => $buseness_logo_media->id]);
        }
        Session::flash('success', 'User has been created.');
        return redirect()->back();
    }
    public function merchantsEdit($id){
        $user = User::findOrFail($id);        
        if ($user->role != 'merchant') 
        return abort(404);
        $profiles = $user->profiles()->get();
        return view('admin.merchant.edit', compact('user', 'profiles'));
    }


    public function drivers(Request $request){
        $drivers = DB::table("users")->select('users.*', DB::raw('group_concat(case profiles.key when "address_line_1" then profiles.value end) as address_line_1'), DB::raw('group_concat(case profiles.key when "address_line_2" then profiles.value end) as address_line_2'), DB::raw('group_concat(case profiles.key when "business_name" then profiles.value end) as business_name'))->leftJoin("profiles", 'users.id', '=', 'profiles.user_id')->groupBy('users.id')->where('role','driver')->get()->toArray();
        if($request->ajax()) {
            return DataTables::of($drivers)
                ->addColumn('name', function($drivers){
                    $html = '<div class="text-name">'.$drivers->name.'</div>';
                    $html .= '<div class="action-buttons">';
                    $html .= '<a class="text-info" href="#">View</a> | <a class="text-info" href="'.route('admin.drivers.edit',['id'=>$drivers->id]).'">Edit</a>';
                    if ($drivers->active)
                        $html .= ' | <a class="text-warning" href="'.route('admin.drivers.deactive', ['id'=>$drivers->id]).'">Deactive</a>';
                    else
                        $html .= ' | <a class="text-warning" href="'.route('admin.drivers.active', ['id'=>$drivers->id]).'">Active</a>';
                    $html .= ' | <form class="d-inline" method="POST" action="'.route('admin.drivers.destroy', ['id'=>$drivers->id]).'">'.csrf_field().method_field('DELETE').'<button class="btn-link text-danger delete-user" type="submit">Delete</button></form> |  <a class="text-danger" href="'.route('admin.drivers.changepassword', ['id'=>$drivers->id]).'">Change Password</a>';
                    $html .= '<div>';
                    return $html;
                })
                ->addColumn('address', function($drivers){
                    $html = '';
                    if ($drivers->business_name) $html .= '<strong>' .$drivers->business_name.'</strong><br/>';
                    $html .= $drivers->address_line_1 . ' ' .$drivers->address_line_2;
                    return $html;

                })
                ->addColumn('active', function($drivers){
                    if ($drivers->active) return '<span class="text-success">Active</span>';
                    return '<span class="text-danger">On Hold</span>';
                })
//                ->addColumn('created_at', function($drivers){
//                    return $drivers->created_at . ' - (' . $drivers->created_at->diffForHumans() . ')';
//                })
                ->rawColumns(['name','active','address'])
//                ->make(true);
                ->toJson();
        }
        return view('admin.driver.index', compact('drivers'));
    }
    public function driversRegister(){
        return view('admin.driver.register');
    }
    public function driversEdit($id){
        $user = User::findOrFail($id);
        if ($user->role != 'driver') 
        return abort(404);
        $profiles = $user->profiles()->get();
        return view('admin.driver.edit', compact('user', 'profiles'));
    }
    public function usersUpdate (Request $request, $id){
        $this->validate($request,[
            'avatar' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'name'=>array("required","max:255","regex:/^[A-Za-z .'-]+$/i"),
            'email'=>array("nullable","max:255","email",'unique:users,email,'.$id),
            'username'=>array("required","max:255",'unique:users,username,'.$id),
            'mobile'=>array("nullable","max:255"),
            'buseness_logo' => array("image","max:2000",function ($attribute, $value, $fail) use($request) {
                if ($request->role == 'merchant' && !$value ) {
                    $fail('Please enter Business Logo.');
                }
            }), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'business_name'=>array("max:255",function ($attribute, $value, $fail) use($request) {
                if ($request->role == 'merchant' && !$value ) {
                    $fail('Please enter Business Logo.');
                }
            }),
            'address_line_1'=>array("required","max:255"),
            'address_line_2'=>array("nullable","max:255"),
            'nid'=>array("nullable","max:255"),
            'religion'=>array("nullable","max:255"),
            'gender'=>array("nullable","max:255"),
            'permanent_address_line_1'=>array("nullable","max:255"),
            'permanent_address_line_2'=>array("nullable","max:255"),
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        if ($request->hasFile('avatar')){
            $image = $request->avatar;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('avatar')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $avatar_media = Media::create([
                'user_id' => Auth::id(),
                'title' => $request->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::updateOrCreate(['user_id'=>$id,'key'=>'avatar'],['value'=>$avatar_media->id]);
        }
        if ($request->hasFile('buseness_logo')){
            $image = $request->buseness_logo;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('buseness_logo')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $buseness_logo_media = Media::create([
                'user_id' => Auth::id(),
                'title' => $request->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::updateOrCreate(['user_id'=>$id,'key'=>'buseness_logo'],['value'=>$buseness_logo_media->id]);
        }

        Profile::updateOrCreate(['user_id'=>$id,'key'=>'mobile'],['value'=>$request->mobile]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'business_name'],['value'=>$request->business_name]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'address_line_1'],['value'=>$request->address_line_1]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'address_line_2'],['value'=>$request->address_line_2]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'nid'],['value'=>$request->nid]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'religion'],['value'=>$request->religion]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'gender'],['value'=>$request->gender]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'permanent_address_line_1'],['value'=>$request->permanent_address_line_1]);
        Profile::updateOrCreate(['user_id'=>$id,'key'=>'permanent_address_line_2'],['value'=>$request->permanent_address_line_2]);

        Session::flash('success', 'User has been updated.');
        return redirect()->back();
    }
    public function usersDestroy ($id){
        //dd($id);
        User::destroy($id);
        Session::flash('success', 'User has been deleted.');
        return redirect()->back();
    }
    public function usersChangePassword (){
        $id = (request()->id)?request()->id:Auth::id();
        $user = User::findOrFail($id);
        if ($id != Auth::id()){
            if ($user->role == 'merchant') {
                $folder = 'admin.merchant.changePassword';
            } else {
                $folder = 'admin.driver.changePassword';
            }
            if (Auth::user()->role != 'admin') 
            return abort(404);
        } else {
            if ($user->role == 'admin') {
                $folder = 'admin.profile.changePassword';
            } elseif ($user->role == 'merchant') {
                $folder = 'merchant.profile.changePassword';
            } else {
                $folder = 'driver.profile.changePassword';
            }
        }
        return view($folder, compact('user'));
    }
    public function usersUpdatePassword (Request $request, $id){
        //dd($request);
        $user = User::findOrFail($id);
        $this->validate($request,[
            'old_password'=> array("required","max:255",function ($attribute, $value, $fail) use($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Please try again');
                }
            }),
            'password'=>array("required","max:255","confirmed","regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/"),
        ]);
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('success', 'Password has been updated.');
        return redirect()->back();
    }
    public function usersActive ($id){
        //dd($request);
        $user = User::findOrFail($id);
        $user->active = 1;
        $user->save();
        Session::flash('success', 'User has been activated.');
        return redirect()->back();
    }
    public function usersDeactive ($id){
        $user = User::findOrFail($id);
        $user->active = 0;
        $user->save();
        Session::flash('success', 'Password has been deactivated.');
        return redirect()->back();
    }
    public function usersProfileGeneral(){
        return 'Profile General';
    }
    public function merchantsProfileGeneral(){
        $user = Auth::user();
        $profiles = $user->profiles()->get();
        return view('merchant.profile.general', compact('user', 'profiles'));
    }
}
