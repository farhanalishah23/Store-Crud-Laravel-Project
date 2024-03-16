<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Products Crud Laravel Project</title>
  </head>
  <body>

   <div class="bg-dark py-2" >
    <h4 class="text-white text-center">Products Crud Laravel Project</h4>
   </div>
   <div class="container">
   @if(Session::has('success'))
        {{Session::get('success')}}
    @endif
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
         <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
        </div>
</div>
<div class="row d-flex justify-content-center">

    <div class="col-md-10">
        <div class="card-borde-0 shadow-lg my-4">
       <div class="card-header bg-dark" >
        <h3 class="text-white ">Products</h3>
       </div>
       <div class="card-body">
        <table class="table">
          <tr>
            <th>Id</th>
            <th></th>
            <th>Name</th>
            <th>Sku</th>
            <th>Price</th>
            <th>created_at</th>
            <th>Action</th>
          </tr>
          @if($products->isNotEmpty())
            @foreach($products as $product)
          <tr>
            <td>{{$product->id}}</td>
            <td>
              @if($product->image != "")
              <img width="50" src="{{asset('uploads/products'.$product->image)}}" >
              @endif
            </td>
            <td>{{$product->name}}</td>
            <td>{{$product->sku}}</td>
            <td>${{$product->price}}</td>
            <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M,Y')}}</td>
            <td>
              <a href="{{route('products.edit' , $product->id)}}" class="btn btn-dark">Edit</a>
              <a href="" onclick="deleteProduct({{$product->id}});" class="btn btn-danger">Delete</a>
              <form id="delete-product-from-{{$product->id}}" action="{{route('products.delete' , $product->id)}}" method="post">
               @csrf 
               @method('delete')
              </form>
            </td>
          </tr>
          @endforeach
            @endif
        </table>
       </div>
      </div>
    </div>
</div>
   

  </body>
</html>

<script>
  function deleteProduct(id) {
    // Display a confirmation dialog to the user
    if (confirm("Are you sure you want to delete this product?")) {
      // If the user confirms deletion, submit the corresponding form
      document.getElementById("delete-product-from-" + id).submit();
    }
  }
</script>