<?php

namespace App\View\Components;

use App\Models\RequestToFollow;
use App\Models\User;
use Illuminate\View\Component;

class ImRequesting extends Component
{
    public $im_requesting ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->im_requesting = RequestToFollow::where('requesting_id','=',$user->id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.im-requesting');
    }
}
