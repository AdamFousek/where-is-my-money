<?php


namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupRepository extends BaseRepository
{

    /**
     * GroupRepository constructor.
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        parent::__construct($group);
    }

    /**
     * @return mixed
     */
    public function getAllMyGroups()
    {
        $user = Auth::user();
        return $user->groups()
            ->with([
                'payments' => function ($query) {
                    $query->with('user');
                }
            ])
            ->withCount(['users'])
            ->orderBy('is_favorite', 'desc')
            ->get();
    }

    /**
     * @param Group $group
     * @param Boolean $favorite
     */
    public function toggleFavorite(Group $group, bool $favorite): void
    {
        $group->users()->updateExistingPivot(Auth::id(), [
            "is_favorite" => $favorite
        ]);
    }
}
