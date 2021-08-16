<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CheckInRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SaveProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) 
    {
        $this->user=$user;
    }

    public function getLogin() 
    {
        if ($this->user->getCurrent()) {
            return redirect()->route('feed');
        }

        return view('home.login');
    }    
    
    public function postLogin(LoginRequest $request) 
    {
        $response=$this->user->postLogin($request);
        
        if ($response) {
            return redirect()->route('feed');
        } else {
            return redirect()->route('login')->withInput()->withErrors('La contraseña que has ingresado es incorrecta.');
        }
    }

    public function logout() 
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function getFeed()
    {
        return view('main.feed', ['menu_active' => 'feed']);
    }    

    public function getProfile() 
    {
        return view('user.profile',['menu_active' => 'profile']);
    }

    public function saveProfile(SaveProfileRequest $request) {
        $this->user->saveProfile($request);
        return redirect()->route('get_profile')->with(['message_info'=>'Perfil actualizado exitosamente.']);
    }

    public function checkNationality(Request $request)
    {
        return response()->json($this->user->checkNationality($request));
    }

    public function getCheckIn() 
    {
        if ($this->user->getCurrent()) {
            return redirect()->route('feed');
        }

        return view('home.check_in');
    }     
    
    public function postCheckIn(CheckInRequest $request) 
    {
        $this->user->checkIn($request);
        return redirect()->route('login')->with(['message_info'=>'Te has registrado exitosamente, a continuación puedes iniciar sesión.']);
    }
}
