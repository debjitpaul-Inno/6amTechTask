<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
<!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" >

    <title>Product Management</title>
</head>
<body>
<div id="content" class="app-content">
    <div class="row">
        <div class="align-items-center">
            <div class="col-12 p-5">
                <h1 class="page-header mb-0">Insert Or Update Product</h1>
            </div>
            <div class="col-12">
                <hr/>
            </div>

        </div>
    </div>

    <div id="formControls" class="mb-5">

        <div class="row p-5">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pb-2">

                        <form id="createForm" method="POST" action="{{route('product.insertUpdate')}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="title">Title<span class="required"> *</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="" />
                                    </div>
                                    <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="uom">Unit of measurement (UOM)<span class="required"> *</span></label>
                                        <input type="text" class="form-control" id="uom" name="uom" placeholder="unit" />
                                    </div>
                                    <span class="text-danger">@error('uom'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="price">Price<span class="required"> *</span></label>
                                        <input type="number" min="0" class="form-control" id="price" name="price" placeholder="price" />
                                    </div>
                                    <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="quantity">Quantity<span class="required"> *</span></label>
                                        <input type="number" min="0" class="form-control" id="quantity" name="quantity" placeholder="quantity" />
                                    </div>
                                    <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="model">Model</label>
                                        <input type="text" class="form-control" id="model" name="model" placeholder="model"/>
                                    </div>
                                    <span class="text-danger">@error('model'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="color">Color</label>
                                        <input type="text" class="form-control" id="color" name="color" placeholder="color"/>
                                    </div>
                                    <span class="text-danger">@error('color'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="brand">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="brand"/>
                                    </div>
                                    <span class="text-danger">@error('brand'){{ $message }}@enderror</span>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <label class="form-label" for="description">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="{{'active'}}" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="{{'inactive'}}" id="flexRadioDefault2" >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 text-center mt-5">
                                <div class="ms-auto">
                                    <button type="submit" id="submit" class="btn btn-success btn-lg"> <i class=""></i>
                                        <span class="small">Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{--                    <x-card-border></x-card-border>--}}
                </div>
            </div>
        </div>
        <div class="row align-items-center">

        </div>
    </div>
</div>


<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
{{--<script>--}}
{{--    if ($("#createForm").length > 0) {--}}
{{--        $("#createForm").validate({--}}
{{--            rules: {--}}
{{--                title: {--}}
{{--                    required: true--}}
{{--                },--}}
{{--                uom: {--}}
{{--                    required: true,--}}
{{--                },--}}
{{--                price: {--}}
{{--                    required: true,--}}
{{--                },--}}
{{--                quantity: {--}}
{{--                    required: true,--}}
{{--                },--}}
{{--                status: {--}}
{{--                    required: true,--}}
{{--                },--}}
{{--            },--}}
{{--            messages: {--}}
{{--                title: {--}}
{{--                    required: "Product Title is required",--}}
{{--                },--}}
{{--                uom: {--}}
{{--                    required: "Unit of measurement is required",--}}
{{--                },--}}
{{--                price: {--}}
{{--                    required: "Price is required",--}}
{{--                },--}}
{{--                quantity: {--}}
{{--                    required: "Quantity is required",--}}
{{--                },--}}
{{--                status: {--}}
{{--                    required: "Status is required",--}}
{{--                },--}}
{{--            },--}}
{{--        })--}}
{{--    }--}}

{{--</script>--}}
</body>
</html>
