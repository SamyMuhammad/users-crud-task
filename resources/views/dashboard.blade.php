@extends('layouts.layout')

@section('title', 'Users CRUD')
@section('page-title', 'Welcome To Users CRUD App!')

{{-- @section('breadcrumb')
<li class="breadcrumb-item active">Dashboard v1</li>
@endsection --}}

@section('content')
<!-- Small boxes (Stat box) -->
{{-- <div class="row">
</div> --}}
<!-- /.row -->
@endsection

@section('scripts')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
@endsection