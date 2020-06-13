<?php


namespace App\Repositories;


use App\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class RoleRepository
{
    /**
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Role::all();
    }

    /**
     * @param array $request
     * @return Role
     */
    public function insert(array $request)
    {
        $role = new Role($request);
        $role->save();
        return $role;
    }
}