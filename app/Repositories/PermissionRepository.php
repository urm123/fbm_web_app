<?php
namespace App\Repositories;
use App\Permission;

/**
 * Class PermissionRepository
 * @package App\Repositories
 */
class PermissionRepository
{
    /**
     * @return Permission[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Permission::all();
    }

    /**
     * @param $param
     * @return Permission[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getOne($param = '')
    {
        return Permission::where('name', '=', $param)->get();
    }

    /**
     * @param array $request
     * @return Permission
     */
    public function insert(array $request)
    {
        $permission = new Permission($request);
        $permission->save();
        return $permission;
    }
}