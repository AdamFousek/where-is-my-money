<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{

    /**
     * @var GroupService
     */
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Dashboard with groups
     *
     * @return Response
     */
    public function index(): Response
    {
        $groups = $this->groupService->getAllMyGroups();

        return Inertia::render('Groups/Index', [
            'groups' => GroupResource::collection($groups),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Groups/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->only([
            'name',
            'description',
        ]);

        $group = $this->groupService->createGroup($data);
        return redirect()->route('group.show', $group);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function show(Group $group): Response
    {
        $users = $group->users;
        if (!$users->contains(Auth::id())) {
            abort(404);
        }

        return Inertia::render('Groups/Show', [
            'group' => new GroupResource($group->load(['payments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }, 'categories'])),
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function edit(Group $group): Response
    {
        return Inertia::render('Groups/Edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Group $group): RedirectResponse
    {
        if ($group->trashed()) {
            $group->forceDelete();
        } else {
            try {
                $group->delete();
            } catch (\Exception $e) {
                // @todo create messages
            }
        }

        return back();
    }

    /**
     * Toggle group as favorite
     *
     * @param Group $group
     * @return RedirectResponse
     */
    public function toggleFavorite(Group $group): RedirectResponse
    {
        $this->groupService->toggleFavorite($group);

        return back();
    }
}
