@extends('layouts.layout')

@section('title', 'Edit user '.$item->name)
@section('page-title', 'Edit user '.$item->name)

@section('breadcrumb')
<li class="breadcrumb-item active">Edit user {{ $item->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('users.update', $item->id) }}">
          @csrf
          @method('PATCH')
          @include('users._form')
        </form>
      </div>
    </div>
  </div>
@endsection