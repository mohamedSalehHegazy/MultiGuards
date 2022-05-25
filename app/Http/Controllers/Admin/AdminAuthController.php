<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * logout admin 
     */
    public function logout()
    {

        try {
            auth()->guard('admin')->logout();
            return redirect('/admin/logout')->with('success', 'Logged out');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }

    }

    /**
     * Gets admin login form 
     */
    public function loginView()
    {
        try {
            return view('admin.auth.login');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }


    /**
     * Admin login
     */
    public function login(LoginRequest $request)
    {
            if(auth()->guard('admin')->attempt($request->except('_token'))){
                session()->regenerate();
                redirect()->intended('admin/categories');
            }

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
    }
}