<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\IncomeTitle;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        //check ajax request by yjra datatable
        if ( request()->ajax() ) {

            if ( !empty( $request->from_date ) ) {

                return datatables()->of( Expense::with( 'titleid' )->whereBetween( 'created_at', [$request->from_date, $request->to_date] )->latest()->get() )->addColumn( 'action', function ( $data ) {
                    $output = '<a title="Edit" edit_id="' . $data['id'] . '" href="#" class="btn btn-sm btn-info edit_expense_data" style="margin-right: 10px;"><i class="fa fa-edit text-white"></i></a>';
                    $output .= '<form style="display: inline;" action="#" method="POST" delete_id = "'.$data['id'].'" class="expense_delete_form"><input type="hidden" name="id" class="delete_in" value="' . $data['id'] . '"><button type="submit" class="btn btn-sm ml-1 btn-danger" ><i class="fa fa-trash"></i></button></form>';
                    return $output;
                } )->rawColumns( ['action'] )->make( true );

            } else {

                return datatables()->of( Expense::with( 'titleid' )->latest()->get() )->addColumn( 'action', function ( $data ) {
                    $output = '<a title="Edit" edit_id="' . $data['id'] . '" href="#" class="btn btn-sm btn-info edit_expense_data" style="margin-right: 10px;"><i class="fa fa-edit text-white"></i></a>';
                    $output .= '<form style="display: inline;" action="#" method="POST" delete_id = "'.$data['id'].'" class="expense_delete_form"><input type="hidden" name="id" class="delete_in" value="' . $data['id'] . '"><button type="submit" class="btn btn-sm ml-1 btn-danger" ><i class="fa fa-trash"></i></button></form>';
                    return $output;
                } )->rawColumns( ['action'] )->make( true );

            }

        }

        return view( 'income' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addExpenseStore( Request $request ) {

        $this->validate( $request, [
            'title_id' => 'required',
            'remark'   => 'required',
            'amount'   => 'required',
        ] );

        Expense::create( [
            'title_id' => $request->title_id,
            'remark'   => $request->remark,
            'amount'   => $request->amount,
        ] );

        return 'Data added successfully ): ';

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Expense  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function getEditData( $id ) {
        $data = Expense::findOrFail( $id );

        // //All income title
        $all_title = IncomeTitle::all();
        //Selected title
        $selected_title_id = $data->titleid->id;
        // return $selected_title_id;

        $title_list = '';
        foreach ( $all_title as $title ) {
            if ( $title->id === $selected_title_id ) {
                $selected = 'selected';
            } else {
                $selected = '';
            }

            $title_list .= '<option value="' . $title->id . '" ' . $selected . '>' . $title->title . '</option>';

        }
        // return $title_list;
        return [
            'id'     => $data->id,
            'title'  => $title_list,
            'remark' => $data->remark,
            'amount' => $data->amount,
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Expense  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function updateExpense( Request $request ) {

        //get all data
        $id = $request->id;
        $title_id = $request->title_id;
        $remark = $request->remark;
        $amount = $request->amount;

        // check tag has or not
        $data = Expense::findOrFail( $id );

        if ( $data != NULL ) {
            $data->title_id = $title_id;
            $data->remark = $remark;
            $data->amount = $amount;
            $data->update();

            return response()->json( [
                'success' => 'Data updated successfully ): ',
            ] );
        } else {
            return response()->json( [
                'error' => 'Data not found!',
            ] );
        }

    }

    /**
     * Expense Delete
     */
    public function deleteExpense( Request $request ) {

        $delete_id = $request->id;
        $data = Expense::findOrFail( $delete_id );
        // return $data;

        try {

            if ( $data ) {

                $data->delete();
                return 'Data deleted successfully :) ';

            }

        } catch ( \Throwable$th ) {
            return 'Data deleted failed badly!';
        }

    }

}
