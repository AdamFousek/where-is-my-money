<?php


namespace App\Services;


use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\Validator;


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
     */
    public function createGroup(array $data): Group
    {
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
        ])->validateWithBag('createGroup');
        $t->test();
        return $this->groupRepository->save($data);
    }
}
