<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {

        //    alert();
        // Create
        $(document).on('click', '.product_add', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            let quantity = $('#quantity').val();
            // console.log(name, price, quantity);

            $.ajax({

                url: "{{ route('add.product') }}",
                method: "POST",
                data: {
                    name,
                    price,
                    quantity,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addModal').modal('hide');
                        $('#add')[0].reset();
                        $('.table').load(location.href + ' .table');

                        Command: toastr["success"]("Product Added Successfully!!",
                            "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    }

                },

                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {

                        $('.errMsgContainer').append('<span class="Text-danger">' +
                            value + '</span>');
                    });


                }

            })

        });


        // Delete

        $(document).on('click', '.delete_modal', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure to delete product??')) {

                $.ajax({
                    url: "{{ route('delete.product') }} ",
                    method: 'DELETE',
                    data: {
                        id
                    },

                    success: function(res) {
                        if (res.status == 'success')
                            $('.table').load(location.href + ' .table');

                        Command: toastr["success"]("Product Deleted Successfully!!",
                            "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    }



                });


            }



        });

        // Edit
        $(document).on('click', '.edit_modal', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            console.log(id);

            $.ajax({

                url: "{{ route('edit.product') }}",
                method: "GeT",
                data: {
                    id
                },
                success: function(res) {

                    $('#up_id').val(res.data.id);
                    $('#up_name').val(res.data.name);
                    $('#up_price').val(res.data.price);
                    $('#up_quantity').val(res.data.quantity);

                    // console.log(res);
                }


            });
        });

        // Update
        $(document).on('click', '.product_up', function(e) {
            e.preventDefault();
            let id = $('#up_id').val();
            let name = $('#up_name').val();
            let price = $('#up_price').val();
            let quantity = $('#up_quantity').val();

            $.ajax({
                url: "{{ route('update.product') }}",
                method: "PUT",
                data: {
                    id,
                    name,
                    price,
                    quantity
                },
                success: function(res) {

                    if (res.status == 'success') {

                        $('#updateModal').modal('hide');
                        $('#update')[0].reset();
                        $('.table').load(location.href + ' .table');

                        Command: toastr["success"]("Product Updated Successfully!!",
                            "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }


                },
                error: function(err) {

                    let error = err.responseJSON
                    $.each(error.errors, function(index, value) {
                        $('errMsgContainer'), append('<span class="text-danger">' +
                            value + '</span>');
                    });

                }



            });




        });

        // Paginate
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]

            Product(page)
        })

        function Product(page) {
            $.ajax({
                url: "/pagination/paginate-data/?page=" + page,
                success: function(res) {

                    $('.table-data').html(res);
                }


            });
        }

        // Live Search
        ;
        $(document).on('keyup',function(e){
            e.preventDefault();
            let search=$('#search').val();
            console.log(search);
            $.ajax({
                url:"{{ route('search.product') }}",
                method:"GET",
                data:{search},
                success:function(res){
                    $('.table-data').html(res);
                    if(res.status=='Nothing Found'){
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>');

                    }

                }

            })
        })

    });
</script>
