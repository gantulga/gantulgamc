<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\PublishStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
	 * Post a comment.
	 *
     * @param  Request  $request
	 * @param  Post $post
	 * @return Redirect
	 */
	public function post(Request $request, Post $post)
	{
        if(!$post->commentable)
		{
			abort(403);
		}

		if(trim($request->homepage)!='')
		{
			//TODO: Block IP
			abort(403);
		}
		try
		{
			$time = \Crypt::decrypt($request->_t);
			// eger ote dereu (5 sekundtin ishinde) comment submit istegen bolsa
			if( is_numeric($time) && time() < ($time + 5) )
			{
				//TODO: Block IP
				abort(403);
			}
		}
		catch (\Illuminate\Encryption\DecryptException $exception){
			abort(403);
		}

		$ip = $request->ip();
		if(Comment::where('ip', $ip)->where('created_at', '>=', Carbon::now()->subSeconds(5))->count())
		{
			//TODO: Block IP
			abort(403);
		}

        $request->validate([
            'comment' => 'required|min:3',
            'name'	=>	'max:20'
        ], [
            'comment.required' => 'Сэтгэгдэл бичээгүй байна.',
			'comment.min' => 'Сэтгэгдэлийн урт хамгийн багадаа :min тэмдэгт байна.',
			'name.max' => 'Нэрийн урт :max тэмдэгтээс хэтрэх ёсгүй.'
        ]);

        // Save the comment
        $comment = new Comment;
        $comment->text = $request->comment;
        $comment->ip = $ip;
        $comment->parent_id = $request->parent_id ?? null;

        if(\Auth::check()){
            $comment->user_id = \Auth::user()->id;
        }
        else{
            $comment->name = $request->name != '' ? $request->name :'Зочин';
        }

        // Was the comment saved with success?
        if($post->comments()->save($comment))
        {
            // Redirect to this $post page
            return back()
                ->with('comment-success', __('comment.success'));
        }

        return back()->withInput();
	}
}
