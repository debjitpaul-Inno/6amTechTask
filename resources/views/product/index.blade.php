<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/jquery.dataTables.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" >

    <title>Product Management</title>
</head>
<body>

<div id="content" class="app-content">
    <div class="container">
    <!-- BEGIN row -->
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="page-header">
                    Product List View
                </h1>
            </div>
            <!-- BEGIN col-9 -->
            <div class="col-12">
                <hr>
            </div>
            <div class="col-xl-12">
                <div class="ms-auto">
                    <a href="{{route('product.create')}}" class="btn btn-dark float-end mt-5 mb-3"> Add Product</a>
                </div>
                <div class="ms-auto">
                    <a href="{{route('product.filter')}}" class="btn btn-dark float-end me-2 mt-5 mb-3">Filter Product</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="datatable" class="mb-5">
                    {{--                                <h4>Datatable</h4>--}}
                    {{--                                <p>DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table. Please read the <a href="https://datatables.net/" target="_blank">official documentation</a> for the full list of options.</p>--}}
                    <div class="card">
                        <div class="card-body">
                            <table id="laravel_datatable" class="table w-100">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>UOM</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Model</th>
                                    <th>Brand</th>
                                    <th>Color</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script>
    function onDelete(e) {
        let uuid = e.id
        let url = "{{ route('product.destroy', ":uuid") }}";
        url = url.replace(':uuid', uuid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                url: url,
                type: 'DELETE',
                data: $('#delForm').serialize(),
                success: function (response) {
                    // console.log(response)
                    alert('Product has been deleted successfully');
                    window.location.reload()
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
    }
    $(document).ready(function () {

        $('#laravel_datatable').DataTable({
            "drawCallback": function (settings) {
                // feather.replace();
            },

            processing: true,
            serverSide: true,
            lengthMenu: [ 10, 20, 30, 40, 50 ],
            responsive: true,
            dom:"<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
            buttons: [
                {
                    extend: 'print', className: 'btn btn-secondary buttons-print btn-outline-default btn-sm ms-2',
                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .css( 'color', '#020202' );
                    },
                    exportOptions: {
                        columns: [0,1,2,"visible"]
                    }
                },

                { extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm' }
            ],
            "order": [[0, "asc"]],
            ajax: "{{route('product.index') }}",
            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'uom', name: 'uom'},
                {data: 'price', name: 'price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'model', name: 'model'},
                {data: 'brand', name: 'brand'},
                {data: 'color', name: 'color'},
                {data: 'description', name: 'description'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: false,
                    className: 'text-center',

                },
            ],


        });
    });

    function load_data(from_date = '', to_date = '') {
        $('#laravel_datatable').DataTable({

            processing: true,
            serverSide: true,
            lengthMenu: [10, 20, 30, 40, 50],
            responsive: true,
            dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
            buttons: [
                {
                    extend: 'print', className: 'btn btn-secondary buttons-print btn-outline-default btn-sm ms-2',

                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'color', '#020202' );
                    },
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5, "visible"]
                    }
                },
                {
                    extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm'
                }
            ],
            ajax: {
                url: '{{ route("product.filter") }}',
                data: {from_date: from_date, to_date: to_date}
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'uom', name: 'uom'},
                {data: 'price', name: 'price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'model', name: 'model'},
                {data: 'brand', name: 'brand'},
                {data: 'color', name: 'color'},
                {data: 'description', name: 'description'},
            ]
        });
    }

    $('input[type=number]').on('change',function (e) {
        let from_date = $('#from_date_range').val()
        let to_date = $('#to_date_range').val()
        console.log(from_date)
        console.log(to_date)
        if (from_date !== '' && to_date !== '') {
            $('#laravel_datatable').DataTable().destroy();
            load_data(from_date, to_date);
        }
    })
</script>

</body>
</html>
