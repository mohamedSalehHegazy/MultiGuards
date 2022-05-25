<?php
namespace App\Http\Controllers\User\Web;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserWebAuthController extends Controller
{
    /**
     * logout User 
     */
    public function logout()
    {

        try {
            auth()->logout();
            return redirect('/userWeb/logout')->with('success', 'Logged out');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }

    }

    /**
     * Gets User login form 
     */
    public function loginView()
    {
        try {
            return view('user.auth.login');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }
    /**
     * User login
     */
    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->except('_token'))){
            session()->regenerate();
            return redirect(route('user.products.web.index'))->with('success', 'Logged In');
        }
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }
}