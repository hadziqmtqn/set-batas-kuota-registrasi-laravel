<div class="register-box">

    @if($cek == 'kosong')
    <div class="container text-center">
        <div class="alert alert-danger alert-dismissible">
            <h3><i class="icon fa fa-ban"></i> Peringatan!</h3>
            <h3>Maaf Pendaftaran saat ini belum tersedia</h3>
        </div>
    </div>
    @else
    <section class="content">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                @foreach($status as $stts)
                @if($stts->status == 1)
                <div class="register-box-body">
                    <div class="register-logo">
                        @foreach($profile as $prof)
                        <center><a href="/"><img src="{{ asset($prof->logo) }}" width="150px"></a></center>
                        @endforeach
                    </div>
                    <p class="login-box-msg">{{ $title }}</p>
                    @if(Session::has('berhasil'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                        {{ Session::get('berhasil') }}
                    </div>
                    @endif

                    @if(Session::has('gagal'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                        {{ Session::get('gagal') }}
                    </div>
                    @endif

                    <form role="form" method="post" action="{{ url('daftar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label for="">Nama Lengkap <span class="text-red">*</span></label>
                            <input autocomplete="off" type="text" name="nama" class="form-control" placeholder="Nama Lengkap (wajib diisi)" value="{{old('nama')}}" required>
                        </div>
                        @if($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif

                        <div class="form-group {{ $errors->has('nisn') ? 'has-error' : '' }}">
                            <label for="">NISN</label>
                            <input autocomplete="off" type="number" name="nisn" class="form-control" placeholder="NISN (jika ada)" value="{{old('nisn')}}">
                        </div>
                        @if($errors->has('nisn'))
                        <span class="help-block">{{$errors->first('nisn')}}</span>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="">Email <span class="text-red">*</span></label>
                            <input autocomplete="off" type="email" name="email" class="form-control" placeholder="Email (wajib diisi)" value="{{old('email')}}" required>
                        </div>
                        @if($errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                        @endif

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="">Kata Sandi <span class="text-red">*</span></label>
                            <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Kata Sandi (wajib diisi)" required>
                        </div>
                        @if($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                        @endif

                        <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                            <label for="">Ulangi Kata Sandi <span class="text-red">*</span></label>
                            <input autocomplete="off" type="password" name="confirm_password" class="form-control" placeholder="Ulangi Kata Sandi (wajib diisi)" required>
                        </div>
                        @if($errors->has('confirm_password'))
                        <span class="help-block">{{$errors->first('confirm_password')}}</span>
                        @endif

                        <div class="form-group">
                            <label for="">Upload Foto Profil</label>
                            <input autocomplete="off" type="file" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <b>Ket:</b> Ukuran foto maksimal 1MB<br>
                            </div>
                        </div>
                    </form>
                    <a href="/login" class="text-center">Saya sudah punya akun</a>
                </div>
                @else
                <h4>
                    <div class="alert alert-danger alert-dismissible">
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        Maaf, Pendaftaran saat ditutup
                    </div>
                    @endif
                </h4>
                @endforeach

            </div>
            <div class="col-md-3">

            </div>
        </div>
    </section>
    @endif
    
</div>
