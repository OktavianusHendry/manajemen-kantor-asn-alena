<?php

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CrewDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\instansiController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\LaporanCutiController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\UnitPenempatanController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\ArsipPembelajaranController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route untuk verifikasi email cuy
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route forgot password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/cetak-laporan-cuti/{id}', [LaporanCutiController::class, 'cetakLaporan'])->name('cetak-laporan-cuti');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('users', UserController::class)->middleware('auth');

});

Route::group(['middleware' => ['auth', 'isCrew']], function () {

    Route::get('/crew-dashboard', [CrewDashboardController::class, 'index'])->name('crew.dashboard');

});

Route::group(['middleware' => ['auth']], function () {

   Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

});

// User routes
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

// Laporan Cuti routes
Route::get('laporan_cuti', [LaporanCutiController::class, 'index'])->name('laporan_cuti.index');
Route::get('laporan_cuti/create', [LaporanCutiController::class, 'create'])->name('laporan_cuti.create');
Route::post('laporan_cuti', [LaporanCutiController::class, 'store'])->name('laporan_cuti.store');
Route::get('laporan_cuti/{laporan_cuti}', [LaporanCutiController::class, 'show'])->name('laporan_cuti.show');
Route::get('laporan_cuti/{laporan_cuti}/edit', [LaporanCutiController::class, 'edit'])->name('laporan_cuti.edit');
Route::put('laporan_cuti/{laporan_cuti}', [LaporanCutiController::class, 'update'])->name('laporan_cuti.update');
Route::delete('laporan_cuti/{laporan_cuti}', [LaporanCutiController::class, 'destroy'])->name('laporan_cuti.destroy');
Route::get('/cetak-laporan-cuti-pertanggal', [LaporanCutiController::class, 'cetaklaporanpertanggal']);
Route::get('/laporan-cuti/cetak/{id}', [LaporanCutiController::class, 'cetaklaporan'])->name('laporan-cuti.cetak');
Route::put('/laporan_cuti/{cuti}/update-status', [LaporanCutiController::class, 'updateStatus'])->name('laporan_cuti.updateStatus');

