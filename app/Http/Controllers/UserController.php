<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data= User::get();
        $data= User::paginate(3);
        return view("show", compact(["data"]));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('createAccount');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        $request->validate([
            //there are two ways one is to use '|' and the second is ["",""]
            "name" => 'required|min:3|max:20',
            "email" => ["required", "email","unique:users"],
            // "userfile"=> ["required", "mimes:jpeg,png,jpg", "max:10000"],
            "password" => ["required", "min:6", "confirmed"],
            "password_confirmation" => 'required|min:6'
        ], [
            "name.required" => "Please enter a name",
            "name.min" => "your name should be atleast 5 characters",
            "name.max" => "your name cannot be more then 10 characters",
            "email.unique"=>"email already exsist",
        ]);
        $fileName=null;

        // if($request->hasFile("userfile")){
        //     $fileName=time().rand(1,10000)."userfile.".$request->file("userfile")->extension();
        //     $request->file("userfile")->storeAs("uploads",$fileName,"public");
        // }

        $result = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            // "file"=>$fileName
        ]);
        if($result){
            Mail::to($request->email)->send(new Register(["name"=>$request->name,
            "email"=>$request->email]));
            return redirect()->route('users.index')->with("success", "account create successfully.");
        }else{
            return redirect()->route('users.index')->with("success", "please try again later.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $data= User::where("id",$id)->get();
        $data= User::find($id); //you can not get value if the primary key name is other then id, and it dosenot find anything other then id.
        return view("showUser", compact(["data"]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $userData= User::find($id);
        return view("useredit", compact(["userData"]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => 'required|min:3|max:20',
            "email" => ["required", "email", Rule::unique("users")->ignore($id)]
        ], [
            "name.required" => "Please enter a name",
            "name.min" => "your name should be atleast 5 characters",
            "name.max" => "your name cannot be more then 10 characters",
            "email.unique"=>"email already exsist"
        ]);
        $record = User::findOrFail($id);

        $record->update([
            "name" =>$request->name,
            "email" =>$request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Record updated successfully at : '."id $record->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = User::where("id",$id)->delete();
        if($result){
            return redirect()->back()->with("success", "Successfully deleted.");
        }else{
            return redirect()->back()->with("success", "Eror!! Plsease tryagain later.");
        }
    }
}
