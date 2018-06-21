<?php

namespace App\Http\Controllers\Auth;

use App\Models\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        session()->forget('code');
        $this->validateLogin($request);
        //retrieveByCredentials
        if ($user = app('auth')->getProvider()->retrieveByCredentials($request->only('email', 'password'))) {

            $token = Otp::create([
                'user_id' => $user->id
            ]);

            if ($token->sendCode()) {
                session()->put("token_id", $token->id);
                session()->put("user_id", $user->id);
                session()->put("remember", $request->get('remember'));
                return redirect("verify-otp");
            }
            $token->delete();// delete token because it can't be sent
            return redirect('/login')->withErrors([
                "Unable to send verification code"
            ]);
        }

        return redirect()->back()
            ->withInputs()
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }
    /**
     * Show second factor form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showCodeForm()
    {
        if (! session()->has("token_id")) {
            return redirect("login");
        }
        return view("auth.verifyotp");
    }
    /**
     * Store and verify user second factor.
     */
    public function storeCodeForm(Request $request)
    {
        // throttle for too many attempts
        if (!session()->has("token_id", "user_id")) {
            return redirect("login");
        }

        $otp = Otp::find(session()->get("token_id"));

        if (!$otp || !$otp->isValid() || $request->code !== $otp->code ||(int)session()->get("user_id") !== $otp->user->id) {
            return redirect("verify-otp")->withErrors(["Invalid token"]);
        }

        $otp->used = true;
        $otp->save();

        $this->guard()->login($otp->user, session()->get('remember', false));
        session()->forget('token_id', 'user_id', 'remember');

        return redirect('user');
    }

}
