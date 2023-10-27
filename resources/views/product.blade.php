<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <title>Product Ajax Crud</title>

<body>
    <div class="container my-2">
        <div class="row">
            <h2 class="my-3">List Of Product List</h2>
            <div style="display:flex;justify-content:end">
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</a>
            </div>
            <input type="text" name="search" id="search" class="mb-3 my-3 form-control"
                    placeholder="Search Here..">
            <div class="col my-3">
                <div class="table-data">
                <table class="table table-hover">


                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_body">
                        @foreach ($product as $key => $products)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $products->name }}</td>
                                <td>{{ $products->price }}</td>
                                <td>{{ $products->quantity }}</td>
                                <td>
                                    <a href=""class="btn btn-success edit_modal" data-bs-toggle="modal"
                                        data-bs-target="#updateModal" data-id="{{ $products->id }}">Edit</a>

                                    <a href="" class="btn btn-danger delete_modal"
                                        data-id="{{ $products->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div id="pagination_container" class="d-fex gap- 1">
                    @for( $page=1;$page<=$total_page;$page++)
                    <a href=" " class="btn btn-sm btn-primary pagination_item" data-page="{{ $page - 1 }}">{{ $page }}</a>
                    @endfor
                </div>

            </div>

            </div>
        </div>


    </div>
    @include('product_modal')
    @include('update_modal')
    @include('product_ajax')
    {!! Toastr::message() !!}

</body>

</html>
