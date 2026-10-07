<?php

namespace App\Http\Controllers;

use App\Models\CommunityComment;
use App\Models\CommunityPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CommunityController extends Controller
{
    public function index(Request $request): View
    {
        if (! Schema::hasTable('community_posts') || ! Schema::hasTable('community_comments')) {
            return view('community.index', ['posts' => collect(), 'available' => false]);
        }
        $posts = CommunityPost::query()
            ->when(! $request->user()?->isAdmin(), fn ($query) => $query->where('status', 'published'))
            ->with('author:id,name')
            ->withCount('comments')
            ->latest()
            ->paginate(15);

        return view('community.index', ['posts' => $posts, 'available' => true]);
    }

    public function show(Request $request, CommunityPost $communityPost): View
    {
        abort_if($communityPost->status !== 'published' && ! $request->user()?->isAdmin(), 404);
        $communityPost->load(['author:id,name,is_admin', 'comments.author:id,name,is_admin']);

        return view('community.show', ['post' => $communityPost]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_if($request->user()->is_restricted && ! $request->user()->isAdmin(), 403, 'Posting is restricted for this account.');
        $data = $request->validate(['title' => ['required', 'string', 'min:5', 'max:180'], 'body' => ['required', 'string', 'min:10', 'max:12000']]);
        $post = CommunityPost::create(['user_id' => $request->user()->getKey(), 'title' => trim($data['title']), 'body' => trim($data['body'])]);

        return redirect()->route('community.show', $post)->with('status', 'Your feedback is now live.');
    }

    public function comment(Request $request, CommunityPost $communityPost): RedirectResponse
    {
        abort_if($request->user()->is_restricted && ! $request->user()->isAdmin(), 403, 'Posting is restricted for this account.');
        abort_if($communityPost->status !== 'published' && ! $request->user()->isAdmin(), 404);
        $data = $request->validate(['body' => ['required', 'string', 'min:2', 'max:8000']]);
        $communityPost->comments()->create(['user_id' => $request->user()->getKey(), 'body' => trim($data['body'])]);

        return back()->with('status', 'Your reply has been posted.');
    }

    public function updatePost(Request $request, CommunityPost $communityPost): RedirectResponse
    {
        $this->authorizePost($request, $communityPost);
        $data = $request->validate(['title' => ['required', 'string', 'min:5', 'max:180'], 'body' => ['required', 'string', 'min:10', 'max:12000']]);
        $communityPost->update(['title' => trim($data['title']), 'body' => trim($data['body'])]);

        return back()->with('status', 'Your post has been updated.');
    }

    public function deletePost(Request $request, CommunityPost $communityPost): RedirectResponse
    {
        $this->authorizePost($request, $communityPost);
        $communityPost->comments()->delete();
        $communityPost->delete();

        return redirect()->route('community.index')->with('status', 'The post and its replies were deleted.');
    }

    public function updateComment(Request $request, CommunityPost $communityPost, CommunityComment $comment): RedirectResponse
    {
        $this->authorizeComment($request, $communityPost, $comment);
        $data = $request->validate(['body' => ['required', 'string', 'min:2', 'max:8000']]);
        $comment->update(['body' => trim($data['body'])]);

        return back()->with('status', 'The reply has been updated.');
    }

    public function deleteComment(Request $request, CommunityPost $communityPost, CommunityComment $comment): RedirectResponse
    {
        $this->authorizeComment($request, $communityPost, $comment);
        $comment->delete();

        return back()->with('status', 'The reply was deleted.');
    }

    public function moderate(Request $request, CommunityPost $communityPost): RedirectResponse
    {
        abort_unless($request->user()->isAdmin(), 403);
        $data = $request->validate(['status' => ['required', 'in:published,hidden']]);
        $communityPost->update($data);

        return back()->with('status', $data['status'] === 'published' ? 'Post published.' : 'Post hidden from the community.');
    }

    private function authorizePost(Request $request, CommunityPost $post): void
    {
        abort_unless($request->user()->isAdmin() || (int) $post->user_id === (int) $request->user()->getKey(), 404);
    }

    private function authorizeComment(Request $request, CommunityPost $post, CommunityComment $comment): void
    {
        abort_unless((int) $comment->post_id === (int) $post->getKey(), 404);
        abort_unless($request->user()->isAdmin() || (int) $comment->user_id === (int) $request->user()->getKey(), 404);
    }
}
