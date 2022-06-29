<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ProductController extends Controller
{
    public function index()
    {
        $username = session('username');
        return $this->search(1, 4, null, null);
    }

    public function product(Request $request)
    {
        $page = !empty($request->input('page')) ? $request->input('page') : 1;
        $pageSize = !empty($request->input('pageSize')) ? $request->input('pageSize') : 4;
        $productName = !empty($request->input('productName')) ? $request->input('productName') : null;
        $sortPrice = !empty($request->input('sortPrice')) ? $request->input('sortPrice') : '-';
        return $this->search($page, $pageSize, $productName, $sortPrice);
    }

    public function search($page, $pageSize, $productName, $sortPrice)
    {
        $username = session('username');
        DB::connection('mysql');
        $offset = ($page - 1) * $pageSize;
        $q = DB::table('product');
        if (!empty($productName)) {
            $q->where('product_name', $productName);
        }
        if (!empty($sortPrice)) {
            if ($sortPrice == "ˇ") {
                $q->orderByDesc('price');
            } else if ($sortPrice == "^") {
                $q->orderBy('price');
            }
        }
        $dataCount = $q->get()->count();
        $productData = $q->offset($offset)
            ->limit($pageSize)
            ->get()->toArray();
        return view('product', [
            'username' => $username,
            'products' => $productData,
            'dataCount' => $dataCount,
            'page' => $page,
        ]);
    }

    public function updateCart($product_id, $amount)
    {
        $cart = session()->get('cart');
        if (empty($cart)) {
            $cart = [];
        }
        if (empty($cart[$product_id])) {
            $cart[$product_id] = 0;
        }
        $cart[$product_id] += $amount;
        if ($cart[$product_id] <= 0) {
            unset($cart[$product_id]);
        }
        session()->put('cart', $cart);
    }

    public function getProductInfo()
    {
        $cart = session()->get('cart');
        if (empty($cart)) {
            $cart = [];
        }
        $products = DB::table('product')
            ->whereIn('product_id', array_keys($cart))
            ->get()->toArray();
        foreach ($products as $key => $value) {
            $products[$key]->amount = $cart[$value->product_id];
        }
        return $products;
    }
}
