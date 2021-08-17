<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'birthday',
        'nationality',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public static function getCurrent() 
    {
        if (Auth::check()) {
            return Auth::user();
        }
        return false;
    }

    public function postLogin($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return true;
        }

        return false;
    }

    public function saveProfile($request)
    {
        $this->where('id',$request->user_id)->update([
            'full_name'   => $request->full_name,
            'birthday'    => $request->birthday,
            'nationality' => $request->nationality,
        ]);

        return true;
    }

    public function checkNationality($request)
    {
        $response = [];
                    
        if ($request->nationality) {

            $countries = file_get_contents('countries.json');
            $countries = json_decode($countries);

            foreach ($countries as $country) {
                $country = $country->translations->es;
                $search = $request->nationality;

                if (stripos($country, $search) !== false) {
                    $response[] = $country;
                }
            }

            sort($response);
        }

        return ['response' => $response];
    }

    public function checkIn($request)
    {
        $this->create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('publisher');

        return true;
    }
}