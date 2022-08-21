<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Product::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('product.edit', $row->uuid) . '" onClick="onEdit(this)" id="'.$row->uuid.'" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="onDelete(this)" id="' . $row->uuid . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('product.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'title' => 'required',
           'uom' => 'required',
           'price' => 'required',
           'quantity' => 'required',
        ]);
        if ($validated) {
            $product = new Product();
            $product->title = $request->title;
            $product->uom = $request->uom;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->brand = $request->brand;
            $product->model = $request->model;
            $product->color = $request->color;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->save();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {

        $product = Product::where('uuid', $uuid)->first();
        $product->title = $request->title;
        $product->uom = $request->uom;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->model = $request->model;
        $product->color = $request->color;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {
            Product::where('uuid', $uuid)->delete();
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function productFilter( Request $request ){
        try {
            $query = "SELECT * FROM products ";

            $query2 = "SELECT * FROM products  WHERE price BETWEEN '{$request->from_price}' AND '{$request->to_price}'";
            $query3 = "SELECT * FROM products  WHERE status  '{$request->status}'";

            if ($request->ajax()) {
                if (empty($request->from_price) && empty($request->to_price)) {
                    return DataTables::of(DB::select($query))
                        ->addIndexColumn()
                        ->make(true);
                } elseif (! empty($request->status)) {
                    return DataTables::of(DB::select($query3))
                        ->addIndexColumn()
                        ->make(true);
                } else {
                    return DataTables::of(DB::select($query2))
                        ->addIndexColumn()
                        ->make(true);
                }
            }
            return view('product.filter');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

//    public function insertUpdateView()
//    {
//
//        return view('product.insertUpdate');
//    }

//    public function insertUpdate( Request $request) {
//
//
//        $product = DB::table('products')->where('title', $request->title)
//            ->updateOrInsert([
//                'uuid' => Str::uuid(),
//                'title' => $request->title,
//                'uom' => $request->uom,
//                'price' => $request->price,
//                'quantity' => $request->quantity,
//                'model' => $request->model,
//                'brand' => $request->brand,
//                'color' => $request->color,
//                'status' => $request->status,
//               'description' => $request->description
//        ]);
//        echo 'Operation Successful';
//        return redirect()->route('product.index');
//
//    }
}
