<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{

    public function showChangePasswordForm(){

        return view('auth.change-password');
    }

    public function change(ChangePasswordRequest $request)
    {
        $request->save();

        return redirect('/home')
            ->with('success', __('validation.change-password.confirmed-changes'))
            ->with('title', __('validation.change-password.title-confirmed-changes'));
    }


}
