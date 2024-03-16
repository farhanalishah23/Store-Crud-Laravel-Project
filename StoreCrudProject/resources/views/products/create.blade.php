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
 
<div class="row d-flex justify-content-center">
<div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
         <a href="{{route('products.index')}}" class="btn btn-dark ">Back</a>
        </div>
    <div class="col-md-10">
        <div class="card-borde-0 shadow-lg my-4">
       <div class="card-header bg-dark" >
        <h3 class="text-white ">Create Product</h3>
       </div>
       <form enctype="multipart/form-data" method="post" action="{{route('products.store')}}">
        @csrf
       <div  class="card-body">
        <div class="mb-3">
            <label for="" class="form-label h5">Name</label>
            <input type="text" value="{{old('name')}}"class=" @error('name') is-invalid @enderror form-control form-control-lg " name="name" placeholder="Name">
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label h5">Sku</label>
            <input type="text"  value="{{old('sku')}}"class="  @error('sku') is-invalid @enderror form-control form-control-lg" name="sku" placeholder="Sku">
            @error('sku')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label h5">Price</label>
            <input type="text" class=" @error('price') is-invalid @enderror form-control form-control-lg" name="price" placeholder="Price">
            @error('price')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label h5">Description</label>
            <textarea class="form-control" name="description" cols="30" row="5" >{{old('description')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label h5">Image</label>
            <input type="file" class="form-control form-control-lg" name="image" placeholder="Image">
        </div>
        <div class="d-grid">
            <button class="btn btn-lg btn-primary">Submit</button>
        </div>
       </div>
       </form>
        </div>
    </div>
</div>
   </div>

  </body>
</html>