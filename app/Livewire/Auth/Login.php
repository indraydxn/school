<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
#[Layout('components.layouts.base')]

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $validator = Validator::make([
            'email'    => $this->email,
            'password' => $this->password,
        ], [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                noty()->error($error);
            }
            return;
        }

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            noty()->error('Email tidak terdaftar!');
            return redirect()->route('login');
        }

        if ($user->status != 1) {
            noty()->error('Akun Anda tidak aktif!');
            return redirect()->route('login');
        }

        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            Auth::user()->update([
                'login_terakhir' => now(),
            ]);

            if (Auth::user()->hasRole('admin')) {
                noty()->success('Anda berhasil login!');
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                noty()->error('Anda tidak memiliki akses ke halaman admin');
                return redirect()->route('login');
            }
        }

        noty()->error('Password salah!');

        $this->reset('password');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        noty()->success('Anda berhasil logout!');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('pages.auth.login');
    }
}
