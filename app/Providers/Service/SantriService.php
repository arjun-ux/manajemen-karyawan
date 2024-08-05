<?php

namespace App\Providers\Service;

use App\Http\Requests\SantriRequest;
use App\Models\Berkas;
use App\Models\OrangTua;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Saba;
use App\Models\SabaMasukPondok;
use App\Models\User;
use App\Models\WaliSaba;
use App\Providers\RouteParamService as routeParam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Providers\Service\WhatsAppService;
use Illuminate\Support\Facades\Hash;
use App\Providers\Service\IndoRegionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SantriService extends ServiceProvider
{
    protected $request;
    // get santri by nis
    public static function get_santri_nis($nis){
        $data = Saba::query()->where('nis',$nis)->first(['id','nama_lengkap','nis']);
        if ($data == null) {
            return response()->json(['message'=>'Data Tidak Ditemukan']);
        }
        return $data;
    }
    // get santri by id nya saja
    public static function get_santri_id($id){
        return Saba::query()->firstWhere('id', $id);
    }
    // get santri saudara kandung untuk invoice spp
    public static function get_santri_SPP(){
        return Saba::query()
                    ->where('saudara_kandung', 'TIDAK')
                    ->whereNot('status','Register')
                    // ->where('status','Pending')
                    ->get(['id','nis','nama_lengkap','status']);
    }
    // get santri bukan saudara kandung untuk invoice spp
    public static function santriSPPKK(){
        return Saba::query()
                    ->where('saudara_kandung', 'YA')
                    ->whereNot('status','Register')
                    // ->where('status','Pending')
                    ->get(['id','nis','nama_lengkap','status']);
    }
    // get santri for create tagihan
    public static function getSantri($nis){
        $data = Saba::query()->where('nis', $nis)->first(['id','nis','nama_lengkap','status']);
        return $data;
    }
    // getAllData
    public static function getAll(){
        try {
            $data = Saba::query(['id','nis','nama_lengkap','status'])->whereNot('status','Boyong')->orderBy('id', "desc");
            if (!$data) {
                throw new \Exception("Data Tidak ditemukan");
            }
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // get santri by id
    public static function getById($id){
        try {
            $saba = Saba::query()->where('id', $id)->first();
            if (!$saba) {
                throw new \Exception("Data with ID $id not found in Saba table.");
            }
            $ortu = OrangTua::query()->where('saba_id', $id)->first();
            if (!$ortu) {
                throw new \Exception("Data Orang Tua Tidak Ditemukan Dengan Santri ID $id.");
            }
            $provinsi = IndoRegionService::Provinsi();
            $wali = WaliSaba::query()->where('saba_id', $id)->first();
            $pendidikanA = PendidikanService::getPendidikan($ortu->pendidikan_ayah);
            $pekerjaanA = PekerjaanService::getPekerjaan($ortu->pekerjaan_ayah);
            $pendidikanI = PendidikanService::getPendidikan($ortu->pendidikan_ibu);
            $pekerjaanI = PekerjaanService::getPekerjaan($ortu->pekerjaan_ibu);
            $pekerjaan = Pekerjaan::query()->get(['id', 'nama_pekerjaan']);
            $pendidikan = Pendidikan::query()->get(['id', 'nama_pendidikan']);
            $asal_sekolah = SabaMasukPondok::query()->where('saba_id', $id)->first();
            $kamar = SettingsService::get_all_kamar()->get();
            $kamarsaba = SettingsService::getDataById($saba->kamar_id);
            $results = [
                'saba' => $saba,
                'ortu' => $ortu,
                'provinsi' => $provinsi,
                'wali' => $wali,
                'pendidikanA' => $pendidikanA,
                'pekerjaanA' => $pekerjaanA,
                'pendidikanI' => $pendidikanI,
                'pekerjaanI' => $pekerjaanI,
                'pekerjaan' => $pekerjaan,
                'pendidikan' => $pendidikan,
                'asal_sekolah' => $asal_sekolah,
                'kamar' => $kamar,
                'kamarsaba' => $kamarsaba,
            ];
            // echo json_encode($results);
            // exit();
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // lihat santri
    public static function lihatSantri($id){
        try {
            $data = Saba::where('id', $id)->first();
            if (!$data) {
                throw new \Exception("Data Santri Dengan ID $id tidak ditemukan");
            }
            $provinsi = IndoRegionService::getProvinsi($data->provinsi);
            $kabupaten = IndoRegionService::getKota($data->kabupaten);
            $kecamatan = IndoRegionService::getKecamatan($data->kecamatan);
            $desa = IndoRegionService::getDesa($data->desa);
            $ortu = OrangTua::where('saba_id', $id)->first();
            if (!$ortu) {
                throw new \Exception("Data Orang Tua untuk Santri dengan ID $id tidak ditemukan.");
            }
            $pendidikanA = PendidikanService::getPendidikan($ortu->pendidikan_ayah);
            $pekerjaanA = PekerjaanService::getPekerjaan($ortu->pekerjaan_ayah);
            $pendidikanI = PendidikanService::getPendidikan($ortu->pendidikan_ibu);
            $pekerjaanI = PekerjaanService::getPekerjaan($ortu->pekerjaan_ibu);
            $wali = WaliSaba::where('saba_id', $id)->first();
            $asal_sekolah = SabaMasukPondok::where('id', $id)->first();
            $foto = Berkas::query()->where('saba_id', $id)->first('foto');
            $kamarsaba = SettingsService::getDataById($data->kamar_id);
            $results = [
                'data' => $data,
                'provinsi'=>$provinsi,
                'kabupaten'=>$kabupaten,
                'kecamatan'=>$kecamatan,
                'desa'=>$desa,
                'ortu' => $ortu,
                'pendidikanA' => $pendidikanA,
                'pekerjaanA' => $pekerjaanA,
                'pendidikanI' => $pendidikanI,
                'pekerjaanI' => $pekerjaanI,
                'wali' => $wali,
                'asal_sekolah' => $asal_sekolah,
                'foto' => $foto,
                'kamarsaba' => $kamarsaba,
            ];
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // get berkas
    public static function getBerkas($sid){
        try {
            $berkas = Berkas::query(['foto','kk','ktp_ortu','ktp_wali'])->where('saba_id',$sid)->first();
            if (!$berkas) {
                throw new \Exception("Data Berkas Milik santri ID $sid Tidak ditemukan");
            }
            return $berkas;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // create saba
    public static function StoreSantri(SantriRequest $request){
        try {
            DB::beginTransaction();
            $tgl = Carbon::parse($request->tanggal_lahir)->format('dmy'); // ex hasil tanggal. 1501724
            $user = User::create([
                'username' => Saba::generateNis(),
                'name' => $request->nama_lengkap,
                'no_wa' => $request->no_wa,
                'password' => Hash::make($tgl),
                'role' => 'saba'
            ]);
            if (!$user) {
                throw new \Exception("Gagal membuat user untuk Santri ini");
            }
            $santri = Saba::create([
                'user_id' => $user->id,
                'nis' => $user->username,
                'nik' => $request->nik,
                'nokk' => $request->nokk,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'saudara_kandung' => $request->saudara_kandung ? $request->saudara_kandung : 'TIDAK',
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'dusun' => $request->dusun,
                'rt_rw' => $request->rt_rw,
                'alamat' => $request->alamat,
                'status' => 'Register',
            ]);
            if (!$santri) {
                throw new \Exception("Gagal membuat data Orang Tua");
            }
            $ortu = OrangTua::create([
                'saba_id' => $santri->id,
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'nik_ibu' => $request->nik_ibu,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
            ]);
            SabaMasukPondok::create([
                'saba_id' => $santri->id,
                'tanggal_masuk' => now(),
                'asal_sekolah' => $request->asal_sekolah,
                'alamat_asal_sekolah' => $request->alamat_asal_sekolah,
                'diterima_dikelas' => $request->diterima_dikelas,
                'no_surat_pindah' => $request->no_surat_pindah,
            ]);
            if ($request->wali === 'Ayah') {
                WaliSaba::create([
                    'saba_id' => $ortu->saba_id,
                    'nama_wali' => $ortu->nama_ayah,
                    'no_hp_wali' => $ortu->no_hp_ayah,
                    'kedudukan_dalam_keluarga' => "Ayah",
                    'alamat_wali' => 'Sama Dengan Anak'
                ]);
            }elseif($request->wali === 'Ibu'){
                WaliSaba::create([
                    'saba_id' => $ortu->saba_id,
                    'nama_wali' => $ortu->nama_ibu,
                    'no_hp_wali' => $ortu->no_hp_ibu,
                    'kedudukan_dalam_keluarga' => "Ibu",
                    'alamat_wali' => 'Sama Dengan Anak'
                ]);
            }elseif ($request->wali === 'Wali') {
                WaliSaba::create([
                    'saba_id' => $santri->id,
                    'nama_wali' => $request->nama_wali,
                    'kedudukan_dalam_keluarga' => 'Wali',
                    'alamat_wali' => $request->alamat_wali,
                    'no_hp_wali' => $request->no_hp_wali,
                ]);
            }else {
                throw new \Exception("Ada Kesalahan Dalam Menyimpan Data Wali");
            }
            // send notif by wa
            // if ($request->no_wa) {
            //     $numberTarget = $request->no_wa;
            //     $message = 'Berikut Username Untuk Login Anda '.$santri->nis.', atas nama '.$santri->nama_lengkap.'.';
            //     WhatsAppService::sendNotif($numberTarget, $message);
            // }
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Input Data',
                'data' => $santri,
            ]);
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            throw $th;
        }
    }
    // berkas store
    public static function storeBerkas($request){
        $data = Saba::where('id', $request->idSaba)->first(['nama_lengkap']);
        $nama_lengkap = $data->nama_lengkap;
        $replace_name = str_replace(' ','_', $nama_lengkap);

        $foto = null;
        $kk = null;
        $ktp_ortu = null;
        $ktp_wali = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = 'fotos/'.'FOTO'.'_'. $replace_name .'.'. $file->getClientOriginalExtension();
            $foto = $file->store($name, 'public');
        }else{
            $foto = $request->foto;
        }
        if ($request->hasFile('kk')) {
            $file = $request->file('kk');
            $name = 'kks/'.'KK'.'_'. $replace_name .'.'. $file->getClientOriginalExtension();
            $kk = $file->store($name, 'public');
        }else{
            $kk = $request->kk;
        }
        if ($request->hasFile('ktp_ortu')) {
            $file = $request->file('ktp_ortu');
            $name = 'ktp_ortus/'.'KTP_ORTU'.'_'. $replace_name .'.'. $file->getClientOriginalExtension();
            $ktp_ortu = $file->store($name, 'public');
        }else{
            $ktp_ortu = $request->ktp_ortu;
        }
        if ($request->hasFile('ktp_wali')) {
            $file = $request->file('ktp_wali');
            $name = 'ktp_walis/'.'KTP_WALI'.'_'. $replace_name .'.'. $file->getClientOriginalExtension();
            $ktp_wali = $file->store($name, 'public');
        }else{
            $ktp_wali = $request->ktp_wali;
        }

        $berkas = new Berkas();
        $berkas->saba_id = $request->idSaba;
        $berkas->foto = $foto;
        $berkas->kk = $kk;
        $berkas->ktp_ortu = $ktp_ortu;
        $berkas->ktp_wali = $ktp_wali;
        $berkas->save();

        return response()->json(['message'=>'Berhasil Upload File','data'=>$berkas]);
    }
    // update saba
    public static function updateSantri(SantriRequest $request, $id){
        $id = routeParam::decode($id);
        try {
            $saba = Saba::where('id', $id)->first();
            $saba->update([
                'nik' => $request->nik,
                'nokk' => $request->nokk,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'dusun' => $request->dusun,
                'rt_rw' => $request->rt_rw,
                'alamat' => $request->alamat,
            ]);
            $ortu = OrangTua::query()->where('saba_id',$saba->id)->first();
            $ortu->update([
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'nik_ibu' => $request->nik_ibu,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
            ]);
            $asal_sekolah = SabaMasukPondok::query()->where('saba_id', $saba->id)->first();
            $asal_sekolah->update([
                'asal_sekolah' => $request->asal_sekolah,
                'alamat_asal_sekolah' => $request->alamat_asal_sekolah,
                'diterima_dikelas' => $request->diterima_dikelas,
                'no_surat_pindah' => $request->no_surat_pindah,
            ]);
            $wali = WaliSaba::query()->where('saba_id', $saba->id)->first();

            if ($request->kedudukan_dalam_keluarga === 'Ayah') {
                $wali->update([
                    'saba_id' => $saba->id,
                    'nama_wali' => $ortu->nama_ayah,
                    'no_hp_wali' => $ortu->no_hp_ayah,
                    'kedudukan_dalam_keluarga' => "Ayah",
                    'alamat_wali' => 'Sama Dengan Anak'
                ]);
            }elseif($request->kedudukan_dalam_keluarga === 'Ibu'){
                $wali->update([
                    'saba_id' => $saba->id,
                    'nama_wali' => $ortu->nama_ibu,
                    'no_hp_wali' => $ortu->no_hp_ibu,
                    'kedudukan_dalam_keluarga' => "Ibu",
                    'alamat_wali' => 'Sama Dengan Anak'
                ]);
            }elseif ($request->kedudukan_dalam_keluarga === 'Wali') {
                $wali->update([
                    'saba_id' => $saba->id,
                    'nama_wali' => $request->nama_wali,
                    'kedudukan_dalam_keluarga' => 'Wali',
                    'alamat_wali' => $request->alamat_wali,
                    'no_hp_wali' => $request->no_hp_wali,
                ]);
            }

        return response()->json(['status' => 201,'message' => 'Data Berhasil di Ubah',]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // update berkas
    public static function update_berkas(Request $request){

        $berkasAda = Berkas::where('saba_id', $request->sid)->first();
        if ($berkasAda) {
            $path_foto = $berkasAda->foto;
            $path_kk = $berkasAda->kk;
            $path_ktp_ortu = $berkasAda->ktp_ortu;
            $path_ktp_wali = $berkasAda->ktp_wali;
        }
        $foto=$path_foto;
        $kk=$path_kk;
        $ktp_ortu=$path_ktp_ortu;
        $ktp_wali=$path_ktp_wali;

        if ($request->hasFile('foto')) {
            if ($path_foto) {
                Storage::delete('public/' . $path_foto);
                $file = $request->file('foto');
                $foto = $file->store($path_foto, 'public');
            }
        }else{
            $foto = $path_foto;
        }
        if ($request->hasFile('kk')) {
            if ($path_kk) {
                Storage::delete('public/' . $path_kk);
                $file = $request->file('kk');
                $kk = $file->store($path_kk, 'public');
            }
        }else{
            $kk = $path_kk;
        }
        if ($request->hasFile('ktp_ortu')) {
            if ($path_ktp_ortu) {
                Storage::delete('public/' . $path_ktp_ortu);
                $file = $request->file('ktp_ortu');
                $ktp_ortu = $file->store($path_ktp_ortu, 'public');
            }
        }else{
            $ktp_ortu = $path_ktp_ortu;
        }
        if ($request->hasFile('ktp_wali')) {
            if ($path_ktp_wali) {
                Storage::delete('public/' . $path_ktp_wali);
                $file = $request->file('ktp_wali');
                $ktp_wali = $file->store($path_ktp_wali,'public');
            }
        }else{
            $ktp_wali = $path_ktp_wali;
        }

        // update berkas
        $berkasAda->update([
            'foto' => $foto,
            'kk' => $kk,
            'ktp_ortu' => $ktp_ortu,
            'ktp_wali' => $ktp_wali,
        ]);

        return response()->json(['message'=>'Berhasil Update Berkas']);
    }
}
