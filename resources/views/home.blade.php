@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Users</div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Guvohnoma raqami</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($User as $item)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>
                                <form action="{{ route('user_delete') }}" method="post">
                                    @csrf 
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button class="btn btn-danger p-0 m-0 px-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=4>User not fount</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <hr>
                <h4 class="card-title w-100 text-center">New User Create</h4>
                <form action="{{ route('user_create') }}" method = 'post' class="text-center">
                    @csrf 
                    <label for="">FIO</label>
                    <input type="text" required name="name" value="{{ old('name') }}" class="form-control">
                    <label for="">Guvohnoma raqami</label>
                    <input type="text" required name="email" value="{{ old('email') }}" class="form-control">
                    <label for="">Jeton raqami</label>
                    <input type="text" name="password" required  class="form-control">
                    <button class="btn btn-primary w-50 mt-3" type="submit">Saqlash</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
