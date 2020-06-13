<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/16/2017
 * Time: 4:19 PM
 */

namespace App\Repositories;

use App\Client;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientRepository
 * @package App\Repositories
 */
class ClientRepository
{
    /**
     * @return mixed
     */
    public function getCities()
    {
        return DB::select(DB::raw("select city
from clients
group by city;"));
    }
}