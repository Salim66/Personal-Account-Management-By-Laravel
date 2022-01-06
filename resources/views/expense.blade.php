@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center text-primary">Expense</h2>
            <!-- Expense Form -->
            <section class="income-section">
                <div class="income-section__form">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
                        <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form method="POST" id="add_expense_form">
                                        <div class="row">
                                            <div class="form-group col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                                <select name="title_id" id="select_income_title" class="form-control js-example-templating expense_title">

                                                </select>
                                            </div>
                                            <div class="form-group col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <a title="Add Title" data-toggle="modal" id="title_add_modal" href="#" class=""><i class="fa fa-plus income-title___add shadow"></i></a>
                                            </div>
                                            <div class="form-group col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                                <label for="">Remark</label>
                                                <input type="text" name="remark" class="form-control expense_remark">
                                            </div>
                                            <div class="form-group col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                                <label for="">Amount</label>
                                                <input type="number" name="amount" class="form-control expense_amount">
                                            </div>
                                            <div class="form-group col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 mt-3 text-center">
                                                <input type="submit" name="add" class="btn btn-sm btn-primary" value="ADD">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- !Expense Form -->
            <!-- Expense Table Record -->
            <section class="income-table-section my-5">
                <div class="row input-daterange">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4 mb-2">
                       <button title="Filter" type="button" name="filter" id="ex_filter" class="btn btn-primary"><i class="fa fa-search"></i></button>
                      <button title="Refresh" type="button" name="refresh" id="ex_refresh" class="btn btn-outline-dark"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                  <br>
                <table id="expense_table" class="table table-stripe table-hover table-bordered table-responsive w-100">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Remark</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>



                </table>
            </section>
            <!-- !Expense Table Record -->
        </div>
    </div>
</div>

<!-- Title add modal -->
<div class="modal fade" id="income_title_add_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add new title</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="income_title_form" method="POST">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control add_income_title">
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add new">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Expense Edit Modal -->
<div class="modal fade" id="expense_edit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit expense</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card shadow">
                    <div class="card-body" style="z-index: 1000;">
                        <form method="POST" id="edit_expense_form">
                            <div class="row">
                                <div class="form-group">
                                    <select name="title_id" class="form-control edit_expense_title">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Remark</label>
                                    <input type="text" name="remark" class="form-control e_expense_remark">
                                    <input type="hidden" name="id" class="form-control e_expense_id">
                                </div>
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" name="amount" class="form-control e_expense_amount">
                                </div>
                                <div class="form-group text-center mt-2">
                                    <input type="submit" name="update" class="btn btn-sm btn-primary" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
