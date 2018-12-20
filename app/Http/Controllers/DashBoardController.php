<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Modal;
use App\User;
use App\RentOffice;
use App\Reservation;

class DashBoardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        $Brand_count = Brand::count();
        $Modal_count = Modal::count();
        $User_count = User::count();
        $RentOffice_count = RentOffice::count();

        $android_user_count = User::where('os','android')->count();
        $ios_user_count = User::where('os','ios')->count();

        $Reservation_is_done = Reservation::where('is_done',1)->count();
        $Reservation_not_done = Reservation::where('is_done',0)->count();

        $morris_Users = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `users` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;
        $morris_Reservation = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `reservations` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;

        $Reservations_calender = Reservation::select( \DB::raw("CONCAT(brands.name,' ',cars.name,' ',modal.name) as car_name"),
                                          "reservations.id", 'reservations.from','reservations.to')
                                 ->leftJoin('cars','cars.id','reservations.car_id')
                                 ->leftJoin('brands','cars.brand_id','brands.id')
                                 ->leftJoin('modal','cars.model_id','modal.id')
                                 ->leftJoin('rent_office','cars.rent_office_id','rent_office.id')
                                 ->groupBy('reservations.id')
                                 ->latest('reservations.id')->limit(50)->get();

        return view('DashBoard.DashBoard',compact('Brand_count','Modal_count','User_count','RentOffice_count','morris_Users','morris_Reservation',
                                        'android_user_count','ios_user_count',
                                        'Reservation_is_done','Reservation_not_done','Reservations_calender' ));
    }
}
