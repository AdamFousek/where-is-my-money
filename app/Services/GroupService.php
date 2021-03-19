<?php


namespace App\Services;


use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class GroupService
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * GroupService constructor.
     * @param GroupRepository $groupRepository
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

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

        $group = $this->groupRepository->create($data);
        $group->users()->attach(Auth::id());

        return $group;
    }

    public function getAllMyGroups()
    {
        return $this->groupRepository->getAllMyGroups();
    }

    public function toggleFavorite(Group $group): void
    {
        $user = $group->users()->where('id', Auth::id())->first();
        $favorite = !$user->pivot->is_favorite;
        $this->groupRepository->toggleFavorite($group, $favorite);
    }
}
