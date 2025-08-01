<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Darryldecode\Cart\Validators\Validator;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';
    

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        
        return 'login';
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginHemis(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'password' => 'required|string',
        ]);
        // $client = new Client();
        // $response = $client->post(env('HEMIS_BASE_URL').'rest/v1/auth/login', [
        //     \GuzzleHttp\RequestOptions::JSON => ['login' => $request->input('student_id'), 'password'=>$request->input('password')]
        // ]);
        $response = Http::post(env('HEMIS_BASE_URL').'rest/v1/auth/login', ['login' => $request->input('student_id'), 'password'=>$request->input('password')]);
        if ($response->getStatusCode()==200){
            echo "OOOOOOOOOOOOOOOOOK";
            $dataRes =$response->json();
            $responseData = Http::withToken($dataRes['data']['token'])->post(env('HEMIS_BASE_URL').'rest/v1/account/me');
            dd($responseData->json());

        }else{
            echo "*******************K";
            dd($response);
        }
        
        // $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     if ($request->hasSession()) {
        //         $request->session()->put('auth.password_confirmed_at', time());
        //     }

        //     return $this->sendLoginResponse($request);
        // }

        // // If the login attempt was unsuccessful we will increment the number of attempts
        // // to login and redirect the user back to the login form. Of course, when this
        // // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);

        // return $this->sendFailedLoginResponse($request);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'login' => 'required',
    //         'password' => 'required',
    //     ]);
     
    //     $credentials = $request->only('login', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return app()->getLocale() . '/home';

    //     }
    
    //     return redirect(app()->getLocale() . "/home")->withSuccess('Oppes! You have entered invalid credentials');
    // }


    public function redirectTo()
    {
        $roles = Auth::user()->getRoleNames()->toArray();

        if (in_array("SuperAdmin", $roles) || in_array("Admin", $roles) || in_array("Manager", $roles) || in_array("Accountant", $roles)) {
            return app()->getLocale() . '/home';
        } elseif (in_array("Author", $roles)) {
            return app()->getLocale() . '/admin/sisauthor';
        } elseif (in_array("Reader", $roles)) {
            return app()->getLocale() . '/admin/home';
        }elseif (in_array("User", $roles)) {
            return app()->getLocale() . '/admin/home';
        }
        // return app()->getLocale() . '/home';
    }
}
