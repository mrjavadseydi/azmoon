<?php

namespace MrjavadSeydi\AdminLTE\http\controller;
use MrjavadSeydi\AdminLTE\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = new User();
        $users = $this->filterUser($request,$users)->get();
        return sview("user.index",compact('users'));
    }

    public function filterUser(Request $request ,$users){
        if ($request->has('name')&&!empty($request->name)) {
            $users = $users->where('firstname' ,'like' ,"%".$request->name."%")->orWhere('lastname' ,'like' ,"%".$request->name."%");
        }
        if ($request->has('mobile')&&!empty($request->mobile)) {
            $users = $users->where('mobile' ,'like' ,"%".$request->mobile."%");
        }
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return sview('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->super_admin)
            abort(403);

        if (isset($request->password)) {
            $password = bcrypt($request->password);
            $user->update([
                'password'=>$password
            ]);
        }
        $user->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'mobile'=>$request->mobile,
            'phone_verify'=>$request->phone_verify,
        ]);
        return back()->with('success',"ویرایش اطلاعات کاربر با موفقیت انجام شد");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        if ($user->super_admin||$user->id == \Auth::id())
            abort(403);

        $user->delete();
    }
    public function permissionList ($id) {
        $user = User::whereId($id)->first();
        return sview('user.permission' , compact('user'));
    }
    public function permissionStore (Request $request) {
        $data = $request->validate([
            'permissions' => ['required', 'array'],
            'roles' => ['required', 'array'],
        ]);
        $user = User::whereId($request->id)->first();
        $user->permissions()->sync($data['permissions']);
        $user->roles()->sync($data['roles']);
        return back()->with('success',"ویرایش اطلاعات کاربر با موفقیت انجام شد");
    }
}
