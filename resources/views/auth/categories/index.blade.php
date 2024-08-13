@extends('layouts.auth')

@section('title', 'View Categories')

@section('styles')
<link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Card for Post List -->
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">View Categories</h2>
        </div>
        <div class="card-body">
            @if($categories)
            <table class="table" id="posts">
                <tbody>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Category Name</th>
                    </tr>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    @endforeach
            </table>
            @else
            <div class="alert alert-danger text-center" role="alert">
                No Categories Found.
            </div>
        @endif
        </div>
    </div>
</div>
@endsection