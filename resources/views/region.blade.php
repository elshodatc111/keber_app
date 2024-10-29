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
            <div class="card-header">Region</div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Region Code</th>
                            <th>Region Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Region as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['coato'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <form action="{{ route('region_delete') }}" method="post">
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                                        <button class="btn btn-danger p-0 m-0 px-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=4 class="text-center">Not fount Region</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <hr>
                <h4 class="card-title w-100 text-center">New Region Create</h4>
                <form action="{{ route('region_create') }}" method = 'post' class="text-center">
                    @csrf 
                    <label for="">Region Code</label>
                    <input type="number" required name="coato" value="{{ old('coato') }}" class="form-control">
                    <label for="">Region Name</label>
                    <input type="text" required name="name" value="{{ old('name') }}" class="form-control">
                    <button class="btn btn-primary w-50 mt-3" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
