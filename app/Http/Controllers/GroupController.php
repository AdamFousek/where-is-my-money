<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
     */
    public function index()
    {
        $groups = $this->groupService->getAllMyGroups();

        return Inertia::render('Groups/Index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
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
    public function store(Request $request)
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
    public function show(Group $group)
    {
        $user = $group->users()->where('id', Auth::id())->first();

        if (is_null($user)) {
            abort(404);
        }

        return Inertia::render('Groups/Show', [
            'group' => $group,
            'isFavorite' => $user->pivot->is_favorite,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function edit(Group $group)
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
    public function destroy(Group $group)
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
    public function toggleFavorite(Group $group)
    {
        $user = $group->users()->where('id', Auth::id())->first();
        $group->users()->updateExistingPivot(Auth::id(), [
            "is_favorite" => !$user->pivot->is_favorite
        ]);

        return back();
    }
}
