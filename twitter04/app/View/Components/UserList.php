<?php
namespace App\View\Components;
 
use Illuminate\View\Component;
use App\Models\User;
 
class UserList extends Component
{
    public $users;
 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = User::all();
    }
 
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user-list');
    }
}