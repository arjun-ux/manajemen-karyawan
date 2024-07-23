<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Saba;
use App\Providers\Service\WhatsAppService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $whatsAppService;
    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }
    // index register
    public function register()
    {
        return view('cadangan');
        // return view('auth.register');
    }
    // function doRegister santri baru
    public function doRegister(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'no_wa' => 'required',
            'password' => 'required|min:6',
        ],[
            'nama_lengkap.required' => 'Nama Lengkap Wajib Di Isi',
            'no_wa.required' => 'Nama Lengkap Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
            'password.min' => 'Password Minimal 6 Karakter',
        ]);
        if ($request) {
            $sabaUser = User::create([
                'username'=> Saba::generateNis(),
                'no_wa'=>$request->no_wa,
                'password'=>$request->password,
                'role' => 'saba'
            ]);
            $saba = Saba::create([
                'nis' => Saba::generateNis(),
                'user_id' => $sabaUser->id,
                'nama_lengkap' => $request->nama_lengkap,
                'status' => 'Register',
                'saudara_kandung' => 'TIDAK',
            ]);
            // Notif Wa
            $numberTarget = $request->no_wa;
            $message = 'Registrasi Berhasil. Berikut Username Untuk Login Anda '.$saba->nis.', atas nama '.$saba->nama_lengkap.'.';
            $this->whatsAppService->sendNotif($numberTarget, $message);
            return redirect()->route("login")->with('success','Registrasi Berhasil');
        }
        return back();
    }
}
