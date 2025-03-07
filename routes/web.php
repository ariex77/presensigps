<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\IzinabsenController;
use App\Http\Controllers\IzincutiController;
use App\Http\Controllers\IzindinasluarController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DinasluarController;
use App\Http\Controllers\PentingController;
use App\Http\Controllers\IzinpentingController;
use App\Http\Controllers\HariliburController;
use App\Http\Controllers\IzinsakitController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, "proseslogin"]);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, "prosesloginadmin"]);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"]);
    Route::get('/proseslogout', [AuthController::class, "proseslogout"]);

    //Presensi
    Route::get('/presensi/{kode_jam_kerja}/create', [PresensiController::class, 'create']);
    Route::get('/presensi/pilihjamkerja', [PresensiController::class, 'pilihjamkerja']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //edit profile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    //histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);

    //izin absen
    Route::get('/izinabsen', [IzinabsenController::class, 'create']);
    Route::post('/izinabsen/store', [IzinabsenController::class, 'store']);
    Route::get('/izinabsen/{kode_izin}/edit', [IzinabsenController::class, 'edit']);
    Route::post('/izinabsen/{kode_izin}/update', [IzinabsenController::class, 'update']);

    //izin sakit
    Route::get('/izinsakit', [IzinsakitController::class, 'create']);
    Route::post('/izinsakit/store', [IzinsakitController::class, 'store']);
    Route::get('/izinsakit/{kode_izin}/edit', [IzinsakitController::class, 'edit']);
    Route::post('/izinsakit/{kode_izin}/update', [IzinsakitController::class, 'update']);

    //izin cuti
    Route::get('/izincuti', [IzincutiController::class, 'create']);
    Route::post('/izincuti/store', [IzincutiController::class, 'store']);
    Route::get('/izincuti/{kode_izin}/edit', [IzincutiController::class, 'edit']);
    Route::post('/izincuti/{kode_izin}/update', [IzincutiController::class, 'update']);
    Route::post('/izincuti/getmaxcuti', [IzincutiController::class, 'getmaxcuti']);

    //izin dinas luar
    Route::get('/izindinasluar', [IzindinasluarController::class, 'create']);
    Route::post('/izindinasluar/store', [IzindinasluarController::class, 'store']);
    Route::get('/izindinasluar/{kode_izin}/edit', [IzindinasluarController::class, 'edit']);
    Route::post('/izindinasluar/{kode_izin}/update', [IzindinasluarController::class, 'update']);
    Route::post('/izindinasluar/getmaxdinasluar', [IzindinasluarController::class, 'getmaxdinasluar']);

    //izinalasanpenting
    Route::get('/izinalasanpenting', [IzinpentingController::class, 'create']);
    Route::post('/izinalasanpenting/store', [IzinpentingController::class, 'store']);
    Route::get('/izinalasanpenting/{kode_izin}/edit', [IzinpentingController::class, 'edit']);
    Route::post('/izinalasanpenting/{kode_izin}/update', [IzinpentingController::class, 'update']);
    Route::post('/izinalasanpenting/getmaxdinasluar', [IzinpentingController::class, 'getmaxdinasluar']);

    Route::get('/izin/{kode_izin}/showact', [PresensiController::class, 'showact']);
    Route::get('/izin/{kode_izin}/delete', [PresensiController::class, 'deleteizin']);
});

//Route yg bisa diakses administrator dan admin bidang
Route::group(['middleware' => ['role:administrator|admin bidang,user']], function () {
    Route::get('/proseslogoutadmin', [AuthController::class, "proseslogoutadmin"]);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    //karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::get('/karyawan/{nik}/resetpassword', [KaryawanController::class, 'resetpassword']);

    //konfigurasi jam kerja
    Route::get('/konfigurasi/{nik}/setjamkerja', [KonfigurasiController::class, 'setjamkerja']);
    Route::post('/konfigurasi/storesetjamkerja', [KonfigurasiController::class, 'storesetjamkerja']);
    Route::post('/konfigurasi/updatesetjamkerja', [KonfigurasiController::class, 'updatesetjamkerja']);
    Route::post('/konfigurasi/storesetjamkerjabydate', [KonfigurasiController::class, 'storesetjamkerjabydate']);
    Route::get('/konfigurasi/{nik}/{bulan}/{tahun}/getjamkerjabydate', [KonfigurasiController::class, 'getjamkerjabydate']);
    Route::get('/konfigurasi/deletejamkerjabydate', [KonfigurasiController::class, 'deletejamkerjabydate']);

    //Presensi Monitoring
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);

    Route::post('/koreksipresensi', [PresensiController::class, 'koreksipresensi']);
    Route::post('/storekoreksipresensi', [PresensiController::class, 'storekoreksipresensi']);
});

