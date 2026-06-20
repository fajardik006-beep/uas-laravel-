<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ... baris kode validasi di atas ...

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // ==== TAMBAHKAN LOGIKA MESIN OTOMATIS INI ====
    if ($request->filled('ref_id')) {
        // Cari siapa user yang membagikan link tersebut
        $referrer = User::find($request->ref_id);
        
        // Jika user pengundang ditemukan, tambahkan 100 poin ke akunnya
        if ($referrer) {
            $referrer->increment('poin', 100);
        }
    }
    // =============================================

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard', absolute: false));;
    }
    
}
