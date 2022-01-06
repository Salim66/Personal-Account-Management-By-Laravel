(function($){
    $(document).ready(function(){

        // Select 2
        var $disabledResults = $(".js-example-templating");
        $disabledResults.select2();

        var $disabledResultsedit = $(".js-example-templating-edit");
        $disabledResultsedit.select2();

        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });

        $('#title_add_modal').click(function(e){
            e.preventDefault();
            $('#income_title_add_modal').modal('show');
        });

        //Income title form submit
        $('#income_title_form').submit(function(e){
            e.preventDefault();

            let title = $(".add_income_title").val();

            if (title == "" || title == null) {
                $.notify('Title is required!', {
                    globalPosition: "top right",
                    className: "error"
                });
            }else {

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                            "content"
                        ),
                    },
                    url: 'income-title-add',
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $.notify(data, {
                            globalPosition: "top right",
                            className: "success"
                        });

                        $('#income_title_form')[0].reset();
                        getIncomeTitle();
                        $('#income_title_add_modal').modal('hide');
                    }
                });

            }

        });

        // call function
        getIncomeTitle();

        // get income title
        function getIncomeTitle(){
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                url: "get-income-title",
                method: "GET",
                success: function(data){
                    $('#select_income_title').empty();
                    $title_data = `<option value="">Select Title</option>`;
                    data.map(data => {
                        $title_data += `<option value="${data.id}">${data.title}</option>`;
                    })
                    $('#select_income_title').append($title_data);
                }
            });
        }

        // Income add fomr
        $('#add_income_form').submit(function(e){
            e.preventDefault();

            let income_title = $(".income_title").val();
            let income_remark = $(".income_remark").val();
            let income_amount = $(".income_amount").val();

            if (income_title == "" || income_title == null || income_remark == "" || income_remark == null || income_amount == "" || income_amount == null) {
                $.notify('All field are required!', {
                    globalPosition: "top right",
                    className: "error"
                });
            }else {

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                            "content"
                        ),
                    },
                    url: 'add-income-form',
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $.notify(data, {
                            globalPosition: "top right",
                            className: "success"
                        });

                        $('#add_income_form')[0].reset();
                        $('#income_table').DataTable().ajax.reload();

                    }
                });

            }

        });

        // Expense add fomr
        $('#add_expense_form').submit(function(e){
            e.preventDefault();

            let expense_title = $(".expense_title").val();
            let expense_remark = $(".expense_remark").val();
            let expense_amount = $(".expense_amount").val();

            if (expense_title == "" || expense_title == null || expense_remark == "" || expense_remark == null || expense_amount == "" || expense_amount == null) {
                $.notify('All field are required!', {
                    globalPosition: "top right",
                    className: "error"
                });
            }else {

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                            "content"
                        ),
                    },
                    url: 'add-expense-form',
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $.notify(data, {
                            globalPosition: "top right",
                            className: "success"
                        });

                        $('#add_expense_form')[0].reset();
                        $('#expense_table').DataTable().ajax.reload();

                    }
                });

            }

        });

        // call income load function
        income_load_data();

        function income_load_data( from_date = '', to_date = '' ) {
            // get income data by yajra data table
            $('#income_table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: {
                    url: '/get-income',
                    data: {from_date:from_date, to_date:to_date}
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'titleid.title',
                        name: 'titleid.title'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function (data, type, full, meta) {
                            let date = new Date(data);
                            return date.toLocaleDateString();
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        }

        // call expense load function
        expense_load_data();

        function expense_load_data( from_date = '', to_date = '' ) {
            // get expense data by yajra data table
            $('#expense_table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                ajax: {
                    url: '/get-expense',
                    data: {from_date:from_date, to_date:to_date}
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'titleid.title',
                        name: 'titleid.title'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function (data, type, full, meta) {
                            let date = new Date(data);
                            return date.toLocaleDateString();
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        }

        // income
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
             $('#income_table').DataTable().destroy();
             income_load_data(from_date, to_date);
            }
            else
            {
             alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#income_table').DataTable().destroy();
            income_load_data();
        });

        // expense
        $('#ex_filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
             $('#expense_table').DataTable().destroy();
             expense_load_data(from_date, to_date);
            }
            else
            {
             alert('Both Date is required');
            }
        });

        $('#ex_refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#expense_table').DataTable().destroy();
            expense_load_data();
        });

        // edit income data
        $(document).on('click', '.edit_income_data', function(e){
            e.preventDefault();
            let id = $(this).attr('edit_id');
            // alert(id);

            $.ajax({
                url: '/income/get-edit-data/' + id,
                method: "GET",
                success: function(data){
                    $('.edit_income_title').html(data.title);
                    $('.e_income_remark').val(data.remark);
                    $('.e_income_amount').val(data.amount);
                    $('.e_income_id').val(data.id);

                    $('#income_edit_modal').modal('show');

                }
            });


        });

        // edit expense data
        $(document).on('click', '.edit_expense_data', function(e){
            e.preventDefault();
            let id = $(this).attr('edit_id');
            // alert(id);

            $.ajax({
                url: '/expense/get-edit-data/' + id,
                method: "GET",
                success: function(data){
                    $('.edit_expense_title').html(data.title);
                    $('.e_expense_remark').val(data.remark);
                    $('.e_expense_amount').val(data.amount);
                    $('.e_expense_id').val(data.id);

                    $('#expense_edit_modal').modal('show');

                }
            });


        });

        // update income data
        $(document).on('submit', '#edit_income_form', function(e){
            e.preventDefault();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                url: '/income-update',
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    // console.log(data);
                    $.notify(data.success, {
                        globalPosition: "top right",
                        className: "success"
                    });

                    $('#edit_income_form')[0].reset();
                    $('#income_edit_modal').modal('hide');
                    $('#income_table').DataTable().ajax.reload();
                }
            });

        });

        // update expense data
        $(document).on('submit', '#edit_expense_form', function(e){
            e.preventDefault();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                url: '/expense-update',
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    // console.log(data);
                    $.notify(data.success, {
                        globalPosition: "top right",
                        className: "success"
                    });

                    $('#edit_expense_form')[0].reset();
                    $('#expense_edit_modal').modal('hide');
                    $('#expense_table').DataTable().ajax.reload();
                }
            });

        });

        // delete income form
        $(document).on('submit', '.income_delete_form', function (e) {
            e.preventDefault();
            let id = $(this).attr('delete_id');

            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                                    "content"
                                ),
                            },
                            url: '/income/delete',
                            method: 'POST',
                            data: { id: id },
                            success: function (data) {

                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $.notify(data, {
                                                globalPosition: "top right",
                                                className: 'success'
                                            });
                                            // console.log(data);

                                            $('#income_table').DataTable().ajax.reload();

                                        }
                                    }
                                );
                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );



        });

        // delete expense form
        $(document).on('submit', '.expense_delete_form', function (e) {
            e.preventDefault();
            let id = $(this).attr('delete_id');

            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                                    "content"
                                ),
                            },
                            url: '/expense/delete',
                            method: 'POST',
                            data: { id: id },
                            success: function (data) {

                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $.notify(data, {
                                                globalPosition: "top right",
                                                className: 'success'
                                            });
                                            // console.log(data);

                                            $('#expense_table').DataTable().ajax.reload();

                                        }
                                    }
                                );
                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );



        });

        // profit
        profit_load_data();

        function profit_load_data(from_date, to_date){

           if(from_date != null || from_date != ""){
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                url: '/profit-details',
                method: "POST",
                data: {from_date: from_date, to_date: to_date},
                success: function(data){
                    $('.profit_income').html(data.income +" " + "BDT");
                    $('.profit_expense').html(data.expense +" " + "BDT");
                    $('.profit_assets').html(data.profit +" " + "BDT");
                }
            });
           }

        }

        $('#profit_filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if(from_date != '' &&  to_date != '')
            {
             profit_load_data(from_date, to_date);
            }
            else
            {
             alert('Both Date is required');
            }
        });

        $('#profit_refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            profit_load_data();
        });


    });
})(jQuery);
