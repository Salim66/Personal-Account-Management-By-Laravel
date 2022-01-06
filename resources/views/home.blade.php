@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center text-primary">Home</h2>
            <!-- Income and Expense -->
            <section class="home-section">
                <div class="home-section__assets">
                    <div class="home-section__income">
                        <span>INCOME</span>
                        @php
                            $income = App\Models\Income::sum('amount');
                        @endphp
                        <div class="card bg-primary text-white">
                            <div class="card-body home-section__balance">{{ $income }} BDT</div>
                        </div>
                    </div>
                    <div class="home-section__expense">
                        <span>EXPENSE</span>
                        @php
                            $expense = App\Models\Expense::sum('amount');
                        @endphp
                        <div class="card bg-warning text-white">
                            <div class="card-body home-section__balance">{{ $expense }} BDT</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- !Income and Expense -->
            <!-- Profit -->
            <section class="home-profit-section">
                <div class="home-section__profit">
                    <div class="profit text-center">
                        <span>PROFIT</span>
                        <div class="card bg-warning text-white">
                            <div class="card-body home--profit">{{ $income - $expense }} BDT</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- !Profit -->
        </div>
    </div>
</div>
@endsection
