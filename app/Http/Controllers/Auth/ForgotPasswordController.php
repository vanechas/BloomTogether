<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.forgot-password');
    }

    public function reset(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => [
                'required', 
                'confirmed',
                Password::min(8)->numbers()->symbols()
            ],
        ]);

        $user = User::where('email', $validated['email'])->first();
        $user->update(['password' => Hash::make($validated['password'])]);

        return redirect('/login')
            ->with('success', 'Password Reset! 🔑 Your password has been updated. Please login.');
    }
}