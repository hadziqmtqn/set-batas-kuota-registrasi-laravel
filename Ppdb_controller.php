<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Profile_sekolah;
use App\Models\Limit_peserta;
use App\Models\Status_daftar;

class Ppdb_controller extends Controller
{
    public function index(){
        $title = 'Daftar Akun PPDB Online';
        $profile = Profile_sekolah::get();
        $status = Status_daftar::get();
        $cek_status = Status_daftar::count();

        $tahun_now = date('Y');
        $limit = Limit_peserta::where('tahun',$tahun_now)->first();

        if($limit){
            $batas = $limit->limit;
            $hitung = User::whereYear('tanggal_buat',date('Y'))->whereNull('role')->count();
            // dd($batas);
            if($hitung >= $batas){
                $cek = 'kosong';
            }else{
                $cek = 'ada';
            }
        }

        return view('ppdb.index',compact('title','cek','profile','status','cek_status'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama'=>'required|min:5',
            'nisn',
            'email'=>'required|email|unique:users',
            'photo' => 'file|mimes:jpeg,jpg,png|max:3072',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $data['name'] = $request->nama;
        $data['nisn'] = $request->nisn;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['id_registrasi'] = 'PPDB-'.date('YmdHis');
        $data['tanggal_buat'] = date('Y-m-d H:i:s');

        $file = $request->file('photo');
        if($file){
            $nama_file = rand().'-'. $file->getClientOriginalName();
            $file->move('uploads',$nama_file);
            $data['photo'] = 'uploads/' .$nama_file;
        }

        User::insert($data);

        \Session::flash('berhasil','Pendaftaran akun berhasil, silahkan Login/Masuk dan lengkapi biodata siswa');

        return redirect('login');
    }
}
