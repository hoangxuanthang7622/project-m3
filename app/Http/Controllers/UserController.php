<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        $param = [
            'users' => $users,
        ];
        return view('admin.users.index', $param);
    }
    public function showAdmin(){

        $admins = User::get();
        $param = [
            'admins' => $admins,
        ];
        return view('admin.users.admin', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $groups = Group::get();
        $param = [
            'groups' => $groups,
        ];
        return view('admin.users.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        try {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->group_id = $request->group_id;
        // $file = $request->image;
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $path = 'public/assets/images/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $user->image = $new_image;
            $data['user_image'] = $new_image;
        }
        $user->save();

        $data = [
            'name' => $request->name,
            'pass' => $request->password,
        ];


        alert()->success('????ng k?? nh??n vi??n' , 'Th??nh c??ng');
        return redirect()->route('user.index');
    } catch (\Exception $e) {
        Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());

        alert()->error('????ng k?? nh??n vi??n','Th???t b???i');
        return redirect()->route('user.index');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize('view', User::class);
        $user = User::findOrFail($id);
        $param =[
            'user'=>$user,
        ];


        // $productshow-> show();
        return view('admin.users.profile',  $param );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('view', User::class);
        $user = User::find($id);
        $groups=Group::get();
        $param = [
            'user' => $user ,
            'groups' => $groups
        ];
        return view('admin.users.edit' , $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        try {
            alert()->success('Ch???nh s???a' , 'Th??nh c??ng');
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->group_id = $request->group_id;
        $file = $request->image;
        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $path = 'public/assets/images/user/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $user->image = $new_image;
            $data['user_image'] = $new_image;
        }
        $user->save();

        return redirect()->route('user.index');
    } catch (\Throwable $th) {
        alert()->error('Ch???nh s???a','Th???t b???i');
        return redirect()->route('user.index');

    }
    }
     // hi???n th??? form ?????i m???t kh???u
     public function editpass($id){
        $this->authorize('view', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('admin.users.editpass', $param);
    }

     // hi???n th??? form ?????i m???t kh???u
     public function adminpass($id){
        $this->authorize('adminUpdatePass', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('admin.users.adminpass', $param);
    }
     // ch??? c?? superAdmin m???i c?? quy???n ?????i m???t kh???u ng?????i kh
     public function adminUpdatePass(Request $request, $id){
        $this->authorize('adminUpdatePass', User::class);
        $user = User::find($id);
        if($request->renewpassword==$request->newpassword)
        {
            $item = User::find($id);
            $item->password= bcrypt($request->newpassword);
            $item->save();
            $notification = [
                'message' => '?????i m???t kh???u th??nh c??ng!',
                'alert-type' => 'success'
            ];
            return redirect()->route('user.index')->with($notification);

        }else{
            $notification = [
                'sainhap' => 'B???n nh???p m???t kh???u kh??ng tr??ng kh???p!',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }
    }
    public function updatepass(Request $request)
    {
        if($request->renewpassword==$request->newpassword)
        {
            if ((Hash::check($request->password, Auth::user()->password))) {
                $item=User::find(Auth()->user()->id);
                $item->password= bcrypt($request->newpassword);
                $item->save();
                $notification = [
                    'message' => '?????i m???t kh???u th??nh c??ng!',
                    'alert-type' => 'success'
                ];
                return redirect()->route('user.index')->with($notification);
            }else{

                $notification = [
                    'saipass' => '!',

                ];
                return back()->with($notification);
            }
        }else{
            $notification = [
                'sainhap' => '!',
            ];
            return back()->with($notification);
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

        $this->authorize('forceDelete', Product::class);
        try {
            alert()->success('Xo?? nh??n vi??n' , 'Th??nh c??ng');
        $user = User::find($id);
            $user->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Xo?? nh??n vi??n','Th???t b???i');
            return redirect()->back();

        }
    }
    public function viewLogin()
    {

        return view('auth.login');
    }
     //x??? l?? ????ng nh???p
  public function login(Request $request){
    $validated = $request->validate([
        'email' => 'required',
        'password'=>'required|min:6',
    ],
        [
            'email.required'=>'Kh??ng ???????c ????? tr???ng',
            'password.required'=>'Kh??ng ???????c ????? tr???ng',
            'password.min'=>'L???n h??n :min',
        ]
);

      $credentials = $request->validate([
          'email' => ['required', 'email'],
          'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {

          $request->session()->regenerate();

          return redirect()->route('home');
      }
      // dd($request->all());
      return back()->withErrors([
          'email' => 'Th??ng tin ????ng nh???p ???????c cung c???p kh??ng kh???p v???i h??? s?? c???a ch??ng t??i.',
      ])->onlyInput('email');
  }
  public function logout(Request $request)
  {
    //   dd(12);
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
  }
}
