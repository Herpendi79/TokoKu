<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function cek_login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Cek role user
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->intended('/user/dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('Auth.register');
    }

    public function lupaPassword()
    {
        return view('Auth.lupa_password');
    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.forget_password');
        } elseif ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'no_hp' => 'required|string',
            ]);
            $email = $request->input('email');
            $no_hp = $request->input('no_hp');
            $anggota = User::where('email', $email)->where('no_hp', $no_hp)->first();

            if (!$anggota) {
                return redirect()->back()->withErrors([
                    'email' => 'Email atau nomor HP tidak ditemukan.',
                ]);
            }
            // bikin token reset password
            $token = bin2hex(random_bytes(3)); // Membuat token acak

            // ubah password
            $anggota->password = bcrypt($token); // Simpan token sebagai password baru
            $anggota->save();

            $message = "Halo " . $anggota->name . " 👋,\n\n" .
                "Kami menerima permintaan untuk mengatur ulang password akun Anda. Jika Anda tidak meminta ini, abaikan pesan ini.\n\n" .
                "Berikut adalah *password baru* Anda: ✌️:\n\n" .
                "" . $token . "\n\n" .
                "📝 Silakan masuk ke akun Anda dengan password baru ini dan ubah password Anda segera setelah login sistem.\n\n" .
                "Selamat Berbelanja\n\n" .
                "Salam,  *Tim ADAKSI*";

            // Kirim pesan ke semua admin
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $anggota->no_hp,
                    'message' => $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: szrYmqtfHMMnUeE7kgrf'
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                // Jika error, log atau tampilkan
                Log::error('WhatsApp API Error: ' . $error_msg);
            }
            curl_close($curl);
            // arahkan ke login
            return redirect('/login')->with('success', 'Permintaan reset password berhasil. Silakan cek WhatsApp Anda untuk mendapatkan password baru.');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru dengan role 'user'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Set role default sebagai 'user'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::whereEmail($googleUser->email)->first();

        if (!$user) {
            return redirect('/login')->withErrors([
                'email' => 'Email tidak terdaftar. Silakan daftar anggota terlebih dahulu.',
            ]);
        }

        Auth::login($user);
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif (Auth::user()->role === 'user') {
            return redirect()->intended('/user/dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Role tidak dikenali.']);
        }
    }
}
