<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Output\NullOutput;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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
        $allposts = Post::latest('created_at')->get();
        $posts = Post::latest('created_at')->paginate(10);
        foreach ($posts as $post) {
            $post->formatted_posts = $this->formatTanggal($post->created_at);
        }

        $recPosts = $allposts->where('pilihan', 1)->map(function ($rec) {
            $rec->formatted_rec = $this->formatTanggal($rec->created_at);
            return $rec;
        });

        $PostByCategory1 = Category::inRandomOrder()->first();
        $PostByCategory2 = Category::inRandomOrder()->first();

        if ($PostByCategory1->id == $PostByCategory2->id) {
            $PostByCategory2 = Category::inRandomOrder()->first();
        }

        return view('home.index', [
            'title' => 'home',
            'post' => $posts,
            'recPosts' => $recPosts,
            'randomPosts' => Post::whereMonth('created_at', date('n'))->inRandomOrder()->take(10)->get(),
            'categories' => Category::all()->sortBy('name'),
            'postbycategory1' => Post::where('category_id', $PostByCategory1->id)->take(10)->get(),
            'categoryName1' => $PostByCategory1->name,
            'postbycategory2' => Post::where('category_id', $PostByCategory2->id)->take(9)->get(),
            'categoryName2' => $PostByCategory2->name,
        ]);
    }

    public function indeks()
    {
        $posts = Post::latest('created_at')->filter(request(['search', 'tag', 'category', 'user']))->paginate(10);
        foreach ($posts as $post) {
            $post->formatted_posts = $this->formatTanggal($post->created_at);
        }

        $title = '';
        if (request('search') == '') {
            $title = 'Semua Berita';
        }
        if (request('search')) {
            $title = 'Search : ' . request('search');
        }
        if (request('tag')) {
            $title = 'Tag : ' . request('tag');
        }
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Semua BeritaCategory ' . $category->name;
        }
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = 'Semua Berita Dari ' . $user->name;
        }

        $PostByCategory1 = Category::inRandomOrder()->first();
        $PostByCategory2 = Category::inRandomOrder()->first();

        if ($PostByCategory1->id == $PostByCategory2->id) {
            $PostByCategory2 = Category::inRandomOrder()->first();
        }

        Paginator::defaultView('paginator');
        return view('home.indeks', [
            'title' => 'Indeks',
            'subTitle' => $title,
            "posts" => $posts->withQueryString(),
            'randomPosts' => Post::whereMonth('created_at', date('n'))->inRandomOrder()->take(10)->get(),
            'categories' => Category::all()->sortBy('name'),
            'postbycategory1' => Post::where('category_id', $PostByCategory1->id)->take(10)->get(),
            'categoryName1' => $PostByCategory1->name,
            'postbycategory2' => Post::where('category_id', $PostByCategory2->id)->take(9)->get(),
            'categoryName2' => $PostByCategory2->name,
        ]);
    }

    public function read(Post $post)
    {
        $action = [];
        if (Auth::guest()) {
            $action = '';
        } else {
            $action = Action::where('user_id', auth()->user()->id)->where('post_id', $post->id)->first();
        }
        $PostByCategory1 = Category::inRandomOrder()->first();
        $PostByCategory2 = Category::inRandomOrder()->first();

        if ($PostByCategory1->id == $PostByCategory2->id) {
            $PostByCategory2 = Category::inRandomOrder()->first();
        }

        $tagArray = [];
        $tagArray = array_merge($tagArray, explode(',', $post->post_tag));
        return view('home.read', [
            'title' => $post->title,
            'post' => $post,
            'tag' => $tagArray,
            'action' => $action,
            'randomPosts' => Post::whereMonth('created_at', date('n'))->inRandomOrder()->take(10)->get(),
            'categories' => Category::all()->sortBy('name'),
            'postbycategory1' => Post::where('category_id', $PostByCategory1->id)->take(10)->get(),
            'categoryName1' => $PostByCategory1->name,
            'postbycategory2' => Post::where('category_id', $PostByCategory2->id)->take(9)->get(),
            'categoryName2' => $PostByCategory2->name,
        ]);
    }

    public function profile()
    {
        $this->authorize('guest', User::class);
        return view('dashboard.profile', [
            'title' => 'Profile',
            'user' => auth()->user()
        ]);
    }
    public function profile_update(Request $request, User $id)
    {
        $this->authorize('guest', User::class);
        $validasi = [
            'image' => 'image|file|max:5120',
        ];


        if ($request->name != $id->name) {
            $validasi['name'] = 'required|max:30|unique:users,name';
        }
        if ($request->email != $id->email) {
            $validasi['email'] = 'required|email|unique:users,email';
        }
        if ($request['password'] == null) {
            $password = $id->password;
        } else {
            $password = bcrypt($request['password']);
            $validasi['password'] = 'required|min:4';
        }

        $validatedData = $request->validate(
            $validasi,
            [
                'name.required' => 'Nama Tidak Boleh Kosong!',
                'name.unique' => 'Nama Sudah Ada!',
                'name.max' => 'Max 30 Character!',

                'email.required' => 'Email Tidak Boleh Kosong!',
                'email.email' => 'Email Harus Berupa Email Yang Benar!',
                'email.unique' => 'Email Sudah Ada!',

                'password.required' => 'Password Tidak Boleh Kosong!',
                'password.min' => 'Password Harus Minimal 4 Huruf/Angka!',

                'image.image' => 'File Harus Berupa Gambar!',
                'image.max' => 'Size Gambar Tidak Boleh Lebih Dari 5mb!'
            ]
        );

        if ($id->img == 'user.png') {

            if ($request->file('img')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['image'] = $request->file('img')->store('images');
            } else {
                $image = 'user.png';
            }
        } else {
            if ($request->file('img')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['image'] = $request->file('img')->store('images');
            } else {
                $image = $id->img;
            }
        }

        User::where('id', $id->id)
            ->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => $password,
                'alamat' => $request['alamat'],
                'img' => $image
            ]);

        return redirect('/profile')->with('success', 'Berhasil Update Profile');
    }

    public function users()
    {
        $this->authorize('admin', User::class);
        return view('dashboard.users', [
            'title' => 'Users',
            'users' => User::all()->sortBy(['level', 'name'])
        ]);
    }

    public function users_update(User $id)
    {
        $this->authorize('admin', User::class);
        User::where('id', $id->id)
            ->update(['level' => 2]);
        return redirect('/users')->with('success', 'Berhasil Update Level User');
    }
    public function users_demotion(User $id)
    {
        $this->authorize('admin', User::class);
        User::where('id', $id->id)
            ->update(['level' => 3]);
        return redirect('/users')->with('success', 'Berhasil Update Level User');
    }

    public function recPosts(Request $request)
    {
        $this->authorize('creator', User::class);
        $keyword = $request->input('search');
        $posts = Post::latest('created_at')->where('title', 'like', "%$keyword%")
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->paginate(10);
        foreach ($posts as $post) {
            $post->formatted_posts = $this->formatTanggal($post->created_at);
        }

        Paginator::defaultView('paginator');
        return view('dashboard.recPosts', [
            'title' => 'Posts',
            'posts' => $posts
        ]);
    }
    public function recPosts_update(Post $id)
    {
        $this->authorize('admin', User::class);
        Post::where('id', $id->id)
            ->update(['pilihan' => 1]);
        return redirect('/recPosts')->with('success', 'Berhasil Mengubah Post Menjadi Berita Pilihan');
    }
    public function recPosts_demotion(Post $id)
    {
        $this->authorize('admin', User::class);
        Post::where('id', $id->id)
            ->update(['pilihan' => 0]);
        return redirect('/recPosts')->with('success', 'Berhasil Menghapus Berita Pilihan');
    }

    public function action(Request $request, Post $id)
    {
        $user = auth()->user();
        $dataUser = Action::where('user_id', $user->id);
        if ($dataUser) {
            if ($dataUser->where('post_id', $id->id)->first()) {
                $data = $dataUser->where('post_id', $id->id)->get();
                foreach ($data as $action) {
                    $like = $action['like'] ? NULL : $id->slug;
                    $dislike = $action['dislike'] ? NULL : $id->slug;
                    $bookmark = $action['bookmark'] ? NULL : $id->slug;
                    Action::where('user_id', $user->id)->where('post_id', $id->id)->first()
                        ->update([
                            'like' => $request->like ? $like : NULL,
                            'dislike' => $request->dislike ? $dislike : NULL,
                        ]);
                    return back();
                }
            } else {
                Action::create([
                    'user_id' => $user->id,
                    'post_id' => $id->id,
                    'like' => $request->like ? $id->slug : NULL,
                    'dislike' => $request->dislike ? $id->slug : NULL,
                    'bookmark' => NULL,
                ]);
                return back();
            }
        } else {
            Action::create([
                'user_id' => $user->id,
                'post_id' => $id->id,
                'like' => $request->like ? $id->slug : NULL,
                'dislike' => $request->dislike ? $id->slug : NULL,
                'bookmark' => NULL,
            ]);
            return back();
        }
    }

    public function bookmark(Request $request, Post $id)
    {
        $user = auth()->user();
        $dataUser = Action::where('user_id', $user->id);
        if ($dataUser) {
            if ($dataUser->where('post_id', $id->id)->first()) {
                $data = $dataUser->where('post_id', $id->id)->get();
                foreach ($data as $action) {
                    $bookmark = $action['bookmark'] ? NULL : $id->slug;
                    Action::where('user_id', $user->id)->where('post_id', $id->id)->first()
                        ->update([
                            'bookmark' => $request->bookmark ? $bookmark : NULL,
                        ]);
                    return back();
                }
            } else {
                Action::create([
                    'user_id' => $user->id,
                    'post_id' => $id->id,
                    'like' => NULL,
                    'dislike' =>  NULL,
                    'bookmark' => $request->bookmark ? $id->slug : NULL,
                ]);
                return back();
            }
        } else {
            Action::create([
                'user_id' => $user->id,
                'post_id' => $id->id,
                'like' => NULL,
                'dislike' =>  NULL,
                'bookmark' => $request->bookmark ? $id->slug : NULL,
            ]);
            return back();
        }
    }

    public function postBookmark(User $user)
    {
        $data = Action::latest()->where('user_id', $user->id)->whereNotNull('bookmark')->paginate(10);

        foreach ($data as $post) {
            $post->formatted_posts = $this->formatTanggal($post->created_at);
        }

        $PostByCategory1 = Category::inRandomOrder()->first();
        $PostByCategory2 = Category::inRandomOrder()->first();

        if ($PostByCategory1->id == $PostByCategory2->id) {
            $PostByCategory2 = Category::inRandomOrder()->first();
        }

        Paginator::defaultView('paginator');
        return view('home.saved', [
            'title' => 'Saved',
            'data' => $data,
            'randomPosts' => Post::whereMonth('created_at', date('n'))->inRandomOrder()->take(10)->get(),
            'categories' => Category::all()->sortBy('name'),
            'postbycategory1' => Post::where('category_id', $PostByCategory1->id)->take(10)->get(),
            'categoryName1' => $PostByCategory1->name,
            'postbycategory2' => Post::where('category_id', $PostByCategory2->id)->take(9)->get(),
            'categoryName2' => $PostByCategory2->name,
        ]);
    }

    public function postLike(User $user)
    {
        $data = Action::latest()->where('user_id', $user->id)->whereNotNull('like')->paginate(10);

        foreach ($data as $post) {
            $post->formatted_posts = $this->formatTanggal($post->created_at);
        }

        $PostByCategory1 = Category::inRandomOrder()->first();
        $PostByCategory2 = Category::inRandomOrder()->first();

        if ($PostByCategory1->id == $PostByCategory2->id) {
            $PostByCategory2 = Category::inRandomOrder()->first();
        }

        Paginator::defaultView('paginator');
        return view('home.liked', [
            'title' => 'Liked',
            'data' => $data,
            'randomPosts' => Post::whereMonth('created_at', date('n'))->inRandomOrder()->take(10)->get(),
            'categories' => Category::all()->sortBy('name'),
            'postbycategory1' => Post::where('category_id', $PostByCategory1->id)->take(10)->get(),
            'categoryName1' => $PostByCategory1->name,
            'postbycategory2' => Post::where('category_id', $PostByCategory2->id)->take(9)->get(),
            'categoryName2' => $PostByCategory2->name,
        ]);
    }
}
