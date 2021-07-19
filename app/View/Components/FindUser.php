<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FindUser extends Component
{

    public $account;
    public $user;
    public $permissions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($account,$user, $permissions)
    {
        $this->account = $account;
        $this->user = $user;
        $this->permissions = $permissions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.find-user');
    }
}
