<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImInvited extends Component
{

    public $im_invited;
    //public $account;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->im_invited = $user->invited;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.im-invited');
    }
}
