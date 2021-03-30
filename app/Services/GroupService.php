<?php


namespace App\Services;


use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class GroupService
{
    /**
     * @param array $data
     * @return Group
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createGroup(array $data): Group
    {
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
        ])->validateWithBag('createGroup');

        $data['uuid'] = Str::uuid();
        $data['user_id'] = Auth::id();

        $group = Group::create($data);
        $group->users()->attach(Auth::id());

        return $group;
    }

    /**
     * Get all my groups
     * @return mixed
     */
    public function getAllMyGroups()
    {
        $user = Auth::user();
        return $user->groups()
            ->withCount(['users', 'payments'])
            ->orderBy('is_favorite', 'desc')
            ->get();
    }

    /**
     * Toggle favorite group
     * @param Group $group
     */
    public function toggleFavorite(Group $group): void
    {
        $user = $group->users()->where('id', Auth::id())->first();
        $favorite = !$user->pivot->is_favorite;

        $group->users()->updateExistingPivot(Auth::id(), [
            "is_favorite" => $favorite
        ]);
    }
}
