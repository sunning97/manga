<?php

namespace App\Http\Controllers\Site;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manga;
use Illuminate\Support\Facades\DB;

class AxiosController extends Controller
{
    public function getComments(Request $request)
    {
        $manga = Manga::findOrFail($request->manga_id);

        $comments = DB::table('comments')
            ->leftJoin('users','users.id','=','comments.user_id')
            ->where('manga_id','=',$manga->id)
            ->whereNull('parent_comment')
            ->select(['comments.id as comment_id','comments.content','comments.parent_comment','comments.user_id','comments.created_at','users.id','users.f_name','users.l_name','users.avatar'])
            ->paginate(5);

        return response()->json($comments,200);
    }

    public function getTotalComments(Request $request)
    {
        $total = Comment::where('manga_id','=',$request->manga_id)
            ->whereNull('parent_comment')->count();
        return response()->json($total,200);
    }

    public function getChildComments(Request $request)
    {
        $comments = DB::table('comments')
            ->leftJoin('users','users.id','=','comments.user_id')
            ->where('comments.parent_comment','=',$request->parent_comment)
            ->select(['comments.id as comment_id','comments.content','comments.parent_comment','comments.user_id','comments.created_at','users.id','users.f_name','users.l_name','users.avatar'])
            ->get();

        if($comments->all()){
            return response()->json($comments,200);
        }
        return response('no child comment',404);

    }
}
