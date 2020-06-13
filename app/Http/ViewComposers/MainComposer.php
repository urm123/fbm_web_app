<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/19/2018
 * Time: 4:01 PM
 */

namespace App\Http\ViewComposers;

use App\Support\TaskSupport;
use Illuminate\View\View;

/**
 * Class MainComposer
 * @package App\Http\ViewComposers
 */
class MainComposer
{
    protected $support;

    /**
     * MainComposer constructor.
     * @param TaskSupport $task_support
     */
    public function __construct(TaskSupport $task_support)
    {
        $this->support = $task_support;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('menus', $this->support->getMenus());
        $view->with('alerts', $this->support->getAlerts());
        $view->with('admin', $this->support->getCurrentAdmin());
    }
}