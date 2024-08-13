@extends('layouts.auth')

@section('title', 'Posts')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Card for Post List -->
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">Post List</h2>
        </div>
        @if (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('alert-success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-body">
            @if(count($posts) > 0)
                <table class="table" id="posts">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Status</th>
                            <th class="text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ $post->gallery->image }}" style="width: 120px" alt="post image"></td>
                            <td>{{ Str::limit($post->title, 10) }}</td>
                            <td>{{ Str::limit($post->description, 10) }}</td>
                            <td>{{ $post->category->name }}</td> <!-- Changed to lowercase 'c' for consistency -->
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <span class="badge {{ $post->status ? 'badge-success' : 'badge-danger' }}">
                                    {{ $post->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm mr-1" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-warning btn-sm mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                <form method="post" action="{{route('posts.destroy', $post->id)}}" style="display: inline-block; margin: 0;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">
                                        <a class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></a>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger text-center" role="alert">
                    No Post Found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#posts').DataTable({
            'bLengthChange' : false
        });
    })
</script>
@endsection
