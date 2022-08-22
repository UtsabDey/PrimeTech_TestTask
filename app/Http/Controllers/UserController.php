<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users'] = User::all();
        return view('userlist',$data)->with('index', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'uname' => 'required|string|unique:users,uname',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:confirm_password|max:100',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($user) {
            return redirect()->route('users.index')->with('success', 'User Added Successfully!');
        }
        return redirect()->route('users.index')->with('error', 'Failed to Create User!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('profile', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'uname' => 'required|string|unique:users,uname,' .$id,
            'dob' => 'nullable',
            'email' => 'required|unique:users,email,' .$id,
            'address' => 'nullable|string',
            'image' => 'nullable',
            'nid' => 'nullable|numeric|digits_between:10,17|unique:users,nid,' .$id,
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->uname = $request->uname;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->nid = $request->nid;

        if ($request->hasFile('image')) {

            $destination = 'images/profile/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $photo = $request->file('image');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('images/profile', $photo_name);
            $user->image = $photo_name;
        }

        if ($user->isDirty()) {
            $user->update();
            return redirect()->route('users.show',$id)->with('success', 'User Updated Successfully!');
        }
        return redirect()->route('users.show', $id)->with('error', 'Nothing Changed!');
    }

    public function updatepass(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|same:confirm_password',
        ]);

        if($validate->fails()){ return back()->withErrors($validate)->withInput(); }

        $user = User::find($id);
        if (Hash::check($request->oldpassword, $user->password)) {
            if (!Hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('users.show', $id)->with('success', 'Password changed successfully!');
            } else {
                return back()->with('error', 'New password can not be the old password!');
            }
        } else {
            return back()->with('error', 'Old password doesn\'t matched');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('warning', 'User Deleted Successfully');
    }
}
