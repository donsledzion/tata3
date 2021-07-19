<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IFollow extends Component
{

    public $families;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->families = $user->accounts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.i-follow');
    }
}
