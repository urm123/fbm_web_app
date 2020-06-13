<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/6/2018
 * Time: 12:01 PM
 */

namespace App\Http\Controllers;


use App\Repositories\RestUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class RestInspectorAuthController
 * @package App\Http\Controllers
 */
class RestInspectorAuthController extends Controller
{
    protected $user;

    /**
     * RestInspectorAuthController constructor.
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
    public function postResetPassword(Request $request)
    {
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $get_password = $this->user->getUser(Auth::id());

        if (Hash::check($old_password, $get_password->password)) {
            $update_password = $this->user->updateUserPassword(Auth::id(), bcrypt($new_password));
            if ($update_password) {
                return response()->json(['message' => 'Password updated successfully!']);
            }
        } else {
            return response()->json(['message' => 'Old password is incorrect!'], 400);
        }
    }
}