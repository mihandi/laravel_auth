<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    const PAGINATION = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsersByRequest(Request $request) {

        if (!empty($request->get('sort_by'))  && !empty($request->get('sort_type'))) {
            $sort_by = $request->get('sort_by');
            $sort_type = $request->get('sort_type');
        } else {
            $sort_by = 'id';
            $sort_type = 'desc';
        }

        $conditioins = [];

        if(!empty($request->get('s_id'))) {
            $conditioins['users.id'] = $request->get('s_id');
        }

        if(!empty($request->get('s_name'))) {
            $conditioins[] = ['users.name', 'like', '%'. $request->get('s_name').'%'];
        }

        if(!empty($request->get('s_email'))) {
            $conditioins[] = ['users.email', 'like', '%'. $request->get('s_email').'%'];
        }

        $users = User::select('*')
            ->where($conditioins)
            ->groupBy('users.id')
            ->orderBy($sort_by, $sort_type)
            ->paginate(User::PAGINATION);

        return $users;
    }
}
