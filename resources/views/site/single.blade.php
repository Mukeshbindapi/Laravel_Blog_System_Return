@extends('layouts.site')

@section('title', 'Single Blade')
@section('styles')

@section('content')
<section class="page-title bg-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-capitalize mb-4 text-lg">Blog Single</h1>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
              <li class="list-inline-item"><span class="text-white">/</span></li>
              <li class="list-inline-item text-white-50">Blog details</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  @if ($blog)
  <section class="section blog-wrap bg-gray">
    <div class="container">

<script src="https://developercodez.com/developerCorner/parsley/parsley.min.js"></script>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="single-blog-item">
                          <img src="{{ $blog->gallery->image}}" alt="blog" class="img-fluid rounded">

                            <div class="blog-item-content bg-white p-5">
                                <div class="blog-item-meta bg-gray pt-2 pb-1 px-3">
                                    <span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i>Creativity</span>
                                    <span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i>{{ count($comments)}} Comments</span>
                                    <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i>{{ date('d-M-Y', strtotime($blog->created_at)) }}</span>
                                </div>

                                <h2 class="mt-3 mb-4">{{ $blog->title }}</h2>
                                <p class="lead mb-4">{{ $blog->description }}</p>

                                <div class="tag-option mt-5 d-block d-md-flex justify-content-between align-items-center">
                                    <ul class="list-inline">
                                        <li>Tags:</li>
                                        @foreach ($blog->tags as $tag)
                                        <li class="list-inline-item"><a href="#" rel="tag">{{ ucfirst($tag->name) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-5">

                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li  class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ Session::get('alert-success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12 mb-5">
                        <div class="form-group">
                            <form action="{{ route('post.comment', $blog->id) }}" method="post">
                                @csrf
                                <label for="comment"><strong>Comment</strong></label>
                                <textarea name="comment" id="comment" class="form-control" cols="20" rows="3" placeholder="Enter comment here..."></textarea>
                                <button type="submit" class="btn btn-sm btn-info mt-3" style="float: right;">Comment</button>
                            </form>
                        </div>
                    </div>

                    @if(count($comments) > 0)
                        <div class="col-lg-12 mb-5" id="comment-section">
                            <div class="comment-area card border-0 p-5">
                                <h4 class="mb-4">{{ count($comments)}} Comments</h4>
                                <ul class="comment-tree list-unstyled">
                                    @foreach ($comments as $comment)
                                        <li class="mb-5">
                                            <div class="comment-area-box">
                                                <img loading="lazy" alt="comment-author" src="{{ $blog->gallery->image}}" class="img-fluid float-left mr-3 mt-2" style="width: 90px">

                                                <h5 class="mb-1">{{ $comment->user ? $comment->user->name : '' }}</h5>
                                                <span>{{ $comment->user ? $comment->user->email : '' }}</span>

                                                <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                                    <span class="date-comm">{{ $comment->user ? date('d-M-Y', strtotime($comment->user->created_at)) : '' }}</span>
                                                </div>

                                                <div class="comment-content mt-3">
                                                    <p>{{ $comment ? $comment->comment : '' }}</p>
                                                </div>

                                                <div class="ml-5">
                                                   @if ($comment->commentReplies)
                                                       @foreach ($comment->commentReplies as $reply)
                                                            <form method="post" action="{{ route('comment.reply.delete', $reply->id) }}">
                                                                @csrf
                                                                <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                                                    <span><button type="submit" class=" btn-danger "><i class="fa fa-trash"></i></button></span>
                                                                </div>
                                                            </form>

                                                            <div class="comment-content mt-3">
                                                                    <p>{{ $reply->comment }}
                                                            </div>

                                                       @endforeach
                                                   @endif
                                                </div>

                                                <span class="reply-show" style="float:right; cursor: pointer;">Reply</span>
                                                <div class="form-group comment-reply-div">
                                                    <form action="{{ route('comment.reply',  $comment->id) }}" method="post">
                                                        @csrf
                                                        <textarea name="comment" id="comment" class="form-control" cols="20" rows="3" placeholder="Enter comment here..."></textarea>
                                                        <button class="btn btn-sm btn-info mt-3" style="float: right;">Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <span>{{ $comments->links() }}</span>
                        </div>


                    @endif
                 </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-wrap">
                    @if (count($latestBlogs) > 0)
                        <div class="sidebar-widget latest-post card border-0 p-4 mb-3">
                            <h5>Latest Posts</h5>
                            @foreach ($latestBlogs as $latestBlog)
                                <div class="media border-bottom py-3">
                                    <a href="{{ route('single-blog', $latestBlog->id) }}"><img loading="lazy" class="mr-4" src="{{ $latestBlog->gallery->image }}" style="width: 90px" alt="blog"></a>
                                    <div class="media-body">
                                        <h6 class="my-2"><a href="{{ route('single-blog', $latestBlog->id) }}">{{ $latestBlog->title }}</a></h6>
                                        <span class="text-sm text-muted">{{ date('d-M-Y', strtotime($latestBlog->created_at)) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="sidebar-widget bg-white rounded tags p-4 mb-3">
                        <h5 class="mb-4">Tags</h5>
                        @if (count($tags) > 0)
                            @foreach ($tags as $tag)
                                <a href="{{ route('single-blog', $tag->posts->first()) }}">{{ $tag->name }}</a>
                            @endforeach
                        @else
                            <h6 class="text-center text-danger">Tag not found</h6>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
  @else
    <h3 class="text-center text-danger mt-5">Unable to locate the blog, please go to back and try again.</h3>
  @endif
  <script>
    $('.comment-reply-div').hide();
    $(document).ready(function(){
        $('.reply-show').click(function(){
            $(this).next('.comment-reply-div').toggle('swing');
        })
    })
</script>

<script>
    $('html,body').animate({
        scrollTop: $('#comment-section').offset().top
    },2000);
</script>
@endsection

