@extends('layouts.auth');

@section('title','Update Post | Admin Dashbord');

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/multi-dropdown.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Masked Input -->
        <div class="card card-default">
            <div class="card-header">
                <h2>Update Post</h2>
                {{-- <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-input-musk" role="button" aria-expanded="false" aria-controls="collapse-input-musk"></a> --}}
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" value="{{ old('title',$post->title)}}" class="form-control" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="3" style="resize: none" placeholder="Description">{{ old('title',$post->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Is Publish</label>
                        <select name="status" class="form-control">
                            <option value="" disable dselected>Choose Option</option>
                            <option @selected($post->status == 1) value="1">Publish</option>
                            <option  @selected($post->status == 0) value="0">Draft</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="" disable dselected>Choose Option</option>
                            @if(count($categories) > 0)
                                @foreach ($categories as $category)
                                    <option  @selected($post->category_id == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tags</label>
                        <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true">
                            <option value="" disabled selected>Choose Option</option>
                            @if(count($tags) > 0)
                                @foreach ($tags as $tag)
                                    <option 
                                        value="{{ $tag->id }}" 
                                        @if($postTags->pluck('tag_id')->contains($tag->id)) selected @endif>{{ $tag->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="file" value="{{ old('file') }}" class="form-control" placeholder="Image">
                    </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/auth/js/multi-dropdown.js') }}"></script>
@endsection
