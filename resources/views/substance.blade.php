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
            <div class="card-header">Substance</div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Substance Number</th>
                            <th>Substance Part</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Substance as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['number'] }}</td>
                                <td>{{ $item['part'] }}</td>
                                <td>
                                    <form action="{{ route('substance_delete') }}" method="post">
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
                <h4 class="card-title w-100 text-center">New Substance Create</h4>
                <form action="{{ route('substance_create') }}" method = 'post' class="text-center">
                    @csrf 
                    <label for="">Substance number</label>
                    <input type="text" required name="number" value="{{ old('number') }}" class="form-control">
                    <label for="">Substance part</label>
                    <input type="text" required name="part" value="{{ old('part') }}" class="form-control">
                    <button class="btn btn-primary w-50 mt-3" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
