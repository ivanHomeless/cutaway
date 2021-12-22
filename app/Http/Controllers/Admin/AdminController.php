<?php


namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin/dashboard';

    /**
     * Main admin page
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * @inheritDoc
     */
    public function username()
    {
        return 'username';
    }

    /**
     * @inheritDoc
     */
    public function showLoginForm()
    {
        if (Auth::user() && Auth::user()->isAdmin) {
            return redirect($this->redirectTo);
        }
        return view('admin.login');
    }

}
