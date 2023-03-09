<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupsRequest;
use App\Http\Requests\UpdateGroupsRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Group::class);

        $groups = Group::search()->paginate(4);;
        $users= User::get();
        $param = [
            'groups' => $groups,
            'users' => $users
        ];
        return view('admin.groups.index', $param );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Group::class);

        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupsRequest $request)
    {
        try {
            alert()->success('Tạo nhóm quyền' , 'Thành công');
        $group=new Group();
        $group->name=$request->name;
        $group->save();
        return redirect()->route('group.index');
    } catch (\Throwable $th) {
        alert()->error('Tạo nhóm quyền','Thất bại');
        return redirect()->route('group.index');

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
        $this->authorize('update',Group::class);

        $group = Group::find($id);
        return view('admin.groups.edit', compact('group') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupsRequest $request, $id)
    {
        try {
            alert()->success('Sửa nhóm quyền' , 'Thành công');
        $group = Group::find($id);
        $group->name = $request->name;
        $group->save();

        return redirect()->route('group.index');
    } catch (\Throwable $th) {
        alert()->error('Sửa nhóm quyền','Thất bại');
        return redirect()->route('group.index');

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
        $group = Group::find($id);
        $group->delete();

    }
    public function detail($id)
    {
        $group=Group::find($id);

        $current_user = Auth::user();
        $userRoles = $group->roles->pluck('id', 'name')->toArray();
        // dd($userRoles);
        $roles = Role::all()->toArray();
        $group_names = [];
        /////lấy tên nhóm quyền
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }
        $params = [
            'group' => $group,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'group_names' => $group_names,
        ];
        return view('admin.groups.detail',$params);
    }
    public function group_detail(Request $request,$id)
    {
        try {
        alert()->success('Trao quyền' , 'Thành công');
        $group= Group::find($id);
        $group->roles()->detach();
        $group->roles()->attach($request->roles);
        return redirect()->route('group.index');
    } catch (\Throwable $th) {
        alert()->error('Trao quyền','Thất bại');
        return redirect()->route('group.index');

    }

    }
}
