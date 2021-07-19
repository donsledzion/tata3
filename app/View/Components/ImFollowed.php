<?php

namespace App\View\Components;

use App\Models\Permission;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ImFollowed extends Component
{
    public $followers;
    public $permissions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $followersRepository  = new UserRepository(new User);
        $this->followers=$followersRepository->indexRelated();
        $this->permissions=Permission::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.im-followed');
    }
}
