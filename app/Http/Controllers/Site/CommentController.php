<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CreateRequest;
use App\Http\Requests\Site\Reply\createRequest as ReplyCreateRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function postComment(CreateRequest $request, $postId)
    {
        if(auth()->check()){
            $post = Post::find($postId);

            if(! $post){
                return back()->WithErrors('Unable to find the post, Please refrash the webPage and try again');
            }
            Comment::create([
                'post_id' => $request->postId,
                'user_id' => auth()->id(),
                'comment' => $request->comment
            ]);
            $request->session()->flash('alert-success', 'Comment added Successfully');
        }
        return back();
        // return to_route('single-blog', $request->postId);
    }

    public function CommentReply(ReplyCreateRequest $request, $commentId){
        $commentId = $request->commentId;
        $comment = $request->comment;

        try{
            CommentReply::create([
                'comment_id' => $commentId,
                'user_id' => auth()->id(),
                'comment' => $comment
            ]);
        }
        catch(\Exception $ex){
            return back()->withErrors($ex->getMessage());
        }

        $request->session()->flash('alert-success', 'Comment Reply added Successfully');
        return back();
    }

    public function commentReplyDelete(Request $request, $replyId){

        $reply = CommentReply::find($replyId);

        if(! $reply){
            return back()->withErrors('unabel to locate the reply please refresh theh webpage and try again, if still problem persists contact the administrator');
        }

        $reply->delete();

        $request->session()->flash('alert-success', 'Comment Reply delete Successfully');
        return back();
    }
}
