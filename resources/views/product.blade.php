@extends('index')

@section('content')
<script>
    let cartData = [];

    function updateCart(product_id, amount) {
        let r = new XMLHttpRequest();
        r.addEventListener("load", function() {
            refreshCartTable();
        });
        r.open("GET", `/updateCart/${product_id}/${amount}`);
        r.send();
    }

    function getProductInfo(callback) {
        let r = new XMLHttpRequest();
        r.addEventListener("load", callback);
        r.open("GET", `/getProductInfo`);
        r.send();
    }

    function refreshCartTable() {
        getProductInfo(function() {
            cartData = JSON.parse(this.responseText);
            let str = "";
            for (let data of cartData) {
                str += `<tr>
                <td>${data.product_id}</td>
                <td>${data.product_name}</td>
                <td>${data.price}</td>
                <td>
                <button onclick="updateCart(${data.product_id},-1);" class="btn btn-primary">-</button> 
                ${data.amount} 
                <button onclick="updateCart(${data.product_id},1);" class="btn btn-primary">+</button>
                </td>
            </tr>`;
            }
            document.getElementById('cartTableInfo').innerHTML = str;
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    let query = {
        productName: urlParams.get('productName'),
        sortPrice: urlParams.get('sortPrice'),
        page: urlParams.get('page'),
        pageSize: urlParams.get('pageSize')
    }

    function search() {
        let href = "product?";
        if (query.productName) href += 'productName=' + query.productName + '&';
        if (query.sortPrice && (query.sortPrice == '-' || query.sortPrice == '^' || query.sortPrice == 'ˇ')) href += 'sortPrice=' + query.sortPrice + '&';
        if (query.page) href += 'page=' + query.page + '&';
        if (query.pageSize) href += 'pageSize=' + query.pageSize + '&';
        if (href.substr(-1) == '&') {
            href = href.substring(0, href.length - 1)
        }
        location.href = href;
    }
    window.search = search;

    function sortChange() {
        let arr = ['-', '^', 'ˇ'];
        query.sortPrice = arr[(arr.indexOf(query.sortPrice) + 1) % arr.length];
    }
</script>
產品名稱
<input type="text" id="product_name" />
<button class="btn btn-primary" onclick="query.productName=document.getElementById('product_name').value;search();">搜尋</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="refreshCartTable();">
    購物車
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">產品編號</th>
            <th scope="col">產品名稱</th>
            <th scope="col">價格
                <button id="price_sort" onclick="sortChange();search();" class="btn btn-primary">-</button>
            </th>
            <th scope="col">加到購物車</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{$product->product_id}}</th>
            <td>{{$product->product_name}}</td>
            <td>{{$product->price}}</td>
            <td><button onclick="updateCart({{$product->product_id}},1);" class="btn btn-primary">+</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
總筆數 {{$dataCount}}
<nav aria-label="Page navigation example">
    <ul class="pagination">
        @for($i = 0; $i < ceil($dataCount/4); $i++) @if ($i+1==$page) <li class="page-item active"><a class="page-link" href="javascript: void(0)" onclick="query.page={{$i+1}};window.search();">{{$i+1}}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="javascript: void(0)" onclick="query.page={{$i+1}};window.search();">{{$i+1}}</a></li>
            @endif
            @endfor
    </ul>
</nav>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">購物車列表</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">產品編號</th>
                            <th scope="col">產品名稱</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                        </tr>
                    </thead>
                    <tbody id="cartTableInfo">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">確定</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("product_name").value = query.productName;
    if (query.sortPrice)
        document.getElementById("price_sort").innerHTML = query.sortPrice;
</script>
@stop