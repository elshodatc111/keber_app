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
            <div class="card-header">Search</div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Region name</th>
                            <th>FIO</th>
                            <th>Substanse</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Search as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['fio'] }}</td>
                                <td>{{ $item['number'] }} {{ $item['part'] }}</td>
                                <td>{{ $item['type'] }}</td>
                                <td>
                                    <a href="{{ route('searchs',$item['id']) }}" class="btn btn-primary p-1 py-0">show</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=6 class="text-center">Not fount Search</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <hr>
                <h4 class="card-title w-100 text-center">New Search Create</h4>
                <form action="{{ route('search_create') }}" method = 'post' class="text-center" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="region_id" class="mb-2">Region</label>
                            <select name="region_id" class="form-select" required>
                                <option value="">Selected</option>
                                @foreach($Region as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="substanse_id" class="mb-2 mt-2">Substance</label>
                            <select name="substanse_id" class="form-select" required>
                                <option value="">Selected</option>
                                @foreach($Substance as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['number'] }} {{ $item['part'] }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col-6">
                                    <label for="type" class="mb-2 mt-2">Search Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Selected</option>
                                        <option value="Rasmiy qidiruv">Rasmiy qidiruv</option>
                                        <option value="Qidiruv bo'lishi kutilmoqda">Qidiruv bo'lishi kutilmoqda</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="photo" class="mb-2 mt-2">Photo(jpg)</label>
                                    <input type="file" required name="photo" value="{{ old('photo') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <label for="fio" class="mb-2">FIO</label>
                                    <input type="text" required name="fio" value="{{ old('fio') }}" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="fio" class="mb-2">Birthday</label>
                                    <input type="date" required name="data" value="{{ old('data') }}" class="form-control">
                                </div>
                            </div>
                            <label for="addres" class="mb-1">Addres</label>
                            <textarea type="text" required name="addres" value="{{ old('addres') }}" class="form-control"></textarea>
                            <label for="qyj" class="mb-1">QYJ</label>
                            <input type="text" required name="qyj" value="{{ old('qyj') }}" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary w-50 mt-3" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
