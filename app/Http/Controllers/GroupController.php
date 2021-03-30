<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Http\Resources\PaymentCategoryResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\Payment;
use App\Services\GroupService;
use App\Services\PaymentService;
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

    /**
     * @var PaymentService
     */
    protected $paymentService;

    /**
     * GroupController constructor.
     * @param GroupService $groupService
     * @param PaymentService $paymentService
     */
    public function __construct(
        GroupService $groupService,
        PaymentService $paymentService
    ) {
        $this->groupService = $groupService;
        $this->paymentService = $paymentService;
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
     * @param Request $request
     * @return Response
     */
    public function show(Group $group, Request $request): Response
    {
        $users = $group->users;
        if (!$users->contains(Auth::id())) {
            abort(404);
        }

        $filter = $request->only([
            'categories',
            'users',
            'order',
            'orderdir',
        ]);

        $data = [
            'group' => new GroupResource($group),
            'payments' => PaymentResource::collection($this->paymentService->getFilteredPayments($group, $filter)),
            'users' => $users,
            'categories' => PaymentCategoryResource::collection($group->categories),
            'filter' => $filter,
        ];

        return Inertia::render('Groups/Show', $data);
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
