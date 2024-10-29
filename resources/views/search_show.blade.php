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
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header w-100 text-center">{{ $Search['fio'] }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="../photo/{{ $Search['photo'] }}" style="width:100%">
                            </div>
                            <div class="col-8">
                                <p><b>Region: </b> {{ $Search['name'] }}</p>
                                <p><b>Addres: </b> {{ $Search['addres'] }}</p>
                                <p><b>KYJ: </b> {{ $Search['qyj'] }}</p>
                                <p><b>Birthday: </b> {{ $Search['data'] }}</p>
                                <p><b>Type: </b> {{ $Search['type'] }}</p>
                                <p><b>Substance : </b> {{ $Search['number'] }} {{ $Search['part'] }}</p>
                            </div>
                            <form action="{{ route('search_update_photo') }}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="id" value="{{ $Search['id'] }}">
                                <label for="photo" class="w-100 text-center">Change image</label>
                                <input type="file" name="photo" class="form-control" required >
                                <button class="btn btn-primary w-100">Save</button>
                            </form>
                            <form action="{{ route('search_delete') }}" method="post" class="w-100 text-center pt-4">
                                @csrf 
                                <input type="hidden" name="id" value="{{ $Search['id'] }}">
                                <button class="btn btn-danger">delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">Update</div>
                    <div class="card-body">
                        <form action="{{ route('search_update_data') }}" method="post">
                            @csrf 
                            <input type="hidden" name="id" value="{{ $Search['id'] }}">
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
                            <label for="type" class="mb-2 mt-2">Search Type</label>
                            <select name="type" class="form-select" required>
                                <option value="">Selected</option>
                                <option value="Rasmiy qidiruv">Rasmiy qidiruv</option>
                                <option value="Qidiruv bo'lishi kutilmoqda">Qidiruv bo'lishi kutilmoqda</option>
                            </select>
                            <label for="fio" class="mb-2">FIO</label>
                            <input type="text" required name="fio" value="{{ $Search['fio'] }}" class="form-control">
                            <label for="fio" class="mb-2">Birthday</label>
                            <input type="date" required name="data" value="{{ $Search['data'] }}" class="form-control">
                            <label for="addres" class="mb-1">Addres</label>
                            <textarea type="text" required name="addres" class="form-control">{{ $Search['addres'] }}</textarea>
                            <label for="qyj" class="mb-1">QYJ</label>
                            <input type="text" required name="qyj" value="{{ $Search['fio'] }}" class="form-control">
                            <button class="btn btn-primary w-100 mt-3" type="submit">Update now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
