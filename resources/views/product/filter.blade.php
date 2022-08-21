
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

        <div class="row mb-2">
            <div class="col-12">
                <h1 class="page-header">
                    Filter Product
                </h1>
            </div>
            <!-- BEGIN col-9 -->
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="page-header">
                    Filter with Price Range
                </h5>
                <div class="row mb-3 mt-2 float-end ">
                    <label class="col-md-2 text-start ">Start Price</label>
                    <div class="col-md-4">
                        <input type="number" name="from_price" id="from_price_range"
                               class="form-control form-select-sm" value=""
                        >
                    </div>
                    <label class="col-md-1 text-end ">To Price</label>
                    <div class="col-md-5">
                        <input type="number" name="to_price" id="to_price_range"
                               class="form-control form-select-sm" value=""
                        >
                    </div>
                </div>
            </div>
{{--            <div class="col-12">--}}
{{--                <h5 class="page-header">--}}
{{--                    Filter with Status--}}
{{--                </h5>--}}
{{--            </div>--}}
{{--            <div class="row float-end">--}}
{{--                <div class="col-md-12 ">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" name="status" value="{{'active'}}" id="active">--}}
{{--                        <label class="form-check-label" for="status">--}}
{{--                            Active--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" value="{{'inactive'}}" name="status" id="inactive">--}}
{{--                        <label class="form-check-label" for="status">--}}
{{--                            Inactive--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="datatable" class="mb-5">
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
                                    <th>Status</th>
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

    $(document).ready(function () {
        load_data();
    })
    function load_data(from_price = '', to_price = '' ) {
        $('#laravel_datatable').DataTable({

            processing: true,
            serverSide: true,
            lengthMenu: [10, 20, 30, 40, 50],
            responsive: true,
            dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",

            ajax: {
                url: '{{ route("product.filter") }}',
                data: {from_price: from_price, to_price: to_price}
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
                {data: 'status', name: 'status'},
            ]
        });
    }
    $('input[type=number]').on('input',function (e) {
        let from_price = $('#from_price_range').val()
        let to_price = $('#to_price_range').val()

        if (from_price !== '' && to_price !== '') {
            $('#laravel_datatable').DataTable().destroy();
            load_data(from_price, to_price);
        }
    })

</script>

</body>
</html>
