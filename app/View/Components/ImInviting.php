<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImInviting extends Component
{
    public $im_inviting;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->im_inviting = $user->invites;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.im-inviting');
    }
}
