<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDatatable;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UsersDatatable $datatable)
    {
        return $datatable->render('home');
    }


    public function delete(User $user)
    {
        $user->delete();

        return back()->with('success', 'User has been Deleted');

    }

    public function userReason(Request $request)
    {
        $user = User::find($request->user);

        return response()->json(['reason' => $user->reason]);
    }

}
