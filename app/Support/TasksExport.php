<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 3/19/18
 * Time: 2:33 PM
 */

namespace App\Support;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class TasksExport implements FromView
{

    protected $data;

    public function __construct(ReportsSupport $reports_support)
    {
        $this->data = $reports_support;
    }

    public function view(): View
    {
        return view('page.reports.downloads', ['data' => $this->data->tasks()]);
    }
}