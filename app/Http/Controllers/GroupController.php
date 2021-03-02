<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GroupController extends Controller
{
    /**
     * Dashboard with groups
     */
    public function index()
    {
        $user = Auth::user();

        return Inertia::render('Groups/Index', [
            'groups' => $user->groups()->with(['users', 'user'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Groups/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $user = Auth::user();
        $group = new Group;
        $group->name = $request->name;
        $group->user_id = Auth::id();
        $group->uuid = Str::uuid();
        $group->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Inertia\Response
     */
    public function show(Group $group)
    {
        return Inertia::render('Groups/Show', [
            'group' => $group,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Inertia\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
