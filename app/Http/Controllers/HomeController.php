<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use App\Models\IncomeTitle;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view( 'home' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function income() {
        return view( 'income' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function expense() {
        return view( 'expense' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profit() {
        return view( 'profit' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function incomeTitleAdd( Request $request ) {
        $this->validate( $request, [
            'title' => 'required',
        ] );

        IncomeTitle::create( [
            'title' => $request->title,
        ] );

        return "Title added successfully :) ";

    }

    /**
     * Get income title
     */
    public function getIncomeTitle() {
        $all_data = IncomeTitle::latest()->get();
        return $all_data;
    }

    public function profitDetials( Request $request ) {

        $income = Income::whereBetween( 'created_at', [$request->from_date, $request->to_date] )->sum( 'amount' );
        $expense = Expense::whereBetween( 'created_at', [$request->from_date, $request->to_date] )->sum( 'amount' );
        $profit = ( $income - $expense );

        return [
            "income"  => $income,
            "expense" => $expense,
            "profit"  => $profit,
        ];

    }

}
