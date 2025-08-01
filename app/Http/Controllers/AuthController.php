<?php namespace App\Http\Controllers;
 
use Auth;
use Illuminate\Routing\Controller;
 
class AuthController extends Controller {
 
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('dashboard');
        }
    }
 
}