//Route yg hanya bisa diakses administrator
Route::group(['middleware' => ['role:administrator,user']], function () {

    //karyawan

    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);
    Route::get('/karyawan/{nik}/lockandunlocklocation', [KaryawanController::class, 'lockandunlocklocation']);
    Route::get('/karyawan/{nik}/lockandunlockjamkerja', [KaryawanController::class, 'lockandunlockjamkerja']);

    //Departemen
    Route::get('/departemen', [DepartemenController::class, 'index'])->middleware('permission:view-departemen,user');;
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/{kode_dept}/update', [DepartemenController::class, 'update']);
    Route::post('/departemen/{kode_dept}/delete', [DepartemenController::class, 'delete']);

    //Presensi
    Route::post('/presensi/approveizinsakit', [PresensiController::class, 'approveizinsakit']);
    Route::get('/presensi/{kode_izin}/batalkanizinsakit', [PresensiController::class, 'batalkanizinsakit']);

    //cabang
    Route::get('/cabang', [CabangController::class, 'index']);
    Route::post('/cabang/store', [CabangController::class, 'store']);
    Route::post('/cabang/edit', [CabangController::class, 'edit']);
    Route::post('/cabang/update', [CabangController::class, 'update']);
    Route::post('/cabang/{kode_cabang}/delete', [CabangController::class, 'delete']);

    //konfigurasi
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);

    Route::get('/konfigurasi/jamkerja', [KonfigurasiController::class, 'jamkerja']);
    Route::post('/konfigurasi/storejamkerja', [KonfigurasiController::class, 'storejamkerja']);
    Route::post('/konfigurasi/editjamkerja', [KonfigurasiController::class, 'editjamkerja']);
    Route::post('/konfigurasi/updatejamkerja', [KonfigurasiController::class, 'updatejamkerja']);
    Route::post('/konfigurasi/{kode_jam_kerja}/delete', [KonfigurasiController::class, 'deletejamkerja']);;
    Route::post('/konfigurasi/jamkerja/{kode_jam_kerja}/delete', [KonfigurasiController::class, 'deletejamkerja']);

    Route::get('/konfigurasi/jamkerjadept', [KonfigurasiController::class, 'jamkerjadept']);
    Route::get('/konfigurasi/jamkerjadept/create', [KonfigurasiController::class, 'createjamkerjadept']);
    Route::post('/konfigurasi/jamkerjadept/store', [KonfigurasiController::class, 'storejamkerjadept']);
    Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/edit', [KonfigurasiController::class, 'editjamkerjadept']);
    Route::post('/konfigurasi/jamkerjadept/{kode_jk_dept}/update', [KonfigurasiController::class, 'updatejamkerjadept']);
    Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/show', [KonfigurasiController::class, 'showjamkerjadept']);
    Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/delete', [KonfigurasiController::class, 'deletejamkerjadept']);

    //User
    Route::get('/konfigurasi/users', [UserController::class, 'index']);
    Route::post('/konfigurasi/users/store', [UserController::class, 'store']);
    Route::post('/konfigurasi/users/edit', [UserController::class, 'edit']);
    Route::post('/konfigurasi/users/{id_user}/update', [UserController::class, 'update']);
    Route::post('/konfigurasi/users/{id_user}/delete', [UserController::class, 'delete']);

    //harilibur
    Route::get('/konfigurasi/harilibur', [HariliburController::class, 'index']);
    Route::get('/konfigurasi/harilibur/create', [HariliburController::class, 'create']);
    Route::post('/konfigurasi/harilibur/store', [HariliburController::class, 'store']);
    Route::post('/konfigurasi/harilibur/edit', [HariliburController::class, 'edit']);
    Route::post('/konfigurasi/harilibur/{kode_libur}/update', [HariliburController::class, 'update']);
    Route::post('/konfigurasi/harilibur/{kode_libur}/delete', [HariliburController::class, 'delete']);
    Route::get('/konfigurasi/harilibur/{kode_libur}/setkaryawanlibur', [HariliburController::class, 'setkaryawanlibur']);
    Route::get('/konfigurasi/harilibur/{kode_libur}/setlistkaryawanlibur', [HariliburController::class, 'setlistkaryawanlibur']);
    Route::get('/konfigurasi/harilibur/{kode_libur}/getsetlistkaryawanlibur', [HariliburController::class, 'getsetlistkaryawanlibur']);
    Route::post('/konfigurasi/harilibur/storekaryawanlibur', [HariliburController::class, 'storekaryawanlibur']);
    Route::post('/konfigurasi/harilibur/removekaryawanlibur', [HariliburController::class, 'removekaryawanlibur']);
    Route::get('/konfigurasi/harilibur/{kode_libur}/getkaryawanlibur', [HariliburController::class, 'getkaryawanlibur']);

    //cuti
    Route::get('/cuti', [CutiController::class, 'index']);
    Route::post('/cuti/store', [CutiController::class, 'store']);
    Route::post('/cuti/edit', [CutiController::class, 'edit']);
    Route::post('/cuti/{kode_cuti}/update', [CutiController::class, 'update']);
    Route::post('/cuti/{kode_cuti}/delete', [CutiController::class, 'delete']);

    //dinas luar
    Route::get('/dinasluar', [DinasluarController::class, 'index']);
    Route::post('/dinasluar/store', [DinasluarController::class, 'store']);
    Route::post('/dinasluar/edit', [DinasluarController::class, 'edit']);
    Route::post('/dinasluar/{kode_dinasluar}/update', [DinasluarController::class, 'update']);
    Route::post('/dinasluar/{kode_dinasluar}/delete', [DinasluarController::class, 'delete']);

    //izinpenting
    Route::get('/izinpenting', [PentingController::class, 'index']);
    Route::post('/izinpenting/store', [PentingController::class, 'store']);
    Route::post('/izinpenting/edit', [PentingController::class, 'edit']);
    Route::post('/izinpenting/{kode_izinpenting}/update', [PentingController::class, 'update']);
    Route::post('/izinpenting/{kode_izinpenting}/delete', [PentingController::class, 'delete']);
});

Route::get('/createrolepermission', function () {
    try {
        Role::create(['name' => 'administrator']);
        Permission::create(['name' => 'view-karyawan']);
        Permission::create(['name' => 'view-departemen']);
        echo "Success";
    } catch (\Exception $e) {
        echo "Error";
    }
});

Route::get('/give-user-role', function () {
    try {
        $user = User::findorfail(1);
        $user->assignRole('administrator');
        echo "Success";
    } catch (\Exception $e) {
        echo "Error";
    }
});

Route::get('/give-role-permission', function () {
    try {
        $role = Role::findorfail(5);
        $role->givePermissionTo('view-departemen');
        echo "Success";
    } catch (\Exception $e) {
        echo "Error";
    }
});
