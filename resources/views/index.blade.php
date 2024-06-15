<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Laravel</title>

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
                text: '<?php echo session("not_allow");?>',
                icon: "warning",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "คกลง",
            }).then((result)=>{
                $(window).ready(function(){
                    $('#ModalLogin').modal('show');
                });
            });

        </script>
    @endif
    <div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form_login" class="modal-content p-4">
                <h4 class="text-center mb-3">Login</h4>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-success" type="submit">เข้าสู่ระบบ</button>
                  </div>
            </form>
        </div>
    </div>

    @if (!session('not_allow'))
    <script>
        $(window).ready(function(){
            $('#ModalLogin').modal('show');
        });

        $('#form_login').on('submit',function(e){
            e.preventDefault();
            let email = $('#email').val();
            let password = $('#password').val();

            if (email != "") {
                if (password != ""){
                    $.ajax({
                        url: "{{ route('checklogin') }}",
                        method: "post",
                        data:{
                            email: email,
                            password: password,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success:function(response){
                            if (response.login_success === "admin") {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    text: `เข้าสู่ระบบสำเร็จ`,
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                    window.location.href = "{{ route('admin') }}"
                                });


                            }else if (response.login_success === "user") {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    text: `เข้าสู่ระบบสำเร็จ`,
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then((result) => {
                                    window.location.href = "{{ route('user') }}"
                                });

                            }else if (response.login_failed) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    text: `${response.login_failed}`,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        }
                    });
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        text: "กรุณากรอก password",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    text: "กรุณากรอก email",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    </script>
    @endif

</body>
</html>
