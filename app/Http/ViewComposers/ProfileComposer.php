<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;

class ProfileComposer{

    public function __construct()
    {

    }
    public function compose(View $view){
        $view->with(['auth_user_name' => auth()->user()->name]);
    }

}
