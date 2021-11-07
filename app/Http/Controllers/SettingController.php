<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Setting;
use App\Models\Media;
use Session;

class SettingController extends Controller
{
    public function adminSettingsGeneral(){
        $settings = Setting::where('key', 'company_name')
                            ->orWhere('key', 'company_logo')
                            ->orWhere('key', 'company_favicon')
                            ->get();
        return view('admin.settings.general', compact('settings'));
    }
    public function adminSettingsGeneralUpdate(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'company_logo' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'company_favicon' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
            'company_name'=>array("required","max:255","regex:/^[A-Za-z0-9 .'-]+$/i"),
        ]);
        Setting::updateOrCreate(['key'=>'company_name'],['value'=>$request->company_name]);
        if ($request->hasFile('company_logo')){
            $image = $request->company_logo;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('company_logo')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $company_logo_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Company Logo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Setting::updateOrCreate(['key'=>'company_logo'],['value'=>$company_logo_media->id]);
        }
        if ($request->hasFile('company_favicon')){
            $image = $request->company_favicon;
            $explode = explode('.',$image->getClientOriginalName());
            $name = time().rand(0,999999).strtolower(preg_replace('/\s+/', '-', $explode[0]));
            $image_new_name = $name.'.'.end($explode);
            $type = $request->file('company_favicon')->getMimeType();
            $image->move('uploads',$image_new_name);
            // $post->image =  'uploads/posts/'.$image_new_name;
            $company_favicon_media = Media::create([
                'user_id' => Auth::id(),
                'title' => Auth::user()->name . ' Company Logo',
                'slug' => $name,
                'url' =>'uploads/'.$image_new_name,
                'type' => $type,
            ]);
            Setting::updateOrCreate(['key'=>'company_favicon'],['value'=>$company_favicon_media->id]);
        }
        Session::flash('success', 'Settings has been updated.');
        return redirect()->back();
    }
    public function adminBranches(){
        $branches = Setting::where('key', 'branches')->get();
        return view('admin.branch.index', compact('branches'));

    }
    public function adminBranchesCreate(){
        return view('admin.branch.create');
    }
}
