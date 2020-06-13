<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/27/2017
 * Time: 2:28 PM
 */

namespace App\Http\Controllers;


use App\Mail\UserRegister;
use App\Repositories\AlertRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Repositories\ChecklistRepository;
use App\Rules\Mobile;
use App\Rules\Name;
use App\Rules\Telephone;
use App\Support\Push;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function foo\func;
use Datatables;
use DB;
use App\Category;

/**
 * Class WebAdminController
 * @package App\Http\Controllers
 */
class WebAdminController extends Controller
{
    protected $user;
    protected $task;
    protected $alert;
    protected $category;
    protected $push;
    protected $checklist;

    /**
     * WebAdminController constructor.
     * @param UserRepository $user_repository
     * @param TaskRepository $task_repository
     * @param AlertRepository $alert_repository
     * @param CategoryRepository $category_repository
     * @param ChecklistRepository $checklist_repository
     * @param Push $push
     */
    function __construct(ChecklistRepository $checklist_repository, UserRepository $user_repository, TaskRepository $task_repository, AlertRepository $alert_repository, CategoryRepository $category_repository, Push $push)
    {
        $this->user = $user_repository;
        $this->task = $task_repository;
        $this->alert = $alert_repository;
        $this->category = $category_repository;
        $this->checklist = $checklist_repository;
        $this->push = $push;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function administrators($redirect = 0)
    { 
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Administrators</a>";
        $current_administrator = $this->user->getAdministratorByUser(Auth::id());
        $administrators = $this->user->getAdministrators($current_administrator->level);
        $administrators_details = $this->user->getAdministratorDetails();
        return view('page.admin.administrators', ['administrators' => $administrators, 'administrator_details' => $administrators_details, 'administrator_id' => $redirect, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdmins()
    { 
        $current_administrator = $this->user->getAdministratorByUser(Auth::id());
        $administrators = $this->user->getAdministrators($current_administrator->level);
        $administrators_details = $this->user->getAdministratorDetails();
        return $administrators = Datatables::of($administrators)->make(true);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdmin(Request $request)
    {
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Administrators</a> / <a href='/admin/adminDetails/".$request->user_id."'>Administrator Info</a>";
        $user_id = $request->user_id;
        $current_administrator = $this->user->getAdministratorByUser($user_id);
        return view('page.admin.admin-details', ['administrator_details' => $current_administrator, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewAdministrator()
    {
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Administrators</a> / <a href='/admin/administrators/add-new'>Add New Administrator</a>";
        return view('page.admin.add-new-administrator', ['breadcrumb' => $breadcrumb]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewAdministrator(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'last_name' => ['max:255|min:3', new Name],
            'street_number' => 'max:20|string',
            'street_name' => 'max:255|string',
            'city' => ['max:255|min:3', new Name],
            'post_code' => 'max:20|string',
            'email' => 'max:255|email|unique:users',
            //'telephone' => new Telephone,
            //'mobile' => new Telephone,
            'agreement_start' => 'max:255|date',
        ], $messages);

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $street_number = $request->street_number;
        $street_name = $request->first_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $email = $request->email;
        $telephone = $request->telephone;
        $mobile = $request->mobile;
        $level = $request->level;
        $user_type = $request->user;
        $agreement_start = $request->agreement_start;
        $username = str_replace(' ', '_', $first_name);
        $initial_password = str_random(6);
        $password = bcrypt($initial_password);

        $result = $this->user->addNewAdministrator($username, $password, $email, $first_name, $last_name, $street_number, $street_name, $city, $postal_code, $telephone, $mobile, $agreement_start, $level, $initial_password, $user_type);

        if ($result) {
            //Mail::to($email)->send(new UserRegister(['type' => 'Administrator', 'password' => $initial_password]));
            return redirect('/admin/administrators/add-new')->with(['success' => 'Saved successfully']);
        }

    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cleaners($redirect = 0)
    {
        $cleaners = $this->user->getCleaners();
        foreach ($cleaners as $cleaner) {
            $cleaner->encoded = encrypt($cleaner->id);
            $cleaner->tasks = $this->user->getCleanerTaskDetails($cleaner->id);
            if ($cleaner->type) {
                $cleaner->type = 'Cleaner';
            } else {
                $cleaner->type = 'Sub Contractor';
            }

            $cleaner->name = $cleaner->first_name . ' ' . $cleaner->last_name;
            $username = $this->user->getUsername($cleaner->user_id);
            if($username['username']) {
                $username = $username->username;
                $cleaner->username = $username;
            }
            $cleaner->start_date = Carbon::parse($cleaner->start_date)->toFormattedDateString();
            $cleaner->file = false;
            if ($cleaner->image) {
                $cleaner->file = true;
            } 
            $cleaner->image = config('STORAGE_URL') . $cleaner->image;
        }

        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/cleaners'>Cleaners</a>";
        return view('page.admin.cleaners', ['allcleaners' => $cleaners, 'cleaner_id' => $redirect, 'breadcrumb' => $breadcrumb]);
        //return view('page.admin.cleaners');
    }

    public function getCleaners($redirect = 0)
    {
        $cleaners = $this->user->getCleaners();
        foreach ($cleaners as $cleaner) {
            $cleaner->encoded = encrypt($cleaner->id);
            $cleaner->tasks = $this->user->getCleanerTaskDetails($cleaner->id);
            if ($cleaner->type) {
                $cleaner->type = 'Cleaner';
            } else {
                $cleaner->type = 'Sub Contractor';
            }

            $cleaner->name = $cleaner->first_name . ' ' . $cleaner->last_name;
            $username = $this->user->getUsername($cleaner->user_id);
            //$cleaner->username = $username->username;
            $cleaner->start_date = Carbon::parse($cleaner->start_date)->toFormattedDateString();
            $cleaner->file = false;

            if ($cleaner->image) {
                $cleaner->file = true;
            }

            $cleaner->image = config('STORAGE_URL') . $cleaner->image;
        }
        return $cleaners = Datatables::of($cleaners)->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cleanersLoginDetails()
    {
        $cleaners_login_details = $this->user->getCleanersLoginDetails();
        foreach ($cleaners_login_details as $cleaners_login_detail) {
            $cleaners_login_detail->start_datetime = Carbon::parse($cleaners_login_detail->start_time)->format('Y-m-d');
            $cleaners_login_detail->end_datetime = Carbon::parse($cleaners_login_detail->end_time)->format('Y-m-d');
            $cleaners_login_detail->login = Carbon::parse($cleaners_login_detail->login)->format('Y-m-d g:i A');
            if ($cleaners_login_detail->logout) {
                $cleaners_login_detail->logout = Carbon::parse($cleaners_login_detail->logout)->format('Y-m-d g:i A');
            } else {
//                $cleaners_login_detail->logout = 'Absent';
            }

            if ($cleaners_login_detail->repeat == 1) {
                $cleaners_login_detail->start_time = Carbon::parse($cleaners_login_detail->start_time)->format('g:i A');
                $cleaners_login_detail->end_time = Carbon::parse($cleaners_login_detail->end_time)->format('g:i A');
            } else {
                $cleaners_login_detail->start_time = Carbon::parse($cleaners_login_detail->start_time)->format('Y-m-d g:i A');
                $cleaners_login_detail->end_time = Carbon::parse($cleaners_login_detail->end_time)->format('Y-m-d g:i A');
            }
        }
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/cleaners'>Cleaners</a> / <a href='/admin/cleaners/login-details'>Login Details</a>";   
        return view('page.admin.cleaners-login-details', ['cleaners' => $cleaners_login_details, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cleanerDetails(Request $request)
    {
        $cleaner_id = $request->cleaner_id;  
        $cleaners = $this->user->getCleaners();
        foreach ($cleaners as $cleaner) {
            $cleaner->encoded = encrypt($cleaner->id);
            $cleaner->tasks = $this->user->getCleanerTaskDetails($cleaner->id);
            if ($cleaner->type) {
                $cleaner->type = 'Cleaner';
            } else {
                $cleaner->type = 'Sub Contractor';
            }

            $cleaner->name = $cleaner->first_name . ' ' . $cleaner->last_name;
            $username = $this->user->getUsername($cleaner->user_id);
            if($username['username']) {
                $username = $username->username;
                $cleaner->username = $username;
            }
            $cleaner->start_date = Carbon::parse($cleaner->start_date)->toFormattedDateString();
            $cleaner->file = false;
            if ($cleaner->image) {
                $cleaner->file = true;
            } 
            $cleaner->image = config('STORAGE_URL') . $cleaner->image;
        }

        $cleaner_log_details = $this->user->getCleanerDetails($cleaner_id);
        $cleaner_client_details = $this->user->getCleanerClients($cleaner_id);
        $cleaner_details = $this->user->getCleaner($cleaner_id);
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/cleaners'>Cleaners</a> / <a href='/admin/cleaners/".$cleaner_id."/cleaner'>Cleaners Details</a>"; 
        return view('page.admin.cleaners-data', ['cleaner_id' => $cleaner_details->user_id, 'cleanerInfo' => $cleaners, 'cleanerLogs' => $cleaner_log_details, 'cleanerClients' => $cleaner_client_details, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cleanerTimes(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->from_date)){
                $data = $this->user->getCleanerTimes($request->from_date);
            }else{
                $data = DB::table('cleaner_times')
                    ->join('clients', 'cleaner_times.client_id', '=', 'clients.id')
                    ->join('cleaners', 'cleaners.id', '=', 'cleaner_times.cleaner_id')
                    ->whereRaw(DB::raw('cleaners.deleted_at IS NULL'))
                    ->get([
                        'cleaner_times.id as id',
                        'clients.id as client_id',
                        'cleaners.first_name',
                        'cleaners.last_name',
                        'clients.name AS client_first_name',
                        'cleaner_times.work_days',
                        'cleaner_times.work_date',
                        'cleaner_times.time',
                        'cleaner_times.mobile',
                        'cleaner_times.telephone',
                        'cleaner_times.number_of_people',
                        'cleaner_times.time_in',
                        'cleaner_times.time_out'
                    ]);
            }
            return datatables()->of($data)->make(true);
        }
        return view('page.admin.cleaner-times');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addCleanerTimes(Request $request)
    {
        $clients = $this->user->getClients();
        $cleaners = $this->user->getCleaners();
        return view('page.admin.add-cleaner-times', ['clients' => $clients, 'cleaners' => $cleaners]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewCleanerTime(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];
        $validator = Validator::make($request->all(), [
            'client' => 'required',
            'cleaner' => 'required',
            'start_time' => 'string|max:255|required',
            'end_time' => 'string|max:255|required',
            //'mobile' => new Telephone,
            'sign_in' => 'string|max:255|required',
            'sign_out' => 'string|max:255|required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
            $client = $request->client;
            $cleaner = $request->cleaner;
            $sub_client = $request->sub_client;
            $work_days = $request->work_days;
            $work_date = date("Y-m-d");
            $time = $request->start_time ." to ". $request->end_time;
            $mobile = $request->mobile;
            $telephone = $request->telephone;
            $people = $request->people;
            $sign_in = $request->sign_in;
            $sign_out = $request->sign_out;

            $result = $this->user->addNewCleanerTime($client, $cleaner, $sub_client, $work_days, $work_date, $time, $mobile, $telephone, $people, $sign_in, $sign_out);
            if ($result) {
                return response()->json(['message' => 'Success']);
            }
        }
    }

    public function inspectorsLoginDetails()
    {
        $inspectors_login_details = $this->user->getInspectorsLoginDetails();
        foreach ($inspectors_login_details as $inspectors_login_detail) {
            $inspectors_login_detail->start_datetime = Carbon::parse($inspectors_login_detail->start_time)->format('Y-m-d');
            $inspectors_login_detail->end_datetime = Carbon::parse($inspectors_login_detail->end_time)->format('Y-m-d');
            $inspectors_login_detail->login = Carbon::parse($inspectors_login_detail->login)->format('Y-m-d g:i A');
            if ($inspectors_login_detail->logout) {
                $inspectors_login_detail->logout = Carbon::parse($inspectors_login_detail->logout)->format('Y-m-d g:i A');
            } else {
//                $inspectors_login_detail->logout = 'Absent';
            }

            if ($inspectors_login_detail->repeat == 1) {
                $inspectors_login_detail->start_time = Carbon::parse($inspectors_login_detail->start_time)->format('g:i A');
                $inspectors_login_detail->end_time = Carbon::parse($inspectors_login_detail->end_time)->format('g:i A');
            } else {
                $inspectors_login_detail->start_time = Carbon::parse($inspectors_login_detail->start_time)->format('Y-m-d g:i A');
                $inspectors_login_detail->end_time = Carbon::parse($inspectors_login_detail->end_time)->format('Y-m-d g:i A');
            }
        }
        return view('page.admin.inspectors-login-details', ['inspectors' => $inspectors_login_details]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewCleaner()
    {
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/cleaners'>Cleaners</a> / <a href='/admin/cleaners/add-new'>Add Cleaner</a>";  
        return view('page.admin.add-new-cleaner', ['breadcrumb' => $breadcrumb]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateNewCleaner(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];


        if ($request->email != '') {
            $validator = Validator::make($request->all(), [
                'first_name' => ['max:255|min:3', new Name],
                'last_name' => ['max:255|min:3', new Name],
                'mobile' => new Mobile,
                'telephone' => new Telephone,
                'street_number' => 'string|max:255|required',
                'street_name' => 'string|max:255|required',
                'city' => ['max:255|required|min:3', new Name],
                'post_code' => 'string|max:255|required',
                'username' => 'string|max:255|required|unique:users',
                'start_date' => 'date|max:255|required',
                'email' => 'email|max:255|required|unique:users',
            ], $messages);
        } else {
            $validator = Validator::make($request->all(), [
                'first_name' => ['max:255|min:3', new Name],
                'last_name' => ['max:255|min:3', new Name],
                'mobile' => new Mobile,
                'telephone' => new Telephone,
                'street_number' => 'string|max:255|required',
                'street_name' => 'string|max:255|required',
                'city' => ['max:255|required|min:3', new Name],
                'post_code' => 'string|max:255|required',
                'username' => 'string|max:255|required|unique:users',
                'start_date' => 'date|max:255|required',
            ], $messages);
        }

        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewCleaner(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'last_name' => ['max:255|min:3', new Name],
            'mobile' => new Telephone,
            'telephone' => new Telephone,
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
//            'email' => 'email|max:255|required|unique:users',
            'start_date' => 'date|max:255|required',
            'username' => 'string|required|unique:users',
        ], $messages);

        if ($request->email != '') {
            $this->validate($request, [
                'email' => 'email|max:255|required|unique:users',
            ], $messages);
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mobile = $request->mobile;
        $telephone = $request->telephone;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $email = $request->email;
        $start_date = $request->start_date;
        $type = $request->type;
        $username = $request->username;

        if ($type == 'cleaner') {
            $type = true;
            $role = 'CLEANER';
        } elseif ($type == 'contractor') {
            $type = false;
            $role = 'SUBCONTRACTOR';
        }

        if (isset($request->docs)) {
            $docs = $request->docs;
            $upload = $docs->store('cleaners');
        } else {
            $upload = '';
        }

        $password = str_random(6);

        $result = $this->user->addNewCleaner($username, $password, $email, $first_name, $last_name, $street_number, $street_name, $city, $postal_code, $telephone, $mobile, $start_date, $type, $role, $upload);
        if ($result) {
            Mail::to($email)->send(new UserRegister(['type' => 'Cleaner', 'password' => $password]));

            return redirect('/admin/cleaners/add-new')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCleanerData(Request $request)
    {
        $cleaner_id = decrypt($request->encoded);
        $cleaner = $this->user->getCleaner($cleaner_id);

        $cleaner->encoded = encrypt($cleaner->id);
        $cleaner->tasks = $this->user->getCleanerTaskDetails($cleaner_id);
        if ($cleaner->type) {
            $cleaner->type = 'Cleaner';
        } else {
            $cleaner->type = 'Sub Contractor';
        }

        $cleaner->name = $cleaner->first_name . ' ' . $cleaner->last_name;
        $username = $this->user->getUsername($cleaner->user_id);
        $cleaner->username = $username->username;
        $cleaner->start_date = Carbon::parse($cleaner->start_date)->toFormattedDateString();
        $cleaner->file = false;

        if ($cleaner->image) {
            $cleaner->file = true;
        }
        $cleaner->image = config('STORAGE_URL') . $cleaner->image;
        dd($cleaner);


//        return view('page.admin.edit-cleaner', ['cleaner' => $cleaner]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCleaner(Request $request)
    {
        $cleaner_id = decrypt($request->encoded);
        $cleaner = $this->user->getCleaner($cleaner_id);
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/cleaners'>Cleaners</a> / <a href='/admin/cleaners/".$cleaner_id."/edit'>Edit Cleaner</a>";   
        return view('page.admin.edit-cleaner', ['cleaner' => $cleaner, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCleaner(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'mobile' => new Telephone,
            'telephone' => new Telephone,
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
            'email' => 'email|max:255|required',
            'start_date' => 'date|max:255|required',
            'password' => 'nullable|string|min:6',
        ], $messages);

        $cleaner_id = $request->cleaner_id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mobile = $request->mobile;
        $telephone = $request->telephone;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $email = $request->email;
        $start_date = $request->start_date;

        $cleaner = $this->user->getCleaner($cleaner_id);

        $password = false;

        if (isset($request->docs)) {
            $docs = $request->docs;
            $upload = $docs->store('cleaners');
        } else {
            $upload = '';
        }

        if ($request->password != '') {
            $password = bcrypt($request->password);
            $update_password = $this->user->updateUserPassword($cleaner->user_id, $password);
            $update_cleaner_password = $this->user->updateCleanerInitialPassword($cleaner_id, $request->password);
        }

        $result = $this->user->updateCleaner($cleaner->user_id, $cleaner_id, $email, $first_name, $last_name, $street_number, $street_name, $city, $postal_code, $telephone, $mobile, $start_date);

        if ($upload) {
            $this->user->updateCleanerImage($cleaner->id, $upload);
        }

        if ($result || $password) {
            return redirect('/admin/cleaners')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inspectors($redirect = 0)
    {
        $inspectors = $this->user->getInspectors();

        foreach ($inspectors as $inspector) {
            $inspector->encoded = encrypt($inspector->id);

            $inspector->tasks = $this->user->getInspectorTaskDetails($inspector->id);

            foreach ($inspector->tasks as $task) {
                if ($task->repeat) {
                    $task->display_time = Carbon::parse($task->start_time)->format('g:i A') . ' - ' . Carbon::parse($task->end_time)->format('g:i A');
                } else {
                    $task->display_time = Carbon::parse($task->start_time)->format('Y jS M g:i A') . ' - ' . Carbon::parse($task->end_time)->format('Y jS M g:i A');
                }
            }

            $username = $this->user->getUsername($inspector->user_id);

            $inspector->username = $username->username;

            $inspector->agreement_start = Carbon::parse($inspector->agreement_start)->toFormattedDateString();

            $inspector->file = false;

            if ($inspector->image) {
                $inspector->file = true;
            }

            $inspector->image = config('STORAGE_URL') . $inspector->image;

        }

        return view('page.admin.inspectors', ['inspectors' => $inspectors, 'inspector_id' => $redirect]);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInspectors($redirect = 0)
    {
        $inspectors = $this->user->getInspectors();

        foreach ($inspectors as $inspector) {
            $inspector->encoded = encrypt($inspector->id);
            $inspector->tasks = $this->user->getInspectorTaskDetails($inspector->id);

            foreach ($inspector->tasks as $task) {
                if ($task->repeat) {
                    $task->display_time = Carbon::parse($task->start_time)->format('g:i A') . ' - ' . Carbon::parse($task->end_time)->format('g:i A');
                } else {
                    $task->display_time = Carbon::parse($task->start_time)->format('Y jS M g:i A') . ' - ' . Carbon::parse($task->end_time)->format('Y jS M g:i A');
                }
            }

            $username = $this->user->getUsername($inspector->user_id);
            $inspector->username = $username->username;
            $inspector->name = $inspector->first_name . ' ' . $inspector->last_name;
            $inspector->address = $inspector->street_number . ', ' . $inspector->street_name . ', ' . $inspector->city . ', ' . $inspector->post_code;
            $inspector->agreement_start = Carbon::parse($inspector->agreement_start)->toFormattedDateString();
            $inspector->file = false;

            if ($inspector->image) {
                $inspector->file = true;
            }
            $inspector->image = config('STORAGE_URL') . $inspector->image;
        }
        return $inspectors = Datatables::of($inspectors)->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInspector(Request $request)
    {
        $inspector_id = $request->inspector_id;
        $inspector = $this->user->getInspectorFromId($inspector_id);
        $inspector->tasks = $this->user->getInspectorTaskDetails($inspector_id);
        $inspector->tasksTimes = $this->user->getInspectorTaskTimes($inspector_id);

        foreach ($inspector->tasks as $task) {
            if ($task->repeat) {
                $task->display_time = Carbon::parse($task->start_time)->format('g:i A') . ' - ' . Carbon::parse($task->end_time)->format('g:i A');
            } else {
                $task->display_time = Carbon::parse($task->start_time)->format('Y jS M g:i A') . ' - ' . Carbon::parse($task->end_time)->format('Y jS M g:i A');
            }
        }

        $username = $this->user->getUsername($inspector->user_id);
        $inspector->username = $username->username;
        $inspector->name = $inspector->first_name . ' ' . $inspector->last_name;
        $inspector->address = $inspector->street_number . ', ' . $inspector->street_name . ', ' . $inspector->city . ', ' . $inspector->post_code;
        $inspector->agreement_start = Carbon::parse($inspector->agreement_start)->toFormattedDateString();
        // dd($inspector);
        $inspector->password = $inspector->initial_password;
        $inspector->file = false;

        if ($inspector->image) {
            $inspector->file = true;
        }
        $inspector->image = config('STORAGE_URL') . $inspector->image;
        return view('page.admin.inspector-details', ['inspector' => $inspector, 'inspector_task_times' => $inspector->tasksTimes]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewInspector()
    {
        return view('page.admin.add-new-inspector');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewInspector(Request $request)
    {

        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'last_name' => ['max:255|min:3', new Name],
            'mobile' => new Telephone,
            'telephone' => new Telephone,
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
//            'email' => 'email|max:255|required|unique:users',
            'start_date' => 'date|max:255|required',
            'username' => 'string|required|unique:users',
        ], $messages);

        if ($request->email != '') {
            $this->validate($request, ['email' => 'email|max:255|required|unique:users',], $messages);
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mobile = $request->mobile;
        $telephone = $request->telephone;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $email = $request->email;
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $username = $request->username;
        $level = $request->level;

        $password = str_random(6);

        if (isset($request->docs)) {
            $docs = $request->docs;
            $upload = $docs->store('inspectors');
        } else {
            $upload = '';
        }

        $result = $this->user->addNewInspector($username, $password, $email, $first_name, $last_name, $street_number, $street_name, $city, $postal_code, $telephone, $mobile, $start_date, $level, $upload);

        if ($result) {
            Mail::to($email)->send(new UserRegister(['type' => 'Inspector', 'password' => $password]));

            return redirect('/admin/inspectors/add-new')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editInspector(Request $request)
    {
        $inspector_id = decrypt($request->encoded);
        $inspector = $this->user->getInspectorFromId($inspector_id);
        return view('page.admin.edit-inspector', ['inspector' => $inspector]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditInspector(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'mobile' => new Telephone,
            'telephone' => new Telephone,
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
            'email' => 'email|max:255|required',
            'start_date' => 'date|max:255|required',
            'password' => 'nullable|string|min:6',
        ], $messages);

        $inspector_id = $request->inspector_id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $mobile = $request->mobile;
        $telephone = $request->telephone;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $postal_code = $request->post_code;
        $email = $request->email;
        $level = $request->level;
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');

        $inspector = $this->user->getInspectorFromId($inspector_id);

        $type_update = $this->user->updateInspectorType($inspector->user_id, $request->level);

        $password = false;

        if ($request->password != '') {
            $password = bcrypt($request->password);
            $update_password = $this->user->updateUserPassword($inspector->user_id, $password);
            $update_inspector_password = $this->user->updateInspectorInitialPassword($inspector_id, $request->password);
        }

        $result = $this->user->updateInspector($inspector->user_id, $inspector_id, $email, $first_name, $last_name, $street_number, $street_name, $city, $postal_code, $telephone, $mobile, $start_date, $level);

        if (isset($request->docs)) {
            $docs = $request->docs;
            $upload = $docs->store('cleaners');
        } else {
            $upload = '';
        }

        if ($upload) {
            $this->user->updateInspectorImage($inspector->id, $upload);
        }

        if ($result || $password) {
            return redirect('/admin/inspectors')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userManagement()
    {
        $users = $this->user->getUsers();

        foreach ($users as $user) {
            $user->active = false;
            $user->deactive = false;
            if ($user->status == 'ACTIVE') {
                $user->active = true;
            }
            if ($user->status == 'DEACTIVE') {
                $user->deactive = true;
            }
        }

        return view('page.admin.user-management', ['users' => json_encode($users)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSetActive(Request $request)
    {
        $user_id = $request->user_id;

        $update_status = $this->user->updateUserStatus($user_id, 'ACTIVE');

        if ($update_status) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'failed'], 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSetDeactive(Request $request)
    {
        $user_id = $request->user_id;

        $update_status = $this->user->updateUserStatus($user_id, 'DEACTIVE');

        if ($update_status) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'failed'], 401);
        }
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clients($redirect = 0)
    {
        $clients = $this->user->getClients(); 
        foreach ($clients as $client) { 

            $client->details = $this->task->getClientDetails($client->id);
            foreach ($client->details as $detail) {
                if ($detail->repeat && strpos($detail->repeat_mode, '_') !== false) {
                    $repeat_modes = explode('_', $detail->repeat_mode);
                    $repeat_text = '';
                    foreach ($repeat_modes as $repeat_mode) {
                        if ($repeat_mode != '') {
                            switch ($repeat_mode) {
                                case '0':
                                    $repeat_text .= 'Sunday, ';
                                    break;
                                case '1':
                                    $repeat_text .= 'Monday, ';
                                    break;
                                case '2':
                                    $repeat_text .= 'Tuesday, ';
                                    break;
                                case '3':
                                    $repeat_text .= 'Wednesday, ';
                                    break;
                                case '4':
                                    $repeat_text .= 'Thursday, ';
                                    break;
                                case '5':
                                    $repeat_text .= 'Friday, ';
                                    break;
                                case '6':
                                    $repeat_text .= 'Saturday, ';
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                    $detail->repeat_mode = $repeat_text;
                } elseif ($detail->repeat && $detail->repeat_mode == 'weekly') {
                    $date = Carbon::parse($detail->start_time)->format('l');
                    $detail->repeat_mode = 'weekly - ' . $date;
                } elseif ($detail->repeat && $detail->repeat_mode == 'monthly') {
                    $date = Carbon::parse($detail->start_time)->format('jS');
                    $detail->repeat_mode = 'monthly - ' . $date;
                }
            }
            $client->products = $this->task->getClientInventory($client->id);
            $client->contract = config('STORAGE_URL') . $client->contract;
        }

        foreach ($clients as $client) {
            if ($client->continuous) {
                $client->continuous = 'Yes';
            } else {
                $client->continuous = 'No';
            }

            if ($client->supply_required) {
                $client->supply_required = 'Yes';
            } else {
                $client->supply_required = 'No';
            }

            $client->accounting_contacts = $this->user->getAccountingContacts($client->id);
            $client->operational_contacts = $this->user->getOperationalContacts($client->id);
        } 
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a>";  
        return view('page.admin.clients', ['clients' => $clients, 'client_id' => $redirect, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getClients($redirect = 0)
    {
        $clients = $this->user->getClients(); 
        foreach ($clients as $detail) { 
            $method = Category::find($detail->category_id);
            $detail->category = $method->name;
        }
        return $clients = Datatables::of($clients)->make(true);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getClientDetails(Request $request)
    {
        $client_id = $request->client_id;
        $clientData = $this->user->getClient($client_id);
        $clientData->details = $this->task->getClientDetails($client_id);

        foreach ($clientData->details as $detail) {
            if ($detail->repeat && strpos($detail->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $detail->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $detail->repeat_mode = $repeat_text;
            } elseif ($detail->repeat && $detail->repeat_mode == 'weekly') {
                $date = Carbon::parse($detail->start_time)->format('l');
                $detail->repeat_mode = 'weekly - ' . $date;
            } elseif ($detail->repeat && $detail->repeat_mode == 'monthly') {
                $date = Carbon::parse($detail->start_time)->format('jS');
                $detail->repeat_mode = 'monthly - ' . $date;
            }
        }
        $clientData->products = $this->task->getClientInventory($client_id);
        $clientData->contract = config('STORAGE_URL') . $clientData->contract;

        if ($clientData->continuous) {
            $clientData->continuous = 'Yes';
        } else {
            $clientData->continuous = 'No';
        }
        if ($clientData->supply_required) {
            $clientData->supply_required = 'Yes';
        } else {
            $clientData->supply_required = 'No';
        }

        $clientData->accounting_contacts = $this->user->getAccountingContacts($client_id);
        $clientData->operational_contacts = $this->user->getOperationalContacts($client_id);

        /*Get tasks assigned for this client*/
        $tasksList = $this->taskList($client_id);

        /*Get tasks sign in/out times*/
        $logTimes = $this->task->getCleanerTimes($client_id);
        //dd($logTimes);
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/clients/".$client_id."/get'>Client Details</a>";   

        return view('page.admin.client-details', ['client' => $clientData, 'taskList' => $tasksList, 'timeList' => $logTimes, 'client_id' => $client_id, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param int $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCleanerChecklist(Request $request)
    {
        $client_id = $request->client_id;
        $clientData = $this->user->getClient($client_id);
        $cleanerChecklist = $this->checklist->getCleanerChecklistsByClient($client_id); 

        foreach ($cleanerChecklist as $key => $checklist) {

            $checklistItems = $this->checklist->getCleanerChecklistItems($checklist->id); 
            $checklist->item = $checklistItems; 
        } 
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/clients/".$client_id."/getChecklist'>Cleaner Checklist</a>";  
        return view('page.admin.cleaner-checklist', ['checklist' => $cleanerChecklist, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editClient(Request $request)
    {
        $client_id = $request->client_id;
        $client = $this->user->getClient($client_id);

        $client->operational_contacts = $this->user->getOperationalContacts($client->id);
        $client->accounting_contacts = $this->user->getAccountingContacts($client->id);
        $categories = $this->category->getCategories();
        $cleanerChecklist = $this->checklist->getCleanerChecklistsByClient($client->id); 

        foreach ($cleanerChecklist as $key => $checklist) {

            $checklistItems = $this->checklist->getCleanerChecklistItems($checklist->id); 
            $checklist->item = $checklistItems; 
        } 
        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/clients/".$client_id."/edit'>Edit Client</a>";    
        return view('page.admin.edit-client', ['client' => $client, 'categories' => $categories, 'checklist' => $cleanerChecklist, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditClient(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number',
            'category.required' => 'The class is required'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
            'start_date' => 'string|max:255|required',
            'category' => 'required'
        ], $messages);

        $client_id = $request->client_id;

        $first_name = $request->first_name;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $post_code = $request->post_code;
        $alarm_code = $request->alarm_code;
        $lock_code = $request->lock_code;
        $start_date = $request->start_date;
        $termination_date = $request->termination_date;
        $payment_date = Carbon::parse($request->payment_date)->format('Y-m-d H:i:s');

        $supply_required = $request->supply_required;

        $continuous = $request->continuous;

        $extra_id = $request->extra_id;
        $extra_first_name = $request->extra_first_name;
        $extra_email = $request->extra_email;
        $extra_telephone = $request->extra_telephone;
        $extra_contact_type = $request->extra_contact_type;
        $category = $request->category;

        if ($extra_id) {
            foreach ($extra_id as $key => $item) {
                if ($extra_contact_type[$key] == 'operational') {
                    if ($item != 'false') {
                        $this->user->updateOperationalContact($item, $extra_first_name[$key], $extra_email[$key], $extra_telephone[$key]);
                    } else {
                        $this->user->addNewOperationalContact($client_id, $extra_first_name[$key], $extra_email[$key], $extra_telephone[$key]);
                    }
                } else {
                    if ($item != 'false') {
                        $this->user->updateAccountingContact($item, $extra_first_name[$key], $extra_email[$key], $extra_telephone[$key]);
                    } else {
                        $this->user->addNewAccountingContact($client_id, $extra_first_name[$key], $extra_email[$key], $extra_telephone[$key]);
                    }
                }
            }
        }
        if ($supply_required == 'true') {
            $supply_required = true;
        } else {
            $supply_required = false;
        }

        if ($continuous == 'true') {
            $continuous = true;
        } else {
            $continuous = false;
        }

        $address_string = $street_number . ', ' . $street_name . ', ' . $city . ', ' . $post_code;

        $address = str_replace(' ', '+', $address_string);
        $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
        $latitude_longitude = json_decode($geocode_to);

        if (!empty($latitude_longitude->results)) {
            $latitude = $latitude_longitude->results[0]->geometry->location->lat;
            $longitude = $latitude_longitude->results[0]->geometry->location->lng;
        } else {
            $latitude = '';
            $longitude = '';
        }

        $task = $this->task->updateTaskLocation($client_id, $address_string, $latitude, $longitude);

        $client = $this->user->updateClient($client_id, $first_name, $street_number, $street_name, $city, $post_code, $supply_required, $termination_date, $start_date, $lock_code, $alarm_code, $payment_date, $continuous, $category);

        if ($client) {
            return redirect('/admin/clients')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewClient()
    {
        $categories = $this->category->getCategories();
        return view('page.admin.add-new-client', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewClient(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number',
            'category.required' => 'The class is required'
        ];

        $this->validate($request, [
            'first_name' => 'string|max:255|required',
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
            'oc_first_name' => ['max:255|required|min:3', new Name],
            'oc_email' => 'email|max:255|required',
            //'oc_telephone' => new Telephone,
            'start_date' => 'string|max:255|required',
            'extra_first_name.*' => ['max:255|required|nullable|min:3', new Name],
            'extra_email.*' => 'email|max:255|required|nullable',
            'extra_telephone.*' => ['nullable', new Telephone],
            'category' => 'required'
        ], $messages);

        if ($request->account_clone != 'true') {
            $this->validate($request, [
                'oc_first_name_2' => ['max:255|required|nullable|min:3', new Name],
                'oc_email_2' => 'email|max:255|required|nullable',
                //'oc_telephone_2' => ['nullable', new Telephone],
            ], $messages);
        }

        $first_name = $request->first_name;
        $street_number = $request->street_number;
        $street_name = $request->street_name;
        $city = $request->city;
        $post_code = $request->post_code;
        $oc_first_name = $request->oc_first_name;
        $oc_email = $request->oc_email;
        $oc_telephone = $request->oc_telephone;
        $oc_post_code = $request->oc_post_code;
        $oc_first_name_2 = $request->oc_first_name_2;
        $oc_email_2 = $request->oc_email_2;
        $oc_telephone_2 = $request->oc_telephone_2;
        $oc_post_code_2 = $request->oc_post_code_2;
        $alarm_code = $request->alarm_code;
        $lock_code = $request->lock_code;
        $start_date = $request->start_date;
        $termination_date = $request->termination_date;
        $payment_date = Carbon::parse($request->payment_date)->format('Y-m-d H:i:s');
        $type = $request->type;
        $supply_required = $request->supply_required;

        $extra_first_name = $request->extra_first_name;
        $extra_email = $request->extra_email;
        $extra_telephone = $request->extra_telephone;
        $extra_contact_type = $request->extra_contact_type;
        $category = $request->category;
        $contract = $request->contract;

        $titles = $request->title;
        $orders = $request->order;
        $items = $request->checklist_item;

        if ($contract) {
            $contract = $contract->store('contract');
        }

        if ($type == 'continuous') {
            $contiuous = true;
        } else {
            $contiuous = false;
        }

        if ($supply_required == 'true') {
            $supply_required = true;
        } else {
            $supply_required = false;
        }

        $client = $this->user->addNewClient($first_name, $street_number, $street_name, $city, $post_code, $contiuous, $supply_required, $termination_date, $start_date, $lock_code, $alarm_code, $payment_date, $category, $contract);

        foreach ($titles as $key => $title) {
            $checklist = $this->checklist->createCleanerChecklist($client->id, $title, $orders[$key]);
            $chkOrder = 0;
            foreach ($items[$key] as $item_key => $item) {
                $checklist_item = $this->checklist->createCleanerChecklistItem($checklist->id, $item, $chkOrder);
                $chkOrder++;
            }
        }

        $operational_contact_1 = $this->user->addNewOperationalContact($client->id, $oc_first_name, $oc_email, $oc_telephone, $oc_post_code);

        if (!empty($extra_first_name)) {
            foreach ($extra_first_name as $key => $item) {
                if ($extra_contact_type[$key] == 'operational') {
                    $this->user->addNewOperationalContact($client->id, $item, $extra_email[$key], $extra_telephone[$key]);
                } else {
                    $this->user->addNewAccountingContact($client->id, $item, $extra_email[$key], $extra_telephone[$key]);
                }
            }
        }

        if ($request->account_clone == 'true') {
            $oc_first_name_2 = $oc_first_name;
            $oc_email_2 = $oc_email;
            $oc_telephone_2 = $oc_telephone;
            $oc_post_code_2 = $oc_post_code;
        }

        if ($oc_first_name_2 != '') {
            $operational_contact_2 = $this->user->addNewAccountingContact($client->id, $oc_first_name_2, $oc_email_2, $oc_telephone_2, $oc_post_code_2);
        }
        if ($client && $operational_contact_1) {
            return redirect('/admin/clients/add-new')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clientAllocations()
    {
        $clients = $this->user->getClients();
        $cleaners = $this->user->getCleaners();
        $inspectors = $this->user->getInspectors();
        $single_task_options = $this->task->getOptions('single');
        $repeat_task_options = $this->task->getOptions('repeat');

        $breadcrumb = "<a href='/'>Home</a> / <a href='/admin/administrators'>Admin</a> / <a href='/admin/clients'>Clients</a> / <a href='/admin/clients/allocations'>Client Allocations</a>";  

        return view('page.admin.client-allocations', [
            'clients' => $clients,
            'cleaners' => $cleaners,
            'inspectors' => $inspectors,
            'single_task_options' => $single_task_options,
            'repeat_task_options' => $repeat_task_options,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAllocateValidation(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        if ($request->repeat == 'true') {
            $validator = Validator::make($request->all(), [
                'client' => 'required',
                'name' => 'required|string',
                'start_date' => 'date|max:255|required',
                'start_time' => 'required',
                'address' => 'string|max:255|required',
                //'task_items' => 'array|max:255|required',
                'inspector' => 'array|min:1',
                'cleaner' => 'array|min:1',
                'inspector.*' => 'distinct|min:1',
                'cleaner.*' => 'distinct|min:1',
                'repeat_mode' => 'required',
            ], $messages);
        } else {
            $validator = Validator::make($request->all(), [
                'client' => 'required',
                'name' => 'required|string',
                'start_date' => 'date|max:255|required',
                'start_time' => 'required',
                'address' => 'string|max:255|required',
                //'task_items' => 'array|max:255|required',
                'inspector' => 'array|min:1',
                'cleaner' => 'array|min:1',
                'inspector.*' => 'distinct|min:1',
                'cleaner.*' => 'distinct|min:1',
            ], $messages);
        }


        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
//            $task_item_content = true;
//            foreach ($request->task_items as $task_item) {
//                if ($task_item == '') {
//                    $task_item_content = false;
//                }
//            }

            $cleaner_content = true;
            foreach ($request->cleaner as $cleaner) {
                if ($cleaner == '') {
                    $cleaner_content = false;
                }
            }

            $inspector_content = true;
            foreach ($request->inspector as $inspector) {
                if ($inspector == '') {
                    $inspector_content = false;
                }
            }

//            if (!$task_item_content) {
//                return response()->json(['message' => 'Task Items']);
//            } elseif (!$cleaner_content) {
//                return response()->json(['message' => 'cleaner']);
//            } elseif (!$inspector_content) {
//                return response()->json(['message' => 'inspector']);
//            } else {
//                return response()->json(['message' => 'Success']);
//            }

            if (!$cleaner_content) {
                return response()->json(['message' => 'cleaner']);
            } elseif (!$inspector_content) {
                return response()->json(['message' => 'inspector']);
            } else {
                return response()->json(['message' => 'Success']);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAllocateTasks(Request $request)
    {
        $repeat = $request->repeat;

        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'client' => 'required',
            'name' => 'string|max:255|required',
            'start_date' => 'date|max:255|required',
//            'end_date' => 'date|max:255|required',
            'start_time' => 'required',
            'end_time' => 'required',
            'address' => 'string|max:255|required',
//            'task_items' => 'array|max:255|required',
            'inspector' => 'required|min:1',
            'cleaner' => 'required|min:1',
            'inspector.*' => 'required|distinct',
            'cleaner.*' => 'required|distinct',
        ], $messages);

        $client = $request->client;
        $name = $request->name;
//        $name = 'Task - ' . Carbon::now()->format('YmdHis');
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $original_address = $request->address;
        $task_items = $request->task_items;
        $type = $request->type;
        $inspectors = $request->inspector;
        $cleaners = $request->cleaner;

        $address = str_replace(' ', '+', $original_address);
        $geocode_to = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=AIzaSyCOfIuf3LC1ZFX0qa2qglaOVPv9_XlkMrE');
        $latitude_longitude = json_decode($geocode_to);

        if (!empty($latitude_longitude->results)) {
            $latitude = $latitude_longitude->results[0]->geometry->location->lat;
            $longitude = $latitude_longitude->results[0]->geometry->location->lng;
        } else {
            $latitude = '';
            $longitude = '';
        }

        if ($repeat === 'true') {
            $repeat = 1;
        } else {
            $repeat = 0;
        }

        if ($repeat) {
            $options = $this->task->getOptions('repeat');
            $option_type = 'repeat';
        } else {
            $options = $this->task->getOptions('single');
            $option_type = 'single';
        }

        $option_flag = true;

        foreach ($options as $option) {
            if ($option->id == $name) {
                $option_flag = false;
            }
        }

        if ($option_flag) {
            $option = $this->task->createOption($name, $option_type);
            $name = $option->text;
        } else {
            $check_name = $this->task->checkTaskName($name);
            $name = $check_name->text;
        }

        $repeat_mode = $request->repeat_mode;

        if ($repeat_mode == 'weekdays') {
            $weekdays = json_decode($request->weekdays);
            $repeat_text = '';
            foreach ($weekdays as $key => $weekday) {
                if ($weekday->value) {
                    $repeat_text .= $key . '_';
                }
            }
            $repeat_mode = $repeat_text;
        }

        $task = $this->task->createTask($name, $client, $original_address, $latitude, $longitude, $type, 'ACTIVE');
        $start_slot = Carbon::parse($start_date . ' ' . $start_time)->format('Y-m-d H:i:s');
        $end_slot = Carbon::parse($end_date . ' ' . $end_time)->format('Y-m-d H:i:s');
        $schedule = $this->task->createSchedule($repeat, $start_slot, $end_slot, $repeat_mode);
        $schedule->tasks()->attach($task->id);

//        foreach ($task_items as $task_item) {
//            $task_item_result = $this->task->createTaskItem($task->id, $task_item, 0);
//        }

        foreach ($cleaners as $cleaner) {
            $task_to_cleaner = $this->task->assignTaskToCleaner($task->id, $cleaner, $start_date, $end_date);
        }

        foreach ($inspectors as $inspector) {
            $task_to_inspector = $this->task->assignTaskToInspector($task->id, $inspector, $start_date, $end_date);
            $this->push->push(['task' => $task, 'inspector' => $inspector]);
        }
        //if ($task && $schedule && $task_item_result && $task_to_cleaner && $task_to_inspector) {
        if ($task && $schedule && $task_to_cleaner && $task_to_inspector) {
            return redirect('/admin/clients/allocations')->with(['success' => 'Saved successfully']);
        } else {

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetTasks(Request $request)
    {
        $client_id = $request->client_id;

        $tasks = $this->task->getTasksByClient($client_id);

        return response()->json(['tasks' => $tasks]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAllocateUsers(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'task' => 'required',
            'inspector' => 'required',
            'cleaner' => 'required',
            'start_date' => 'date|max:255|required',
            'end_date' => 'date|max:255|required',
        ], $messages);

        $task = $request->task;
        $inspector = $request->inspector;
        $cleaner = $request->cleaner;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $task_to_cleaner = $this->task->assignTaskToCleaner($task, $cleaner, $start_date, $end_date);

        $task_to_inspector = $this->task->assignTaskToInspector($task, $inspector, $start_date, $end_date);
        $this->push->push(['task' => $task, 'inspector' => $inspector]);

        if ($task_to_cleaner && $task_to_inspector) {
            return redirect('/admin/clients/allocations')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetClientLocation(Request $request)
    {
        $client_id = $request->client_id;
        $client_location = $this->task->getClientLocation($client_id);
        return response()->json(['location' => $client_location]);
    }

    /**]
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function task(Request $request)
    {
        $task_id = $request->task_id;
        $tasks = $this->task->getTaskDetails($task_id);
        foreach ($tasks as $task) {
            if ($task->schedule_repeat) {
                $task->start_time = Carbon::parse($task->start_time)->format('g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('g:i A');
            } else {
                $task->start_time = Carbon::parse($task->start_time)->format('Y-m-d g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('Y-m-d g:i A');
            }
            $task->items = $this->task->getTaskItems($task_id);
        }
        return view('page.admin.task', ['task' => $task]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetEntities()
    {
        $clients = $this->user->getClients();
        $administrators = $this->user->getAdministrators();
        $cleaners = $this->user->getCleaners();
        $inspectors = $this->user->getInspectors();

        $entities = [];

        foreach ($clients as $client) {
            $client->entity = 'client';
            $entities[] = $client;
        }

        foreach ($administrators as $administrator) {
            $administrator->name = $administrator->first_name . ' ' . $administrator->last_name;
            $administrator->entity = 'administrator';
            $entities[] = $administrator;
        }

        foreach ($cleaners as $cleaner) {
            $cleaner->entity = 'cleaner';
            $entities[] = $cleaner;
        }

        foreach ($inspectors as $inspector) {
            $inspector->entity = 'inspector';
            $entities[] = $inspector;
        }
        return response()->json($entities);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function entitySearchResult(Request $request)
    {
        $entity_id = $request->entity_id;
        $entity_name = $request->entity_name;

        switch ($entity_name) {
            case 'cleaner':
                return $this->cleaners($entity_id);
                break;
            case 'client':
                return $this->clients($entity_id);
                break;
            case 'administrator':
                return $this->administrators($entity_id);
                break;
            case 'inspector':
                return $this->inspectors($entity_id);
                break;
            default:
                break;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tasks()
    {
        $tasks = $this->task->getTasks();

        foreach ($tasks as $task) {
            if ($task->repeat && strpos($task->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $task->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $task->repeat_mode = $repeat_text;
            }
        }

        $clients = $this->user->getTaskClients();

        foreach ($tasks as $task) {
            $task->task_items = $this->task->getTaskItemsForTasks($task->task_id);
            if ($task->repeat) {
                $task->start_time = Carbon::parse($task->start_time)->format('g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('g:i A');
            } else {
                $task->start_time = Carbon::parse($task->start_time)->format('Y-m-d g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('Y-m-d g:i A');
            }
        }

        return view('page.admin.tasks', ['tasks' => $tasks, 'clients' => $clients]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function taskList($client_id)
    {
        $tasks = $this->task->getTaskByClient($client_id);

        foreach ($tasks as $task) {
            if ($task->repeat && strpos($task->repeat_mode, '_') !== false) {
                $repeat_modes = explode('_', $task->repeat_mode);
                $repeat_text = '';
                foreach ($repeat_modes as $repeat_mode) {
                    if ($repeat_mode != '') {
                        switch ($repeat_mode) {
                            case '0':
                                $repeat_text .= 'Sunday, ';
                                break;
                            case '1':
                                $repeat_text .= 'Monday, ';
                                break;
                            case '2':
                                $repeat_text .= 'Tuesday, ';
                                break;
                            case '3':
                                $repeat_text .= 'Wednesday, ';
                                break;
                            case '4':
                                $repeat_text .= 'Thursday, ';
                                break;
                            case '5':
                                $repeat_text .= 'Friday, ';
                                break;
                            case '6':
                                $repeat_text .= 'Saturday, ';
                                break;
                            default:
                                break;
                        }
                    }
                }
                $task->repeat_mode = $repeat_text;
            }
        }

        $clients = $this->user->getTaskClients();

        foreach ($tasks as $task) {
            $task->task_items = $this->task->getTaskItemsForTasks($task->task_id);
            if ($task->repeat) {
                $task->start_time = Carbon::parse($task->start_time)->format('g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('g:i A');
            } else {
                $task->start_time = Carbon::parse($task->start_time)->format('Y-m-d g:i A');
                $task->end_time = Carbon::parse($task->end_time)->format('Y-m-d g:i A');
            }
        }
        //dd($tasks);
        //return view('page.admin.task-list', ['tasks' => $tasks, 'clients' => $clients]);
        return $tasks;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTaskData(Request $request)
    {
        $task_id = $request->encoded;
        $task = $this->task->getTaskForAssign($task_id);
        $taskData = $task[0];

        if ($taskData->repeat) {
            $taskData->start_time = Carbon::parse($taskData->start_time)->format('g:i A');
            $taskData->end_time = Carbon::parse($taskData->end_time)->format('g:i A');
        } else {
            $taskData->start_time = Carbon::parse($taskData->start_time)->format('Y-m-d g:i A');
            $taskData->end_time = Carbon::parse($taskData->end_time)->format('Y-m-d g:i A');
        }

        //dd($taskData);
        return response()->json(['taskData' => $taskData]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assign(Request $request)
    {
        $task_id = $request->task_id;
        $clients = $this->user->getClients();
        $cleaners = $this->user->getCleaners();
        $inspectors = $this->user->getInspectors();
        $task = $this->task->getTaskForAssign($task_id);


        $task_items = $this->task->getTaskItems($task_id);

        $single_task_options = $this->task->getOptions('single');

        $repeat_task_options = $this->task->getOptions('repeat');

        $task[0]->start_time = Carbon::parse($task[0]->start_time)->format('Y-m-d g:i A');
        $task[0]->end_time = Carbon::parse($task[0]->end_time)->format('Y-m-d g:i A');

        $task[0]->selected_dates = [];

        $task[0]->cleaners = $this->task->getCleanersByTask($task_id);
        $task[0]->inspectors = $this->task->getInspectorsByTask($task_id);

        if ($task[0]->repeat && strpos($task[0]->repeat_mode, '_') !== false) {
            $repeat_modes = explode('_', $task[0]->repeat_mode);
            foreach ($repeat_modes as $repeat_mode) {
                if ($repeat_mode != '') {
                    $task[0]->selected_dates[] = $repeat_mode;
                }
            }
            $task[0]->repeat_mode = 'weekdays';
        }


        return view('page.admin.reassign-task', [
            'task' => $task[0],
            'clients' => $clients,
            'cleaners' => $cleaners,
            'inspectors' => $inspectors,
            'task_items' => $task_items,
            'single_task_options' => $single_task_options,
            'repeat_task_options' => $repeat_task_options,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAssign(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'cleaner' => 'required',
            'inspector' => 'required',
            'task_items' => 'required'
        ], $messages);

        if (!$request->repeat) {
            $this->validate($request, [
                'start_time' => 'required',
                'end_time' => 'required',
            ], $messages);
        }

        $task_id = $request->task_id;
        $cleaner_ids = $request->cleaner;
        $inspector_ids = $request->inspector;
        $start_time = $request->start_time;
        $start_date = $request->start_date;
        $end_time = $request->end_time;
        $end_date = $request->end_date;
        $task_items = $request->task_items;
        $repeat = $request->repeat;
        $repeat_mode = $request->repeat_mode;

        $old_task_items = $this->task->getTaskItems($task_id);

        foreach ($old_task_items as $old_task_item) {
            $old_task_item->hit = false;
            foreach ($task_items as $task_item) {
                if ($old_task_item->name == $task_item) {
                    $old_task_item->hit = true;
                }
            }
        }

        foreach ($old_task_items as $old_task_item) {
            if (!$old_task_item->hit) {
                $this->task->deleteTaskItem($old_task_item->id);
            }
        }

        foreach ($task_items as $task_item) {
            $check = $this->task->getTaskItemByName($task_id, $task_item);
            if (!$check) {
                $this->task->createTaskItem($task_id, $task_item, false);
            }
        }

        $current_cleaner = $this->task->getCurrentCleanerFromTask($task_id);

        $current_inspector = $this->task->getCurrentInspectorFromTask($task_id);

        $schedule_id = $this->task->getScheduleIdByTask($task_id);

        $delete_cleaners = $this->task->deleteCleanersFromTask($task_id);
        $delete_inspectors = $this->task->deleteInspectorsFromTask($task_id);

        foreach ($cleaner_ids as $cleaner_id) {
            $cleaner = $this->task->assignTaskToCleaner($task_id, $cleaner_id, Carbon::parse($start_time)->toDateString(), Carbon::parse($end_time)->toDateString());
        }

        foreach ($inspector_ids as $inspector_id) {
            $inspector = $this->task->assignTaskToInspector($task_id, $inspector_id, Carbon::parse($start_time)->toDateString(), Carbon::parse($end_time)->toDateString());
            $this->push->push(['task' => $task_id, 'inspector' => $inspector]);
        }

//        $cleaner = $this->task->reassignCleanerToTask($task_id, $current_cleaner->cleaner_id, $cleaner_id);

//        $inspector = $this->task->reassignInspectorToTask($task_id, $current_inspector->inspector_id, $inspector_id);

        if (!$end_date) {
            $end_date = Carbon::now()->toDateString();
        }

        if (!$repeat) {
            $schedule = $this->task->updateSchedule($schedule_id[0]->schedule_id, Carbon::parse($start_date . ' ' . $start_time)->toDateTimeString(), Carbon::parse($end_date . ' ' . $end_time)->toDateTimeString());
        } else {
            if ($repeat_mode == 'weekdays') {
                $weekdays = json_decode($request->weekdays);
                $repeat_text = '';
                foreach ($weekdays as $key => $weekday) {
                    if ($weekday->value) {
                        $repeat_text .= $key . '_';
                    }
                }

                $repeat_mode = $repeat_text;
            }
            $schedule = $this->task->updateRepeatedSchedule($schedule_id[0]->schedule_id, $repeat, Carbon::parse($start_date . ' ' . $start_time)->toDateTimeString(), Carbon::parse($end_date . ' ' . $end_time)->toDateTimeString(), $repeat_mode);
        }

        if ($cleaner || $inspector || $schedule) {
            return redirect('/admin/clients/tasks')->with(['success' => 'Saved successfully']);
        } else {
            return redirect('/admin/clients/tasks')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxDeleteAdministrator(Request $request)
    {
        $user_id = $request->user_id;
        $termination = $request->termination;

        $termination_update = $this->user->updateAdministratorTermination($user_id, $termination);

        $admin = $this->user->deleteAdministrator($user_id);
        $user = $this->user->deleteUser($user_id);


        if ($admin && $user && $admin != 'key' && $user != 'key') {
            return response()->json(['message' => 'Terminated Successfully'], 200);
        } elseif ($admin == 'key' || $user == 'key') {
            return response()->json(['message' => 'Cannot Terminate. Data exists for administrator']);
        } else {
            return response()->json(['message' => 'Terminate Failed'], 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxDeleteCleaner(Request $request)
    {
        $user_id = $request->user_id;
        $termination = $request->termination;

        $termination_update = $this->user->updateCleanerTermination($user_id, $termination);

        $admin = $this->user->deleteCleaner($user_id);
        $user = $this->user->deleteUser($user_id);


        if ($admin && $user && $admin != 'key' && $user != 'key') {
            return response()->json(['message' => 'Terminated Successfully'], 200);
        } elseif ($admin == 'key' || $user == 'key') {
            return response()->json(['message' => 'Cannot Terminate. Data exists for cleaner']);
        } else {
            return response()->json(['message' => 'Terminate Failed'], 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxDeleteInspector(Request $request)
    {
        $user_id = $request->user_id;
        $termination = $request->termination;

        $termination_update = $this->user->updateInspectorTermination($user_id, $termination);

        $admin = $this->user->deleteInspector($user_id);
        $user = $this->user->deleteUser($user_id);


        if ($admin && $user && $admin != 'key' && $user != 'key') {
            return response()->json(['message' => 'Terminated Successfully'], 200);
        } elseif ($admin == 'key' || $user == 'key') {
            return response()->json(['message' => 'Cannot Terminate. Data exists for inspector']);
        } else {
            return response()->json(['message' => 'Terminate Failed'], 200);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function alerts()
    {
        $alerts = $this->alert->getAllAlerts();
        return view('page.admin.alerts', ['alerts' => $alerts]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewAlert()
    {
        return view('page.admin.add-new-alert');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewAlert(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|max:255',
            'message' => 'string|max:1000',
            'date' => 'date',
        ]);

        $title = $request->title;
        $message = $request->message;
        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $type = $request->type;

        $alert = $this->alert->createAlert($title, $message, $type, $date);

        if ($alert) {
            return redirect('/admin/alerts/add-new')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAlert(Request $request)
    {
        $alert_id = $request->alert_id;

        $alert = $this->alert->getAlert($alert_id);

        return view('page.admin.edit-alert', ['alert' => $alert]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditAlert(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|max:255',
            'message' => 'string|max:1000',
            'date' => 'date',
        ]);

        $alert_id = $request->alert_id;
        $title = $request->title;
        $message = $request->message;
        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $type = $request->type;

        if ($request->status == 'true') {
            $status = true;
        } else {
            $status = false;
        }

        $alert = $this->alert->updateAlert($alert_id, $title, $message, $type, $date, $status);

        if ($alert) {
            return redirect('/admin/alerts')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAlert(Request $request)
    {
        $alert_id = $request->alert_id;

        $alert = $this->alert->deleteAlert($alert_id);

        if ($alert && $alert != 'key') {
            return response()->json(['message' => 'Terminated Successfully'], 200);
        } elseif ($alert == 'key') {
            return response()->json(['message' => 'Cannot Terminate. Data exists for alert']);
        } else {
            return response()->json(['message' => 'Terminate Failed'], 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteClient(Request $request)
    {
        $client_id = $request->client_id;

        $update_date = $this->task->updateClientTermination($client_id, Carbon::now()->format('Y-m-d'));

        $alert = $this->task->deleteClient($client_id);

        if ($alert && $alert != 'key') {
            return response()->json(['message' => 'Terminated Successfully'], 200);
        } elseif ($alert == 'key') {
            return response()->json(['message' => 'Cannot Terminate. Data exists for client']);
        } else {
            return response()->json(['message' => 'Terminate Failed'], 200);
        }
    }

    /**
     * @param Request $request
     */
    public function validateAddNewClient(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number',
            'category.required' => 'The class is required'
        ];

        $this->validate($request, [
            'first_name' => 'string|max:255|required',
            'street_number' => 'string|max:255|required',
            'street_name' => 'string|max:255|required',
            'city' => ['max:255|required|min:3', new Name],
            'post_code' => 'string|max:255|required',
            'oc_first_name' => ['max:255|required|min:3', new Name],
            'oc_email' => 'email|max:255|required',
//            'oc_telephone' => new Telephone,
            'start_date' => 'string|max:255|required',
            'extra_first_name.*' => ['max:255|required|nullable|min:3', new Name],
            'extra_email.*' => 'email|max:255|required|nullable',
//            'extra_telephone.*' => ['nullable', new Telephone],
            'category' => 'required'
        ], $messages);

        if ($request->account_clone != 'true') {
            $this->validate($request, [
                'oc_first_name_2' => ['max:255|required|nullable|min:3', new Name],
                'oc_email_2' => 'email|max:255|required|nullable',
//                'oc_telephone_2' => ['nullable', new Telephone],
            ], $messages);
        }

        return response()->json([
            'status' => 'success'
        ]);

    }


}