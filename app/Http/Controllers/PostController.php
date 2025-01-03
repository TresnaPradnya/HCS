<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::where(function ($query) {
            $query->where('visibility', 'public')
                  ->orWhere('user_id', auth()->id());
        })
        ->latest()
        ->get();

        return view('posts.index', compact('posts'));
    }

    public function create(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $transportation_footprint = $request->input('transportation_footprint');
        $energy_footprint = $request->input('energy_footprint');
        $diet_footprint = $request->input('diet_footprint');
        $total_footprint = $request->input('total_footprint');
        $pieChartImage = $request->query('pie_chart_image');
        $lineChartImage = $request->query('line_chart_image');

        return view('posts.create', compact(
            'startDate',
            'endDate',
            'pieChartImage',
            'lineChartImage',
            'transportation_footprint',
            'energy_footprint',
            'diet_footprint',
            'total_footprint'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'content' => 'nullable|string|max:255',
            'pie_chart_image' => 'nullable|string',
            'line_chart_image' => 'nullable|string',
            'transportation_footprint' => 'required|numeric|min:0',
            'energy_footprint' => 'required|numeric|min:0',
            'diet_footprint' => 'required|numeric|min:0',
            'total_footprint' => 'required|numeric|min:0',
            'visibility' => 'required|in:public,private',
        ]);


        try {
            Post::create([
                'user_id' => Auth::id(),
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'content' => $validated['content'],
                'pie_chart_image' => $validated['pie_chart_image'],
                'line_chart_image' => $validated['line_chart_image'],
                'transportation_footprint' => $validated['transportation_footprint'],
                'energy_footprint' => $validated['energy_footprint'],
                'diet_footprint' => $validated['diet_footprint'],
                'total_footprint' => $validated['total_footprint'],
                'visibility' => $validated['visibility'],
            ]);

            return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create the post. Please try again.']);
        }
    }

    public function show($id)
    {
        $post = Post::findOrFail($id); // Find the post or throw a 404 error if not found
        return view('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }



}
