<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function formatTanggal($tanggalDatabase)
    {
        // Ubah format tanggal dari database ke dalam objek Carbon
        $carbonTanggal = Carbon::createFromFormat('Y-m-d H:i:s', $tanggalDatabase);

        // Format tanggal dalam bahasa Indonesia
        setlocale(LC_TIME, 'id'); // Set the locale to Indonesian
        $tanggal_hasil = $carbonTanggal->formatLocalized('%e %B %Y, %H:%M');
        setlocale(LC_TIME, 'en'); // Reset the locale back to English
        return $tanggal_hasil;
    }

    public function index()
    {
        $this->authorize('creator', User::class);
        $userPost = Post::latest()->where('user_id', auth()->user()->id)->get()->map(function ($post) {
            $post->formatted_post = $this->formatTanggal($post->created_at);
            return $post;
        });

        return view('dashboard.posts.index', [
            'title' => 'My Posts',
            'posts' => $userPost,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('creator', User::class);
        return view('dashboard.posts.create', [
            'title' => 'Create Post',
            'category' => Category::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('creator', User::class);
        $validasi = [
            'title' => 'required|max:100|unique:posts,title',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'post_tag' => '',
            'image' => 'image|required|file|max:5120'
        ];

        $validatedData = $request->validate(
            $validasi,
            [
                'title.required' => 'Judul Tidak Boleh Kosong!',
                'title.max' => 'Max 100 Character!',
                'title.unique' => 'Judul Sudah Ada!',

                'slug.required' => 'Slug Tidak Boleh Kosong!',
                'slug.unique' => 'Slug Sudah Ada!',

                'content.required' => 'Contet Tidak Boleh Kosong!',

                'image.image' => 'File Harus Berupa Gambar!',
                'image.required' => 'Gambar Tidak Boleh Kosong!',
                'image.max' => 'Size Gambar Tidak Boleh Lebih Dari 5mb!'
            ]
        );

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $validatedData['image'] = $request->file('image')->store('images');
        }



        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request['title'],
            'slug' => $request['slug'],
            'category_id' => $request['category_id'],
            'post_tag' => $request['post_tag'],
            'content' => $request['content'],
            'image' => $image
        ]);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Membuat Content Baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('creator', User::class);
        $tagArray = [];
        $tagArray = array_merge($tagArray, explode(',', $post->post_tag));
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'tag' => $tagArray,
            'category' => Category::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('creator', User::class);
        $validasi = [
            'content' => 'required',
            'image' => 'image|required|file|max:5120',
            'post_tag' => 'required'
        ];

        if ($request->title != $post->title) {
            $validasi['title'] = 'required|max:100|unique:posts,title';
        }
        if ($request->slug != $post->slug) {
            $validasi['slug'] = 'required|unique:posts,slug';
        }

        $validatedData = $request->validate(
            $validasi,
            [
                'title.required' => 'Judul Tidak Boleh Kosong!',
                'title.max' => 'Max 100 Character!',
                'title.unique' => 'Judul Sudah Ada!',

                'slug.required' => 'Slug Tidak Boleh Kosong!',
                'slug.unique' => 'Slug Sudah Ada!',

                'content.required' => 'Contet Tidak Boleh Kosong!',

                'image.image' => 'File Harus Berupa Gambar!',
                'image.required' => 'Gambar Tidak Boleh Kosong!',
                'image.max' => 'Size Gambar Tidak Boleh Lebih Dari 5mb!'
            ]
        );

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $validatedData['image'] = $request->file('image')->store('images');
        } else {
            $image = $post->image;
        }



        Post::where('id', $post->id)
            ->update([
                'user_id' => auth()->user()->id,
                'title' => $request['title'],
                'slug' => $request['slug'],
                'post_tag' => $request['post_tag'],
                'category_id' => $request['category_id'],
                'content' => $request['content'],
                'image' => $image
            ]);

        return redirect('/dashboard/posts')->with('success', 'Berhasil Update Berita/Artikel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('creator', User::class);
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Berhasil Menghapus Berita/Artikel');
    }
}
