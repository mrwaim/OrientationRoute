<?php

namespace Klsandbox\OrientationRoute\Http\Controllers;

use App\Models\User;
use Klsandbox\OrientationRoute\Models\UserVideo;
use Klsandbox\OrientationRoute\Models\Video;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Klsandbox\RoleModel\Role;

class VideoController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Video
     */
    protected $video;

    /**
     * @var UserVideo
     */
    protected $userVideo;

    /**
     * HomeController constructor.
     *
     * @param User $user
     * @param Video $video
     * @param UserVideo $userVideo
     * @param Request $request
     */
    public function __construct(User $user, Video $video, UserVideo $userVideo, Request $request)
    {
        $this->user = $user;
        $this->video = $video;
        $this->userVideo = $userVideo;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('orientation-route::all')
            ->withVideos($this->video->orderBy('order_number', 'asc')->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function allVideos()
    {
        return view('orientation-route::all-videos')
            ->withVideos($this->video->orderBy('order_number', 'asc')->get());
    }

    /**
     * View a video.
     *
     * @param Video $video
     * @return mixed
     */
    public function video(Video $video)
    {
        $next = $this->video->where('order_number', '>', $video->order_number)->orderBy('order_number', 'asc');
        $previous = $this->video->where('order_number', '<', $video->order_number)->orderBy('order_number', 'desc');

        return view('orientation-route::view')
            ->withVideo($video)
            ->withInfo('info', ['title' => $video->title])
            ->withNext($next)
            ->withPrevious($previous);
    }

    /**
     * Watch a video fully.
     *
     * @param Video $video
     * @return mixed
     */
    public function watchVideo(Video $video)
    {
        if ($video->count() > 0) {
            $this->userVideo->create([
                'user_id' => Auth::user()->id,
                'video_id' => $video->id,
            ]);

            return redirect()->back()
                ->withSuccess('Video watched');
        }

        abort(404);
    }

    /**
     * Unwatch a video.
     *
     * @param Video $video
     * @return mixed
     */
    public function unwatchVideo(Video $video)
    {
        $watchedVideo = $this->userVideo->where('video_id', '=', $video->id)->where('user_id', '=', Auth::user()->id)->first();

        if ($watchedVideo->count() > 0) {
            $watchedVideo->delete();

            return redirect()->back()
                ->withSuccess('Video unwatched');
        }

        abort(404);
    }

    /**
     * Show all users.
     *
     * @return mixed
     */
    public function users()
    {
        return view('orientation-route::users')
            ->withInfo(['title' => 'Users'])
            ->withUsers($this->user->with('watchedVideo')->get());
    }

    /**
     * View a user.
     *
     * @param User $user
     * @return mixed
     */
    public function viewUser(User $user)
    {
        return view('orientation-route::user-view')
            ->withInfo(['title' => $user->first()])
            ->withUser($user->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::all(),
        ];
        return view('orientation-route::create', $data)->withInfo(['title' => 'Add a video | Dashboard']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Validate input
        $this->validate($this->request, [
            'title' => 'required',
            'description' => 'required',
            'order_number' => 'required|integer|unique:videos',
            'embed_code' => 'required',
            'role_id'   => 'required',
        ]);

        $this->video->create([
            'title' => $this->request->input('title'),
            'description' => $this->request->input('description'),
            'order_number' => $this->request->input('order_number'),
            'embed_code' => $this->request->input('embed_code'),
            'slug' => str_slug($this->request->input('title'), '-'),
            'role_id' => $this->request->input('role_id')
        ]);

        return redirect('videos/all')->withSuccess('Video added');
    }

    /**
     * Edit a video.
     *
     * @param Video $video
     * @return mixed
     */
    public function edit(Video $video)
    {
        if ($video->count() > 0) {
            $data = [
                'roles' => Role::all(),
            ];
            return view('orientation-route::edit', $data)
                ->withVideo($video);
        }

        abort(404);
    }

    /**
     * Update a video.
     *
     * @param Video $video
     * @return mixed
     */
    public function update(Video $video)
    {
        // Validate input
        $this->validate($this->request, [
            'title' => 'required',
            'description' => 'required',
            'order_number' => 'required|integer|unique:videos,order_number,' . $video->id . ',id',
            'embed_code' => 'required',
            'role_id' => 'required',
        ]);

        $video->title = $this->request->input('title');
        $video->description = $this->request->input('description');
        $video->order_number = $this->request->input('order_number');
        $video->embed_code = $this->request->input('embed_code');
        $video->slug = str_slug($this->request->input('title'), '-');
        $video->role_id = $this->request->input('role_id');
        $video->save();

        return redirect('videos/all')->withSuccess('Video updated');
    }

    /**
     * Update order of a video.
     *
     * @return mixed
     */
    public function updateOrder()
    {
        // Validate input
        $rules = [];
        $messages = [];
        $ids = $this->request->input('id');
        $order_numbers = $this->request->input('order_number');

        if (count($order_numbers) !== count(array_unique($order_numbers))) {
            $messages = new MessageBag();
            $messages->add('order_number', 'Order numbers are not unqiue');

            return redirect('videos/all-videos')->withErrors($messages);
        }

        foreach ($ids as $key => $id) {
            $rules['id.' . $key] = 'required|integer|min:1';
            $messages['id.' . $key . '.required'] = 'Invalid request';
            $messages['id.' . $key . '.integer'] = 'Invalid request';
            $messages['id.' . $key . '.min'] = 'Invalid request';
        }

        foreach ($order_numbers as $key => $order_number) {
            $rules['order_number.' . $key] = 'required|integer|min:1';
            $messages['order_number.' . $key . '.required'] = 'Order number is required';
            $messages['order_number.' . $key . '.integer'] = 'Invalid order number';
            $messages['order_number.' . $key . '.min'] = 'Invalid order number';
        }

        $this->validate($this->request, $rules, $messages);

        // Update order number.
        foreach ($ids as $key => $id) {
            $video = $this->video->find($id);

            if ($video) {
                $video->order_number = $order_numbers[$key];
                $video->save();
            } else {
                abort(404, 'Video not found ' . $id);
            }
        }

        return redirect('videos/all-videos')->withSuccess('Video updated');
    }

    /**
     * Delete a video.
     *
     * @param Video $video
     * @return mixed
     */
    public function delete(Video $video)
    {
        $video->delete();

        return redirect('videos/all')->withSuccess('Video removed');
    }
}
