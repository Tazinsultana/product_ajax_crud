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
    <tbody>
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
{!! $product->links() !!}
