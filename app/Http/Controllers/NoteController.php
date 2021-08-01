<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use DataTables;
use Session;
use DB;

class NoteController extends Controller
{
    public function adminNoteIndex(Request $request){
        //$merchants = DB::table("users")->select('users.*', DB::raw('group_concat(case profiles.key when "address_line_1" then profiles.value end) as address_line_1'), DB::raw('group_concat(case profiles.key when "address_line_2" then profiles.value end) as address_line_2'), DB::raw('group_concat(case profiles.key when "business_name" then profiles.value end) as business_name'))->leftJoin("profiles", 'users.id', '=', 'profiles.user_id')->groupBy('users.id')->where('role','merchant')->get()->toArray();
        $notes = Note::all();
        if($request->ajax()) {
            return DataTables::of($notes)
                ->addColumn('user_id', function($data){
                    return $data->user->name;
                })
                ->addColumn('created_at', function($data){
                    return '<div class="text-right">'.$data->created_at.'</div>';
                })
                ->rawColumns(['created_at'])
//                ->make(true);
                ->toJson();
        }
        return view('admin.notice.index');
    }
    public function adminNoteCreate(){
        $merchants = User::where('role','merchant')->get();
        $drivers = User::where('role','driver')->get();
        return view('admin.notice.create',compact('merchants','drivers'));
    }
    public function adminNoteStore(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'title'=>array("required","max:255","regex:/^[A-Za-z0-9 .'-]+$/i"),
            'to'=>array("required"),
            'media' => array("nullable","image","max:2000"), //ratio=3/2,width=125, height=125 "dimensions:ratio=1",
        ]);
        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->editor,
        ]);
        foreach ($request->to as $receiver){
            DB::table('note_user')->insert([
                ['user_id' => $receiver, 'note_id' => $note->id, 'read' => 0],
            ]);
        }
        Session::flash('success', 'Notiece has been created.');
        return redirect()->back();
    }
}
