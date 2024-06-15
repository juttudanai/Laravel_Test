<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
<body>
    @if (session('not_allow'))
        <script>
            Swal.fire({
                title: "แจ้งเตือน",
                text: '<?php echo session("not_allow"); ?>',
                icon: "warning",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "ตกลง",
            });

        </script>
    @endif

    <div class="container">
        @yield('content')
    </div>

    <script>

        ShowData();
        function ShowData(){
            $.ajax({
                url: "{{ route('user.show') }}",
                method: "post",
                data:{
                    "_token": "{{ csrf_token() }}"
                },
                success:function(response){
                    $('#show_data').html(response.data);
                }
            });

        }

        $(document).on('submit','#form_insert_data',function(e){
            e.preventDefault();
            let name = $('.name').val();
            let description = $('.description').val();
            let quantity = $('.quantity').val();

            if (name != "") {
                if (description != "") {
                    if (quantity != "") {
                        $.ajax({
                            url: "{{ route('user.insert') }}",
                            method: "post",
                            data:{
                                name: name,
                                description: description,
                                quantity: quantity,
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success:function(response){
                               if (response.insert_success) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        text: `${response.insert_success}`,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result)=>{
                                        ShowData();
                                    });
                               }
                            }
                        });
                    }else{
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            text: "กรุณากรอกจำนวนสินค้า",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "กรุณากรอกคำอธิบาย",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    text: "กรุณากรอกชื่อสินค้า",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        $(document).on('click','.delete',function(){
            let id = $(this).data('id');
            let name = $(this).data('id2');
            Swal.fire({
                title: "แจ้งเตือน !",
                html: `ต้องการลบ <b style="color: red;">${name}</b> หรือไม่ ? `,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user.delete') }}",
                        method: "post",
                        data:{
                            id: id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success:function(response){
                            if (response.delete_success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    text: `${response.delete_success}`,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result)=>{
                                    ShowData();
                                });
                            }
                        }
                    });

                }
            });

        });

        $(document).on('click','#editData',function(){
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('user.edit') }}",
                method: "post",
                data:{
                    id : id,
                     "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success:function(response){
                    $.each( response.data, function( key, value ) {
                        $('#id').val(value.id);
                        $('#editProductname').val(value.name);
                        $('#editDetail').val(value.description);
                        $('#editQuantity').val(value.quantity);

                        $('#ModalEditData').modal('show');
                    });
                }
            });
        });

        $(document).on('submit','#form_update_data',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let name =  $('#editProductname').val();
            let description =  $('#editDetail').val();
            let quantity =  $('#editQuantity').val();

            if (name != "") {
                if (description != "") {
                    if (quantity != "") {
                        $.ajax({
                            url: "{{ route('user.update') }}",
                            method: "post",
                            data:{
                                id: id,
                                name: name,
                                description: description,
                                quantity: quantity,
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success:function(response){
                                if (response.update_success) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        text: `${response.update_success}`,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result)=> {
                                        $('#ModalEditData').modal('hide');
                                        ShowData();
                                    });
                                }
                            }
                        });
                    }else{
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            text: "กรุณากรอกจำนวนสินค้า",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "กรุณากรอกคำอธิบายสินค้า",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    text: "กรุณากรอกชื่อสินค้า",
                    showConfirmButton: false,
                    timer: 1500
                });
            }

        });

    </script>
</body>
</html>
