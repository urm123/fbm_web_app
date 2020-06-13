<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $permission;
    protected $role;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository, UserRepository $user_repository)
    {
        $this->permission = $permissionRepository;
        $this->role = $roleRepository;
        $this->user = $user_repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $persmissions = $this->permission->all();
        return view('page.admin.permission.index', ['permissions' => $persmissions]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $menus = $this->user->getMenus(5, 1, 0);
        return view('page.admin.permission.create', ['menuItems' => $menus]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $result = $this->permission->getOne($request->name);
        if (!$result->isEmpty()) {
            $menus = $this->user->getMenus(5, 1, 0);
            return view('page.admin.permission.create', ['menuItems' => $menus]);
        }else {
            $permission = $this->permission->insert($request->all());
            if ($permission) {
                return redirect(route('admin.permission.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $roles = $this->role->all();
        $menus = $this->user->getMenus(5, 1, 0);
        return view('page.admin.permission.edit', [
            'menuItems' => $menus,
            'permission' => $permission,
            'roles' => $roles
        ]);
    }

    /**
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, ['name' => 'required']);
        $update = $permission->update($request->all());
        $roles = $request->roles;

        $permission->roles()->detach();

        foreach ($roles as $role) {
            $permission->roles()->attach($role);
        }

        if ($update) {
            return redirect(route('admin.permission.index'));
        }
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $delete = $permission->delete();
        if ($delete) {
            return response()->json(['message' => 'success']);
        }
    }
}
