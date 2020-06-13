<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/7/2018
 * Time: 4:25 PM
 */

namespace App\Repositories;


use App\Client;
use App\Followup;
use App\FollowupComment;
use App\Prospect;
use App\ProspectMeeting;

/**
 * Class SalesRepository
 * @package App\Repositories
 */
class SalesRepository
{
    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $telephone
     * @param string $mobile
     * @param string $email
     * @param string $reference
     * @param string $status
     * @param string $sq_footage
     * @param string $address
     * @param string $quote
     * @return mixed
     */
    public function createProspect($first_name = '', $last_name = '', $telephone = '', $mobile = '', $email = '', $reference = '', $status = '', $sq_footage = '', $address = '', $quote = '')
    {
        return Prospect::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'email' => $email,
            'reference' => $reference,
            'status' => $status,
            'sq_footage' => $sq_footage,
            'address' => $address,
            'quote' => $quote,
        ]);
    }

    /**
     * @return mixed
     */
    public function getProspects()
    {
        return Prospect::get();
    }

    /**
     * @return mixed
     */
    public function getProspectsForFollowups()
    {
        return Prospect::where('status', 'NOT LIKE', 'Sale Closed')->get();
    }

    /**
     * @param int $prospect_id
     * @return mixed
     */
    public function getProspectMeetings($prospect_id = 0)
    {
        return ProspectMeeting::where('prospect_id', '=', $prospect_id)->get();
    }

    /**
     * @param int $prospect_id
     * @param string $date
     * @param string $description
     * @return mixed
     */
    public function createProspectMeeting($prospect_id = 0, $date = '', $description = '')
    {
        return ProspectMeeting::create([
            'prospect_id' => $prospect_id,
            'date' => $date,
            'description' => $description,
        ]);
    }

    /**
     * @return mixed
     */
    public function getFollowups()
    {
        return Followup::get();
    }

    /**
     * @param string $client_id
     * @param string $admin_id
     * @param string $type
     * @param string $comment
     * @param string $date
     * @return mixed
     */
    public function createFollowup($client_id = '', $admin_id = '', $type = '', $comment = '', $date = '')
    {
        return Followup::create([
            'client_id' => $client_id,
            'admin_id' => $admin_id,
            'type' => $type,
            'comment' => $comment,
            'date' => $date
        ]);
    }

    /**
     * @param int $followup_id
     * @return mixed
     */
    public function getFollowupComments($followup_id = 0)
    {
        return FollowupComment::where('followup_id', '=', $followup_id)->get();
    }

    /**
     * @param int $followup_id
     * @param int $admin_id
     * @param string $upload
     * @param string $date
     * @param string $comment
     * @param string $description
     * @return mixed
     */
    public function createFollowupComment($followup_id = 0, $admin_id = 0, $upload = '', $date = '', $comment = '', $description = '')
    {
        return FollowupComment::create([
            'followup_id' => $followup_id,
            'admin_id' => $admin_id,
            'upload' => $upload,
            'date' => $date,
            'comment' => $comment,
            'description' => $description,
        ]);
    }

    /**
     * @param int $followup_id
     * @return mixed
     */
    public function updateFollowupTimeStamp($followup_id = 0)
    {
        $followup = Followup::where('id', '=', $followup_id)->first();
        return $followup->touch();
    }

    /**
     * @param $sales_followup_id
     * @return mixed
     */
    public function endSalesFollowup($sales_followup_id)
    {
        return Followup::where('id', '=', $sales_followup_id)
            ->update([
                'status' => 'ENDED'
            ]);
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getEveryClient($client_id = 0)
    {
        return Client::where('id', '=', $client_id)->withTrashed()->first();
    }

    /**
     * @param int $prospect_id
     * @return mixed
     */
    public function getProspect($prospect_id = 0)
    {
        return Prospect::where('id', '=', $prospect_id)->first();
    }

    /**
     * @param int $prospect_id
     * @param string $first_name
     * @param string $last_name
     * @param string $telephone
     * @param string $mobile
     * @param string $address
     * @param string $email
     * @param string $reference
     * @param string $status
     * @param string $sq_footage
     * @param string $quote
     * @return mixed
     */
    public function updateProspect($prospect_id = 0, $first_name = '', $last_name = '', $telephone = '', $mobile = '', $address = '', $email = '', $reference = '', $status = '', $sq_footage = '', $quote = '')
    {
        return Prospect::where('id', '=', $prospect_id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'address' => $address,
            'email' => $email,
            'reference' => $reference,
            'status' => $status,
            'sq_footage' => $sq_footage,
            'quote' => $quote,
        ]);
    }

    /**
     * @param int $followup_id
     * @return mixed
     */
    public function closeFollowup($followup_id = 0)
    {
        return Prospect::where('id', '=', $followup_id)->update([
            'status' => 'Sale Closed'
        ]);
    }
}