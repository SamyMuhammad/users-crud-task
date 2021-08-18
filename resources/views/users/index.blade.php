@extends('layouts.layout')

@section('title', 'Users')
@section('page-title', 'All Users')

@section('breadcrumb')
<li class="breadcrumb-item active">All Users</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Birth Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->birth_date ?? '---' }}</td>
                <td>
                  <a href="{{ route('users.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                  <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="display-inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      {!! $items->render() !!}
    </div>
  </div>
@endsection