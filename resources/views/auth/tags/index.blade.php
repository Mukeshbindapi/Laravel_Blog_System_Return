@extends('layouts.auth')

@section('title', 'View Tags')

@section('styles')
<link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Card for Post List -->
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">View Tags</h2>
        </div>
        <div class="card-body">
            @if($tags)
            <table class="table" id="posts">
                <tbody>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tag Name</th>
                    </tr>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
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