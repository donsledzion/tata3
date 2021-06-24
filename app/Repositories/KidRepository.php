<?php


namespace App\Repositories;
use App\Models\Kid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KidRepository
{

    protected Kid $kid;

    public function __construct(Kid $kid){
        $this->kid = $kid;
    }

    public function find($id){
        return $this->kid->find($id);
    }

    public function all(){
        return $this->kid->paginate(15);
    }

    public function related(){
        $kids = Kid::join('accounts','accounts.id','=','kids.account_id')
            ->join('genders','genders.id','=','kids.gender')
            ->join('account_user_permission','account_user_permission.account_id','=','accounts.id')
            ->join('users','users.id','=','account_user_permission.user_id')
            ->join('permissions','permissions.id','=','account_user_permission.permission_id')

            ->where('users.id','=',Auth::id())
            ->where('permissions.allow_read','=','1')
            ->select('kids.*',
                'genders.name as kid_gender',
                'accounts.id as kid_account_id',
                'accounts.name as kid_account',
                'accounts.avatar as account_avatar')
            ->orderby('permissions.id','asc')
            ->orderby('kids.birth_date', 'asc')
            ->paginate(15);
        return $kids;
    }

    public function store($attributes){
        $newKid = new Kid($attributes);
        $newKid->save();
        return $newKid;
    }

    public function update($id, array $attributes){
        return $this->kid->find($id)->update($attributes);
    }

    public function delete($id){
        return $this->kid->find($id)->delete();
    }
}
