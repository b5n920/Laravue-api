<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentResource;
use App\Http\Resources\V1\CommentCollection;
use App\Models\Comment;
use Illuminate\Validation\Rule;
use App\Models\Skill;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($skill) {
        return new CommentCollection(Comment::where('skills_id', $skill)->latest()->get());
        // return new CommentCollection(Comment::where('skills_id', $skill->id)->orderBy('created_at')->get());
    }

    public function store(Request $request) {
        $request['user_id'] = auth()->id();       
        $attributes = $request->all(); 
        $attributes = $this->validateComment( new Comment());
        
        Comment::create($attributes);

        return response()->json("Comment commented!");
    }

    protected function validateComment(?Comment $comment = null): array{
        $comment ??= new Comment();

        return request()->validate([
            'body' => 'required',
            'skills_id' => ['required', Rule::exists('skills', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);
    }
}
