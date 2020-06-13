<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RoleRepository;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->role = $roleRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->role->all();
        return view('page.admin.role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('page.admin.role.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = $this->role->insert($request->all());

        if ($role) {
            return redirect(route('admin.role.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        return view('page.admin.role.edit', ['role' => $role]);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, ['name' => 'required']);
        $update = $role->update($request->all());
        if ($update) {
            return redirect(route('admin.role.index'));
        }
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $delete = $role->delete();
        if ($delete) {
            return response()->json([
                'message' => 'success'
            ]);
        }
    }
}