// Divisi routes
Route::get('divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::get('divisi/create', [DivisiController::class, 'create'])->name('divisi.create');
Route::post('divisi', [DivisiController::class, 'store'])->name('divisi.store');
Route::get('divisi/{divisi}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('divisi/{divisi}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
Route::put('divisi/{divisi}', [DivisiController::class, 'update'])->name('divisi.update');
Route::delete('divisi/{divisi}', [DivisiController::class, 'destroy'])->name('divisi.destroy');

// Instansi routes
Route::get('instansi', [InstansiController::class, 'index'])->name('instansi.index');
Route::get('instansi/create', [InstansiController::class, 'create'])->name('instansi.create');
Route::post('instansi', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('instansi/{instansi}', [InstansiController::class, 'show'])->name('instansi.show');
Route::get('instansi/{instansi}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('instansi/{instansi}', [InstansiController::class, 'update'])->name('instansi.update');
Route::delete('instansi/{instansi}', [InstansiController::class, 'destroy'])->name('instansi.destroy');

// Jabatan routes
Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
Route::get('jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
Route::post('jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
Route::get('jabatan/{jabatan}', [JabatanController::class, 'show'])->name('jabatan.show');
Route::get('jabatan/{jabatan}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
Route::put('jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
Route::delete('jabatan/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

// Jenjang routes
Route::get('jenjang', [JenjangController::class, 'index'])->name('jenjang.index');
Route::get('jenjang/create', [JenjangController::class, 'create'])->name('jenjang.create');
Route::post('jenjang', [JenjangController::class, 'store'])->name('jenjang.store');
Route::get('jenjang/{jenjang}', [JenjangController::class, 'show'])->name('jenjang.show');
Route::get('jenjang/{jenjang}/edit', [JenjangController::class, 'edit'])->name('jenjang.edit');
Route::put('jenjang/{jenjang}', [JenjangController::class, 'update'])->name('jenjang.update');
Route::delete('jenjang/{jenjang}', [JenjangController::class, 'destroy'])->name('jenjang.destroy');

// Jenis Cuti routes
Route::get('jenis_cuti', [JenisCutiController::class, 'index'])->name('jenis_cuti.index');
Route::get('jenis_cuti/create', [JenisCutiController::class, 'create'])->name('jenis_cuti.create');
Route::post('jenis_cuti', [JenisCutiController::class, 'store'])->name('jenis_cuti.store');
Route::get('jenis_cuti/{jenis_cuti}', [JenisCutiController::class, 'show'])->name('jenis_cuti.show');
Route::get('jenis_cuti/{jenis_cuti}/edit', [JenisCutiController::class, 'edit'])->name('jenis_cuti.edit');
Route::put('jenis_cuti/{jenis_cuti}', [JenisCutiController::class, 'update'])->name('jenis_cuti.update');
Route::delete('jenis_cuti/{jenis_cuti}', [JenisCutiController::class, 'destroy'])->name('jenis_cuti.destroy');

// Berita Acara routes
Route::get('berita_acara', [BeritaAcaraController::class, 'index'])->name('berita_acara.index');
Route::get('berita_acara/create', [BeritaAcaraController::class, 'create'])->name('berita_acara.create');
Route::post('berita_acara', [BeritaAcaraController::class, 'store'])->name('berita_acara.store');
Route::get('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'show'])->name('berita_acara.show');
Route::get('berita_acara/{berita_acara}/edit', [BeritaAcaraController::class, 'edit'])->name('berita_acara.edit');
Route::put('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'update'])->name('berita_acara.update');
Route::delete('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'destroy'])->name('berita_acara.destroy');

// Tujuan routes
Route::get('tujuan', [TujuanController::class, 'index'])->name('tujuan.index');
Route::get('tujuan/create', [TujuanController::class, 'create'])->name('tujuan.create');
Route::post('tujuan', [TujuanController::class, 'store'])->name('tujuan.store');
Route::get('tujuan/{tujuan}', [TujuanController::class, 'show'])->name('tujuan.show');
Route::get('tujuan/{tujuan}/edit', [TujuanController::class, 'edit'])->name('tujuan.edit');
Route::put('tujuan/{tujuan}', [TujuanController::class, 'update'])->name('tujuan.update');
Route::delete('tujuan/{tujuan}', [TujuanController::class, 'destroy'])->name('tujuan.destroy');

// Kategori routes
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// Sub Kategori routes
Route::get('sub_kategori', [SubKategoriController::class, 'index'])->name('sub_kategori.index');
Route::get('sub_kategori/create', [SubKategoriController::class, 'create'])->name('sub_kategori.create');
Route::post('sub_kategori', [SubKategoriController::class, 'store'])->name('sub_kategori.store');
Route::get('sub_kategori/{sub_kategori}', [SubKategoriController::class, 'show'])->name('sub_kategori.show');
Route::get('sub_kategori/{sub_kategori}/edit', [SubKategoriController::class, 'edit'])->name('sub_kategori.edit');
Route::put('sub_kategori/{sub_kategori}', [SubKategoriController::class, 'update'])->name('sub_kategori.update');
Route::delete('sub_kategori/{sub_kategori}', [SubKategoriController::class, 'destroy'])->name('sub_kategori.destroy');

// Sekolah routes
Route::get('sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
Route::get('sekolah/create', [SekolahController::class, 'create'])->name('sekolah.create');
Route::post('sekolah', [SekolahController::class, 'store'])->name('sekolah.store');
Route::get('sekolah/{sekolah}', [SekolahController::class, 'show'])->name('sekolah.show');
Route::get('sekolah/{sekolah}/edit', [SekolahController::class, 'edit'])->name('sekolah.edit');
Route::put('sekolah/{sekolah}', [SekolahController::class, 'update'])->name('sekolah.update');
Route::delete('sekolah/{sekolah}', [SekolahController::class, 'destroy'])->name('sekolah.destroy');

// Unit Penempatan routes
Route::get('unit_penempatan', [UnitPenempatanController::class, 'index'])->name('unit_penempatan.index');
Route::get('unit_penempatan/create', [UnitPenempatanController::class, 'create'])->name('unit_penempatan.create');
Route::post('unit_penempatan', [UnitPenempatanController::class, 'store'])->name('unit_penempatan.store');
Route::get('unit_penempatan/{unit_penempatan}', [UnitPenempatanController::class, 'show'])->name('unit_penempatan.show');
Route::get('unit_penempatan/{unit_penempatan}/edit', [UnitPenempatanController::class, 'edit'])->name('unit_penempatan.edit');
Route::put('unit_penempatan/{unit_penempatan}', [UnitPenempatanController::class, 'update'])->name('unit_penempatan.update');
Route::delete('unit_penempatan/{unit_penempatan}', [UnitPenempatanController::class, 'destroy'])->name('unit_penempatan.destroy');

// Berita Acara routes
Route::get('berita_acara', [BeritaAcaraController::class, 'index'])->name('berita_acara.index');
Route::get('berita_acara/create', [BeritaAcaraController::class, 'create'])->name('berita_acara.create');
Route::post('berita_acara', [BeritaAcaraController::class, 'store'])->name('berita_acara.store');
Route::get('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'show'])->name('berita_acara.show');
Route::get('berita_acara/{berita_acara}/edit', [BeritaAcaraController::class, 'edit'])->name('berita_acara.edit');
Route::put('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'update'])->name('berita_acara.update');
Route::delete('berita_acara/{berita_acara}', [BeritaAcaraController::class, 'destroy'])->name('berita_acara.destroy');

// Release routes
Route::get('release', [ReleaseController::class, 'index'])->name('release.index');
Route::get('release/create', [ReleaseController::class, 'create'])->name('release.create');
Route::post('release', [ReleaseController::class, 'store'])->name('release.store');
Route::get('release/{release}', [ReleaseController::class, 'show'])->name('release.show');
Route::get('release/{release}/edit', [ReleaseController::class, 'edit'])->name('release.edit');
Route::put('release/{release}', [ReleaseController::class, 'update'])->name('release.update');
Route::delete('release/{release}', [ReleaseController::class, 'destroy'])->name('release.destroy');

// Surat Masuk routes
Route::get('surat_masuk', [SuratMasukController::class, 'index'])->name('surat_masuk.index');
Route::get('surat_masuk/create', [SuratMasukController::class, 'create'])->name('surat_masuk.create');
Route::post('surat_masuk', [SuratMasukController::class, 'store'])->name('surat_masuk.store');
Route::get('surat_masuk/{surat_masuk}', [SuratMasukController::class, 'show'])->name('surat_masuk.show');
Route::get('surat_masuk/{surat_masuk}/edit', [SuratMasukController::class, 'edit'])->name('surat_masuk.edit');
Route::put('surat_masuk/{surat_masuk}', [SuratMasukController::class, 'update'])->name('surat_masuk.update');
Route::delete('surat_masuk/{surat_masuk}', [SuratMasukController::class, 'destroy'])->name('surat_masuk.destroy');

// Surat Keluar routes
Route::get('surat_keluar', [SuratKeluarController::class, 'index'])->name('surat_keluar.index');
Route::get('surat_keluar/create', [SuratKeluarController::class, 'create'])->name('surat_keluar.create');
Route::post('surat_keluar', [SuratKeluarController::class, 'store'])->name('surat_keluar.store');
Route::get('surat_keluar/{surat_keluar}', [SuratKeluarController::class, 'show'])->name('surat_keluar.show');
Route::get('surat_keluar/{surat_keluar}/edit', [SuratKeluarController::class, 'edit'])->name('surat_keluar.edit');
Route::put('surat_keluar/{surat_keluar}', [SuratKeluarController::class, 'update'])->name('surat_keluar.update');
Route::delete('surat_keluar/{surat_keluar}', [SuratKeluarController::class, 'destroy'])->name('surat_keluar.destroy');

// Arsip Pembelajaran routes
Route::get('arsip_pembelajaran', [ArsipPembelajaranController::class, 'index'])->name('arsip_pembelajaran.index');
Route::get('arsip_pembelajaran/create', [ArsipPembelajaranController::class, 'create'])->name('arsip_pembelajaran.create');
Route::post('arsip_pembelajaran', [ArsipPembelajaranController::class, 'store'])->name('arsip_pembelajaran.store');
Route::get('arsip_pembelajaran/{arsip_pembelajaran}', [ArsipPembelajaranController::class, 'show'])->name('arsip_pembelajaran.show');
Route::get('arsip_pembelajaran/{arsip_pembelajaran}/edit', [ArsipPembelajaranController::class, 'edit'])->name('arsip_pembelajaran.edit');
Route::put('arsip_pembelajaran/{arsip_pembelajaran}', [ArsipPembelajaranController::class, 'update'])->name('arsip_pembelajaran.update');
Route::delete('arsip_pembelajaran/{arsip_pembelajaran}', [ArsipPembelajaranController::class, 'destroy'])->name('arsip_pembelajaran.destroy');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

Route::post('/notifications/mark-all-as-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['status' => 'success']);
})->name('notifications.markAllAsRead');



require __DIR__.'/auth.php';