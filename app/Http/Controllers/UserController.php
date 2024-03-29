<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
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


        alert()->success('Đăng kí nhân viên' , 'Thành công');
        return redirect()->route('user.index');
    } catch (\Exception $e) {
        Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());

        alert()->error('Đăng kí nhân viên','Thất bại');
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
            alert()->success('Chỉnh sửa' , 'Thành công');
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
        alert()->error('Chỉnh sửa','Thất bại');
        return redirect()->route('user.index');

    }
    }
     // hiển thị form đổi mật khẩu
     public function editpass($id){
        $this->authorize('view', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('admin.users.editpass', $param);
    }

     // hiển thị form đổi mật khẩu
     public function adminpass($id){
        $this->authorize('adminUpdatePass', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('admin.users.adminpass', $param);
    }
     // chỉ có superAdmin mới có quyền đổi mật khẩu người kh
     public function adminUpdatePass(Request $request, $id){
        $this->authorize('adminUpdatePass', User::class);
        $user = User::find($id);
        if($request->renewpassword==$request->newpassword)
        {
            $item = User::find($id);
            $item->password= bcrypt($request->newpassword);
            $item->save();
            $notification = [
                'message' => 'Đổi mật khẩu thành công!',
                'alert-type' => 'success'
            ];
            return redirect()->route('user.index')->with($notification);

        }else{
            $notification = [
                'sainhap' => 'Bạn nhập mật khẩu không trùng khớp!',
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
                    'message' => 'Đổi mật khẩu thành công!',
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
            alert()->success('Xoá nhân viên' , 'Thành công');
        $user = User::find($id);
            $user->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Xoá nhân viên','Thất bại');
            return redirect()->back();

        }
    }
    public function viewLogin()
    {

        return view('auth.login');
    }
     //xử lí đăng nhập
  public function login(Request $request){
    $validated = $request->validate([
        'email' => 'required',
        'password'=>'required|min:6',
    ],
        [
            'email.required'=>'Không được để trống',
            'password.required'=>'Không được để trống',
            'password.min'=>'Lớn hơn :min',
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
          'email' => 'Thông tin đăng nhập được cung cấp không khớp với hồ sơ của chúng tôi.',
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
  public function forgetpass()
  {
      return view('auth.forgetpass');
  }
  public function quenmatkhauadmin(Request $request)
  {
      $customer = User::where('email', $request->email)->first();
      if ($customer) {
          $pass = Str::random(6);
          $customer->password = bcrypt($pass);
          $customer->save();
          $data = [
              'name' => $customer->name,
              'pass' => $pass,
              'email' => $customer->email,
          ];
          Mail::send('admin.emails.password', compact('data'), function ($email) use ($customer) {
              $email->subject('Xmen-Store');
              $email->to($customer->email, $customer->name);
          });
      }
      return redirect()->route('login');
  }
}
