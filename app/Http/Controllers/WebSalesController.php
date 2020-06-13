<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/7/2018
 * Time: 3:43 PM
 */

namespace App\Http\Controllers;

use App\Repositories\SalesRepository;
use App\Repositories\UserRepository;
use App\Rules\Name;
use App\Rules\Telephone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;

/**
 * Class WebSalesController
 * @package App\Http\Controllers
 */
class WebSalesController extends Controller
{

    protected $sales;

    protected $user;

    /**
     * WebSalesController constructor.
     * @param SalesRepository $sales_repository
     * @param UserRepository $user_repository
     */
    function __construct(SalesRepository $sales_repository, UserRepository $user_repository)
    {
        $this->sales = $sales_repository;
        $this->user = $user_repository;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prospects()
    {
        $prospects = $this->sales->getProspects();
        return view('page.sales.prospects', ['prospects' => $prospects]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddNew(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'first_name' => ['max:255|min:3', new Name],
            'status' => 'required',
            'telephone' => new Telephone,
//            'mobile' => new Telephone,
            'email' => 'email|max:255|required',
            'reference' => 'string'
        ], $messages);

        $first_name = $request->first_name;
        $last_name = $request->business_name;
        $telephone = $request->telephone;
        $mobile = $request->mobile;
        $email = $request->email;
        $reference = $request->reference;
        $status = $request->status;
        $sq_footage = $request->sq_footage;
        $address = $request->address;
        $quote = $request->quote;

        if ($quote) {
            $quote_file = $quote->store('quotes');
        } else {
            $quote_file = '';
        }
        $prospect = $this->sales->createProspect($first_name, $last_name, $telephone, $mobile, $email, $reference, $status, $sq_footage, $address, $quote_file);

        if ($prospect) {
            return redirect('/sales/prospects')->with(['message' => 'Prospect saved successfully!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetProspectMeetings(Request $request)
    {
        $prospect_id = $request->prospect_id;

        $prospect_meetings = $this->sales->getProspectMeetings($prospect_id);

        foreach ($prospect_meetings as $prospect_meeting) {
            $prospect_meeting->date = Carbon::parse($prospect_meeting->date)->format('Y-m-d');
        }

        return response()->json(['prospect_meetings' => $prospect_meetings]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxPostProspectMeeting(Request $request)
    {
        $prospect_id = $request->prospect_id;
        $date = $request->date;
        $description = $request->description;

        $prospect_meeting = $this->sales->createProspectMeeting($prospect_id, $date, $description);

        if ($prospect_meeting) {
            return redirect('/sales/prospect-details')->with(['message' => 'Prospect saved successfully!']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followup()
    {
        $followups = $this->sales->getProspectsForFollowups();
        foreach ($followups as $followup) {
            $followup->date = Carbon::parse($followup->date)->format('Y-m-d');
            $followup->updated_at = Carbon::parse($followup->updated_at)->format('Y-m-d');
        }
        return view('page.sales.followup', ['followups' => $followups]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewFollowup()
    {
        $clients = $this->user->getClients();
        return view('page.sales.add-new-followup', ['clients' => $clients]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewFollowup(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'client' => 'required',
            'type' => 'required',
            'comment' => 'string',
            'date' => 'date'
        ], $messages);

        $client = $request->client;
        $type = $request->type;
        $comment = $request->comment;
        $date = $request->date;

        $admin = $this->user->getAdminByUser(Auth::id());

        $followup = $this->sales->createFollowup($client, $admin->id, $type, $comment, $date);
        if ($followup) {
            return redirect('sales/followup')->with(['message' => 'Followup added successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetFollowupComments(Request $request)
    {
        $followup_id = $request->followup_id;
        $followup_comments = $this->sales->getFollowupComments($followup_id);

        foreach ($followup_comments as $followup_comment) {

            $followup_comment->admin = $this->user->getAdministrator($followup_comment->admin_id);

            $followup_comment->inspector = $this->user->getInspector($followup_comment->inspector_id);

            if ($followup_comment->admin) {
                $followup_comment->created_by = $followup_comment->admin->first_name . ' ' . $followup_comment->admin->last_name;
            }

            if ($followup_comment->insepctor) {
                $followup_comment->created_by = $followup_comment->insepctor->first_name . ' ' . $followup_comment->insepctor->last_name;
            }

            $followup_comment->date = Carbon::parse($followup_comment->date)->format('Y-m-d @ g:iA');
        }

        return response()->json(['followup_comments' => $followup_comments]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSaveFollowupComments(Request $request)
    {
        $followup_id = $request->followup_id;
        $user_id = Auth::id();
        $comment = $request->comment;
        $description = $request->description;
        $date = $request->date;

        $date = Carbon::parse($date)->format('Y-m-d H:i:s');

        $admin_id = $this->user->getAdminByUser($user_id)->id;

        if (isset($request->upload)) {
            $upload_file = $request->upload;
            $upload = $upload_file->store('followups');
        } else {
            $upload = '';
        }

        $followup_comment = $this->sales->createFollowupComment($followup_id, $admin_id, $upload, $date, $comment, $description);

        $this->sales->updateFollowupTimeStamp($followup_id);

        return response()->json(['followup_comment' => $followup_comment]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxEndSalesFollowup(Request $request)
    {
        $sales_followup_id = $request->sales_followup_id;
        $end_sales_followup = $this->sales->endSalesFollowup($sales_followup_id);
        if ($end_sales_followup) {
            return response()->json(['message' => 'Success'], 200);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prospectDetails()
    {
        $prospects = $this->sales->getProspects();
        foreach ($prospects as $prospect) {
            $prospect->meetings = $this->sales->getProspectMeetings($prospect->id);
        }

        return view('page.sales.prospect-details', ['prospects' => $prospects]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProspect(Request $request)
    {
        $prospect_id = $request->prospect_id;
        $prospect = $this->sales->getProspect($prospect_id);
        return view('page.sales.edit-prospect', ['prospect' => $prospect]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editFollowup(Request $request)
    {
        $prospect_id = $request->prospect_id;
        $prospect = $this->sales->getProspect($prospect_id);
        return view('page.sales.edit-followup', ['prospect' => $prospect]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $prospect_id = $request->prospect_id;
        $first_name = $request->first_name;
        $last_name = $request->business_name;
        $telephone = $request->telephone;
        $mobile = $request->mobile;
        $address = $request->address;
        $email = $request->email;
        $reference = $request->reference;
        $status = $request->status;
        $sq_footage = $request->sq_footage;
        $quote = $request->quote;
        if ($quote) {
            $quote_file = $quote->store('quotes');
        } else {
            $quote_file = '';
        }
        $update = $this->sales->updateProspect($prospect_id, $first_name, $last_name, $telephone, $mobile, $address, $email, $reference, $status, $sq_footage, $quote_file);

        if ($update) {
            return redirect('sales/prospect-details')->with(['message' => 'Prospect saved successfully!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditFollowup(Request $request)
    {
        $prospect_id = $request->prospect_id;
        $first_name = $request->first_name;
        $last_name = $request->business_name;
        $telephone = $request->telephone;
        $mobile = $request->mobile;
        $address = $request->address;
        $email = $request->email;
        $reference = $request->reference;
        $status = $request->status;
        $sq_footage = $request->sq_footage;
        $quote = $request->quote;

        if ($quote) {
            $quote_file = $quote->store('quotes');
        } else {
            $quote_file = '';
        }

        $update = $this->sales->updateProspect($prospect_id, $first_name, $last_name, $telephone, $mobile, $address, $email, $reference, $status, $sq_footage, $quote_file);

        if ($update) {
            return redirect('/sales/followup')->with(['message' => 'Prospect saved successfully!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProspectMeeting(Request $request)
    {
        $prospect_id = $request->prospect_id;
        return view('page.sales.add-prospect-meeting', ['prospect_id' => $prospect_id]);
    }

    public function ajaxGetFollowups()
    {
        $followups = $this->sales->getProspectsForFollowups();
        return response()->json(['followups' => $followups]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCloseFollowup(Request $request)
    {
        $followup_id = $request->followup_id;
        $close = $this->sales->closeFollowup($followup_id);

        $prospect = $this->sales->getProspect($followup_id);

        $this->user->addNewClientForProspect($prospect->last_name, $prospect->address);

        if ($close) {
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function prospectComments(Request $request)
    {
        $prospectId = $request->prospectId;
        $prospectComments = $this->sales->getProspectComments($prospectId);

        foreach ($prospectComments as $prospectComment) {
            $prospectComment->admin = $this->user->getAdministrator($prospectComment->admin_id);

            if ($prospectComment->admin) {
                $prospectComment->created_by = $prospectComment->admin->first_name . ' ' . $prospectComment->admin->last_name;
            }
        }

        return response()->json([
            'comments' => $prospectComments
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveComment(Request $request)
    {
        $prospectId = $request->prospect_id;
        $user_id = Auth::id();
        $comment = $request->comment;
        $description = $request->description;
        $date = $request->date;

        $date = Carbon::parse($date)->format('Y-m-d H:i:s');

        $admin_id = $this->user->getAdminByUser($user_id)->id;

        if (isset($request->upload)) {
            $upload_file = $request->upload;
            $upload = $upload_file->store('prospects');
        } else {
            $upload = '';
        }

        $prospectComment = $this->sales->createProspectComment($prospectId, $admin_id, $upload, $date, $comment, $description);

        $this->sales->updateProspectTimestamp($prospectId);

        return response()->json(['comment' => $prospectComment]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function endProspect(Request $request)
    {
        $prospectId = $request->prospect_id;
        $close = $this->sales->closeFollowup($prospectId);

        $prospect = $this->sales->getProspect($prospectId);

        $this->user->addNewClientForProspect($prospect->last_name, $prospect->address);

        if ($close) {
            return response()->json(['message' => 'Success']);
        }
    }

}