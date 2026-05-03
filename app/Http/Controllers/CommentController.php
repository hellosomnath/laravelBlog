<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ],
        [
            'username' => 'The name field is required',
            'body'     => 'Comment cannot be empty'
        ]);

        $formFields['blog_id'] = $request->blog_id;
        $formFields['website'] = $request->website ?? null;

        $comment = Comment::create($formFields);
        return back()->with('success', 'Comment posted successfully');
    }

    public function reply(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ],
        [
            'username' => 'The name field is required',
            'body'     => 'Comment cannot be empty'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => implode('<br>', $validator->errors()->all())]);
        }

        $comment = new Comment();
        $comment->blog_id = $request->blog_id;
        $comment->parent_id = $request->parent_id;
        $comment->username = $request->username;
        $comment->email = $request->email;
        $comment->website = $request->website ?? null;
        $comment->body = $request->body;
        $comment->save();

        return response()->json(['success' => 'Reply posted', 'url' => url('/blogs/'.$request->blog_id)]);

    }
}
