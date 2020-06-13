<?php


namespace App\Support;


use Illuminate\Support\Facades\Log;
use Pusher\Pusher;
use Pusher\PusherException;

/**
 * Class Push
 * @package App\Support
 */
class Push
{
    /**
     * @param array $data
     */
    public function push(array $data)
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        try {
//            $pusher = new Pusher(
//                '5a635ec03a235bf632a7',
//                'd1fb074448891f086604',
//                '941491',
//                $options
//            );
//
//            $data['message'] = 'A new task is received for you. Please accept!';
//            $pusher->trigger('inspector', 'task-assignment', $data);


        } catch (PusherException $e) {
            Log::error($e);
        }
    }

}