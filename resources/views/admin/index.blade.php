@extends('layouts.admin.master')

@section('title',"Admin Page")

@section('content')
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-6">
            <div class="card shadow">
                <h4 class="card-header text-center">ข้อมูลผู้ดูแลระบบ</h4>
                <div class="card-body">
                    <p>Id : {{ Auth::user()->id }}</p>
                    <p>Email : {{ Auth::user()->email }}</p>
                    <p>Status : {{ Auth::user()->status }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection


