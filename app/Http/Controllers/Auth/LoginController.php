<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    // protected $redirectTo = '/admin/dashboard';

    /**
     * Validate the user login request.
     * Overrides default to check franchise-specific credentials
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if franchise is selected in session
        $selectedFranchiseId = session('selected_franchise_id');
        
        if (!$selectedFranchiseId) {
            return redirect()->route('franchises.index')
                ->with('error', 'Please select a franchise first.');
        }
    }

    /**
     * Attempt to log the user into the application.
     * Overrides default to validate franchise-specific access
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $selectedFranchiseId = session('selected_franchise_id');

        // Find user by email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return false;
        }

        // Check if user belongs to the selected franchise
        // Super admin (franchise_id = null) can access any franchise
        if ($user->franchise_id !== null && $user->franchise_id != $selectedFranchiseId) {
            return false;
        }

        // Attempt login with credentials
        return Auth::attempt(
            $credentials,
            $request->filled('remember')
        );
    }

    /**
     * The user has been authenticated.
     * Store franchise info in session after successful login
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Store the franchise_id in session for filtering data
        if ($user->franchise_id) {
            session(['franchise_id' => $user->franchise_id]);
        } else {
            // Super admin uses the selected franchise from session
            session(['franchise_id' => session('selected_franchise_id')]);
        }

        return redirect('/admin/dashboard');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $selectedFranchiseId = session('selected_franchise_id');
        $user = User::where('email', $request->input($this->username()))->first();

        if ($user && $user->franchise_id !== null && $user->franchise_id != $selectedFranchiseId) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'These credentials do not match our records for this franchise.',
                ]);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => trans('auth.failed'),
            ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the application's login form.
     * Pass franchise info to the view
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $franchise = session('franchise');
        $franchiseName = session('selected_franchise_name');
        
        return view('auth.login', compact('franchise', 'franchiseName'));
    }
}
