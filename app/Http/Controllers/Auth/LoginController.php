<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\redirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user): RedirectResponse
    {

        $user = User::with('hasRoleAll')->find(Auth::user()->id);
        $role = $user->hasRoleAll->role_id;

        if ($role == 1) {
            return redirect()->route('ownerHome');
        } elseif ($role == 2) {
            return redirect()->route('homeAdmin');
        } elseif ($role == 3) {
            return redirect()->route('homeSubAdmin');
        } elseif ($role == 4) {
            return redirect()->route('homeDoctor');
        } elseif ($role == 5) {
            return redirect()->route('homePatient');
        } elseif ($role == 6) {
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }

    }

}

