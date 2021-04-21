<div class="w-75 mx-auto my-auto">
    <h1 class="text-center py-3">Selamat Datang !</h1>
    <div class="w-50 h-50 mx-auto rounded-3 border border-primary">
        <h2 class="text-center py-2">Daftar Akun</h2>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Username</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="Username" name="Username">
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$username'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Email</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="Email">
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$email'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Nomor Handphone</label>
            <div class="col-sm-7">
            <input type="number" class="form-control" id="Nomor">
            </div>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-7">
            <select name="Jenis_Kelamin" class="form-select" aria-label="Default select example">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            </div>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-7">
            <input type="date" class="form-control" id="TTL">
            </div>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="staticEmail" class="col-sm-5 col-form-label">Foto Profil</label>
            <div class="col-sm-7">
            <input class="form-control" type="file" id="Foto">
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$foto'</label>
        </div>
        
        <div class="mb-3 row mx-auto w-75">
            <label for="inputPassword" class="col-sm-5 col-form-label">Password</label>
            <div class="col-sm-7">
            <input type="password" class="form-control" id="Password">
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$pw'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="inputPassword" class="col-sm-5 col-form-label">Ulangi Password</label>
            <div class="col-sm-7">
            <input type="password" class="form-control" id="Password">
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$cpw'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi diri</label>
            <div class="col-sm">
                <textarea class="form-control" id="Deskripsi" rows="3"></textarea>
            </div>
            <label for="staticEmail" class="alert alert-danger" role="alert">'.$des'</label>
        </div>
        <div class="mb-3 row mx-auto w-75">
            <div class="col-sm-1">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked required>
            </div>
            <label for="inputPassword" class="col-sm-11 col-form-label">Saya setuju dengan syarat dan ketentuan yang berlaku !</label>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary w-50 mx-auto mb-3" type="button">Daftar</button>
        </div>

    </div>