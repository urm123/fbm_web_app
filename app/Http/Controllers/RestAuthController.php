<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/6/2018
 * Time: 3:14 PM
 */

namespace App\Http\Controllers;


use App\Repositories\RestUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RestAuthController
 * @package App\Http\Controllers
 */
class RestAuthController
{

    protected $user;

    /**
     * RestAuthController constructor.
     * @param RestUserRepository $rest_user_repository
     */
    function __construct(RestUserRepository $rest_user_repository)
    {
        $this->user = $rest_user_repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $login_status = $this->user->getUserStatus(Auth::id());

        if ($request->user()->role == 'CLEANER' || $request->user()->role == 'SUBCONTRACTOR') {
            $cleaner = $this->user->getCleaner(Auth::id());
            $user = $cleaner;
        } else if ($request->user()->role == 'INSPECTOR_1' || $request->user()->role == 'INSPECTOR_2') {
            $inspector = $this->user->getInspector(Auth::id());
            $user = $inspector;
        }

//        if ($request->user()->role == 'SUBCONTRACTOR') {
//            $request->user()->role == 'CLEANER';
//        }

        $user->image = config('STORAGE_URL') . $user->image;

        $user->email = $request->user()->email;
        $user->role = $request->user()->role;

        if ($user->role == 'INSPECTOR_1' || $user->role == 'INSPECTOR_2') {
            $user->role = 'INSPECTOR';
        }


        $user->status = $request->user()->status;

        if ($user->last_name == null) {
            $user->last_name = ' ';
        }

        if ($login_status > 1) {
            return response()->json(['logged_in' => true, 'user' => $user]);
        } else {
            return response()->json(['logged_in' => false, 'user' => $user]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserDetails(Request $request)
    {
        $user_id = Auth::id();

        $user = $this->user->getUser($user_id);

        if ($user->role == "CLEANER") {
            $target_user = $this->user->getCleaner($user_id);
            $target_user->image = config('STORAGE_URL') . $target_user->image;
        } else if ($user->role == 'INSPECTOR_1' || $user->role == 'INSPECTOR_2') {
            $target_user = $this->user->getInspector($user_id);
            $target_user->image = config('STORAGE_URL') . $target_user->image;
        } else {
            $target_user = ['message' => 'No user found!'];
        }

        return response()->json(['user' => $target_user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserDetails(Request $request)
    {
        $user_id = Auth::id();
        $user = $this->user->getUser($user_id);

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $telephone = $request->telephone;
        $mobile = $request->mobile;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $image = $request->image;

        $user_role = $user->role;

        if ($user->role == "CLEANER") {
            if (isset($request->image)) {
                $image_file = $request->image;
                $image = $image_file->store('cleaners');
            } else {
                $image = '';
            }

            $update_cleaner = $this->user->updateCleaner($user_id, $first_name, $last_name, $telephone, $mobile, $street_number, $street_name, $city, $postal_code, $image);
            $user = $this->user->getCleaner($user_id);
        } else if ($user->role == 'INSPECTOR_1' || $user->role == 'INSPECTOR_2') {
            if (isset($request->image)) {
                $image_file = $request->image;
                $image = $image_file->store('inspectors');
            } else {
                $image = '';
            }

            $update_inspector = $this->user->updateInspector($user_id, $first_name, $last_name, $telephone, $mobile, $street_number, $street_name, $city, $postal_code, $image);
            $user = $this->user->getInspector($user_id);
        }

        $user->role = $user_role;

        $username = str_replace(' ', '', $first_name . $last_name);

        $update_username = $this->user->updateUserName($user_id, $username);

        return response()->json(['status' => 'success', 'message' => 'User updated successfully', 'user' => $user]);
    }
}