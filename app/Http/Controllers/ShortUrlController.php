<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    /**
     * Display short URLs.
     */
    public function index()
    {
        $user = auth()->user();

        $query = ShortUrl::with(['user', 'company'])
            ->latest();

        if ($user->hasRole('SuperAdmin')) {

            // SuperAdmin can see all short URLs
            $shortUrls = $query->get();

        } elseif ($user->hasRole('Admin')) {

            // Admin can see only URLs created in their own company
            $shortUrls = $query
                ->where('company_id', $user->company_id)
                ->get();

        } elseif ($user->hasRole('Member')) {

            // Member can see only URLs created by themselves
            $shortUrls = $query
                ->where('user_id', $user->id)
                ->get();

        } else {

            $shortUrls = collect();

        }

        return view('short-urls.index', compact('shortUrls'));
    }

    /**
     * Show create short URL form.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            abort(403);
        }

        return view('short-urls.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            abort(403);
        }

        $request->validate([
            'original_url' => 'required|url|max:65535',
            'title' => 'nullable|string|max:255',
        ]);

        ShortUrl::create([
            'uuid' => (string) Str::uuid(),
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'short_code' => Str::random(8),
            'title' => $request->title,
            'hits' => 0,
            'status' => true,
        ]);

        return redirect()
            ->route('short-urls.index')
            ->with('success', 'Short URL created successfully.');
    }

    public function redirect($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)
            ->where('status', true)
            ->firstOrFail();

        $shortUrl->increment('hits');

        return redirect()->away($shortUrl->original_url);
    }

    public function show(ShortUrl $shortUrl)
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {

            // SuperAdmin can view all
            return view('short-urls.show', compact('shortUrl'));

        } elseif ($user->hasRole('Admin')) {

            // Admin can only view own company's URLs
            if ($shortUrl->company_id != $user->company_id) {
                abort(403);
            }

        } elseif ($user->hasRole('Member')) {

            // Member can only view their own URLs
            if ($shortUrl->user_id != $user->id) {
                abort(403);
            }

        } else {

            abort(403);

        }

        return view('short-urls.show', compact('shortUrl'));
    }
}