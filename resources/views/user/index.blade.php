@extends('layouts.user.master')

@section('title',"User Page")

@section('content')
    <div class="row d-flex mt-5">
        <div class="col-md-4 mb-2">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-center">แบบฟอร์มเพิ่มข้อมูล</h4>
                </div>
                <div class="card body">
                    <form id="form_insert_data" class="p-5">
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">คำอธิบาย</label>
                            <textarea class="form-control description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">จำนวนสินค้า</label>
                            <input type="number" class="form-control quantity">
                        </div>
                        <div class="d-grid gap-2 d-flex justify-content-center">
                            <button class="btn btn-success me-md-2" type="submit">submit</button>
                            <button class="btn btn-warning" type="reset">reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-2">
            <div class="card shadow" id="show_data">

            </div>
            @include('user.modal.modalEditdata')
        </div>
    </div>
@endsection
