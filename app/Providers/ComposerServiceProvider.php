<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/19/2018
 * Time: 3:57 PM
 */

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider
 * @package App\Providers
 */
class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\MainComposer');
    }

    public function register()
    {
    }
}