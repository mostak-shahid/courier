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
    public $body_class;
    public $wrapper_class;
    public function setVariables(){
        $this->body_class = 'sidebar-mini';
        $this->wrapper_class = 'wrapper';
    }
    public function merchants(Request $request){
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        //$merchants = User::where('role','merchant')->get();
        //$merchants = User::with('profiles')->where('role','merchant')->get();
        //$merchants = DB::table("users")->get()->toArray();
        $merchants = DB::table("users")->select('users.*', DB::raw('group_concat(case profiles.key when "address_line_1" then profiles.value end) as address_line_1'), DB::raw('group_concat(case profiles.key when "address_line_2" then profiles.value end) as address_line_2'), DB::raw('group_concat(case profiles.key when "business_name" then profiles.value end) as business_name'))->leftJoin("profiles", 'users.id', '=', 'profiles.user_id')->groupBy('users.id')->where('role','merchant')->get()->toArray();
        $query = "SELECT u.*, group_concat(CASE p.key WHEN 'address_line_1' THEN p.value END) address_line_1, group_concat(CASE p.key WHEN 'address_line_2' THEN p.value END) address_line_2, group_concat(CASE p.key WHEN 'business_name' THEN p.value END) business_name FROM users u LEFT JOIN profiles p ON u.id = p.user_id GROUP BY u.id";
        //$merchants  = DB::select(DB::raw($query));


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
//                ->addColumn('created_at', function($merchants){
//                    return $merchants->created_at . ' - (' . $merchants->created_at->diffForHumans() . ')';
//                })
                ->rawColumns(['name','active','address'])
//                ->make(true);
                ->toJson();
        }
        return view('admin.merchant.index', compact('body_class', 'wrapper_class', 'merchants'));
    }
    public function merchantsRegister(){
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        return view('admin.merchant.register', compact('body_class', 'wrapper_class'));
    }
    public function merchantsStore(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'profile_photo' => array("required","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'name'=>array("required","max:255","regex:/^[A-Za-z .'-]+$/i"),
            'email'=>array("nullable","max:255","email",'unique:users'),
            'username'=>array("required","max:255",'unique:users'),
            'mobile'=>array("nullable","max:255"),
            'password'=>array("required","max:255","confirmed","regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/"),
            'buseness_logo' => array("required","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'business_name'=>array("required","max:255"),
            'address_line_1'=>array("required","max:255"),
            'address_line_2'=>array("nullable","max:255"),
            'nid'=>array("nullable","max:255"),
            'religion'=>array("nullable","max:255"),
            'gender'=>array("nullable","max:255"),
            'permanent_address_line_1'=>array("nullable","max:255"),
            'permanent_address_line_2'=>array("nullable","max:255"),
            /*'dob'=>array("nullable","max:255","regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", function ($attribute, $value, $fail){
                $signup_age_limit_status = Setting::where('option', 'signup_age_limit_status')->first()->value;
                $signup_age_limit = Setting::where('option', 'signup_age_limit')->first()->value;
                $age = date_diff(date_create($value), date_create('today'))->y;
                if ($signup_age_limit_status && $signup_age_limit && $age < $signup_age_limit) {
                    $fail('Your minimun age should be ' . $signup_age_limit . '.');
                }

            }),*/
        ]);
        $remember_token = Str::random(10);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "merchant",
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

        if ($request->hasFile('profile_photo')){
            $image = $request->profile_photo;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('profile_photo')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $profile_photo_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::create(['user_id' => $user->id, 'key' => 'profile_photo', 'value' => $profile_photo_media->id]);
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
        $profiles = $user->profiles()->get();
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        return view('admin.merchant.edit', compact('body_class', 'wrapper_class', 'user', 'profiles'));
    }
    public function merchantsUpdate (Request $request, $id){
        //dd($request->all());
        $this->validate($request,[
            'profile_photo' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'name'=>array("required","max:255","regex:/^[A-Za-z .'-]+$/i"),
            'email'=>array("nullable","max:255","email",'unique:users,email,'.$id),
            'username'=>array("required","max:255",'unique:users,username,'.$id),
            'mobile'=>array("nullable","max:255"),
            'buseness_logo' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'business_name'=>array("required","max:255"),
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

        if ($request->hasFile('profile_photo')){
            $image = $request->profile_photo;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('profile_photo')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $profile_photo_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Profile Photo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Profile::updateOrCreate(['user_id'=>$id,'key'=>'profile_photo'],['value'=>$profile_photo_media->id]);
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
    public function merchantsDestroy ($id){
        //dd($id);
        User::destroy($id);
        Session::flash('success', 'User has been deleted.');
        return redirect()->back();
    }
    public function merchantsChangePassword ($id){
        $user = User::findOrFail($id);
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        return view('admin.merchant.changePassword', compact('body_class', 'wrapper_class', 'user'));
    }
    public function merchantsUpdatePassword (Request $request, $id){
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
    public function merchantsActive ($id){
        //dd($request);
        $user = User::findOrFail($id);
        $user->active = 1;
        $user->save();
        Session::flash('success', 'User has been activated.');
        return redirect()->back();
    }
    public function merchantsDeactive ($id){
        //dd($request);
        $user = User::findOrFail($id);
        $user->active = 0;
        $user->save();
        Session::flash('success', 'Password has been deactivated.');
        return redirect()->back();
    }


    public function drivers(Request $request){
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        $drivers = DB::table("users")->select('users.*', DB::raw('group_concat(case profiles.key when "address_line_1" then profiles.value end) as address_line_1'), DB::raw('group_concat(case profiles.key when "address_line_2" then profiles.value end) as address_line_2'), DB::raw('group_concat(case profiles.key when "business_name" then profiles.value end) as business_name'))->leftJoin("profiles", 'users.id', '=', 'profiles.user_id')->groupBy('users.id')->where('role','driver')->get()->toArray();
        if($request->ajax()) {
            return DataTables::of($drivers)
                ->addColumn('name', function($drivers){
                    $html = '<div class="text-name">'.$drivers->name.'</div>';
                    /*$html .= '<div class="action-buttons">';
                    $html .= '<a class="text-info" href="#">View</a> | <a class="text-info" href="'.route('admin.drivers.edit',['id'=>$drivers->id]).'">Edit</a>';
                    if ($drivers->active)
                        $html .= ' | <a class="text-warning" href="'.route('admin.drivers.deactive', ['id'=>$drivers->id]).'">Deactive</a>';
                    else
                        $html .= ' | <a class="text-warning" href="'.route('admin.drivers.active', ['id'=>$drivers->id]).'">Active</a>';
                    $html .= ' | <form class="d-inline" method="POST" action="'.route('admin.drivers.destroy', ['id'=>$drivers->id]).'">'.csrf_field().method_field('DELETE').'<button class="btn-link text-danger delete-user" type="submit">Delete</button></form> |  <a class="text-danger" href="'.route('admin.drivers.changepassword', ['id'=>$drivers->id]).'">Change Password</a>';
                    $html .= '<div>';*/
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
        return view('admin.driver.index', compact('body_class', 'wrapper_class', 'drivers'));
    }
    public function driversRegister(){
        $body_class = $this->body_class;
        $wrapper_class = $this->wrapper_class;
        return view('admin.driver.register', compact('body_class', 'wrapper_class'));
    }

}
