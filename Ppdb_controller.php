```bash
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
    ```
