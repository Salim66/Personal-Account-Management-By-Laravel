@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center text-primary">Profit</h2>
            <!-- Daterange search income and expense -->
            <section class="profit-search mt-5 text-center" style="width: 90%; margin: auto;">
                <div class="row input-daterange">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4 mb-2">
                       <button title="Filter" type="button" name="filter" id="profit_filter" class="btn btn-primary"><i class="fa fa-search"></i></button>
                      <button title="Refresh" type="button" name="refresh" id="profit_refresh" class="btn btn-outline-dark"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
            </section>
            <!-- Income and Expense -->
            <section class="home-section">
                <div class="home-section__assets">
                    <div class="home-section__income">
                        <span>INCOME</span>
                        <div class="card bg-primary text-white">
                            <div class="card-body home-section__balance profit_income"> BDT</div>
                        </div>
                    </div>
                    <div class="home-section__expense">
                        <span>EXPENSE</span>
                        <div class="card bg-warning text-white">
                            <div class="card-body home-section__balance profit_expense"> BDT</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- !Income and Expense -->
            <!-- Profit -->
            <section class="home-profit-section profit-section__page">
                <div class="home-section__profit">
                    <div class="profit text-center">
                        <span>PROFIT</span>
                        <div class="card bg-warning text-white">
                            <div class="card-body home--profit profit_assets"> BDT</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- !Profit -->
        </div>
    </div>
</div>
@endsection
