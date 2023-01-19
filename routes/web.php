
<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index']);
# Route::get('/room/{room}', [PageController::class, 'book'])->name('book');
# Route::get('/getRooms', [PageController::class, 'getRooms']);
Route::get('/impressum', [PageController::class, 'imprint']);
Route::get('/kontakt', [PageController::class, 'contact']);
# Route::get('/getBookedRoomsNow', [PageController::class, 'getBookedRoomsNow']);
Route::post('/room/{room}/book', [PageController::class, 'bookRoom'])->name('room.book');
Route::delete('/buchung/{buchung}', [PageController::class, 'deleteBuchung'])->name('buchung.delete');

# Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
