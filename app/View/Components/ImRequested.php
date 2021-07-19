<?php

namespace App\View\Components;

use App\Models\Account;
use App\Models\RequestToFollow;
use Illuminate\View\Component;

class ImRequested extends Component
{
    public $im_requested ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->im_requested = collect();
        try {
            if($account = Account::find($user->isParentToAccount())) {
                $this->im_requested = $account->requests;
            }
        } catch(\Exception $e){
            error_log("ImRequested-Component error: ".$e->getMessage());
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.im-requested');
    }
}
