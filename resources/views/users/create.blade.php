@extends('layouts.layout')

@section('title', 'Create user')
@section('page-title', 'Create a new user')

@section('breadcrumb')
<li class="breadcrumb-item active">Create user</li>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <!-- form start -->
      <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @include('users._form')
      </form>
    </div>
  </div>
</div>
@endsection