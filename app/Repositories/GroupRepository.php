<?php


namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupRepository
{

    /**
     * @var Group
     */
    protected $group;

    /**
     * GroupRepository constructor.
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @param array $data
     * @return Group
     */
    public function save(array $data): Group
    {
        $group = new $this->group;

        $group->fill([
            'name' => $data['name'],
            'description' => $data['description'] ?? '',
            'user_id' => Auth::id(),
            'uuid' => Str::uuid(),
        ])->save();

        $group->users()->attach(Auth::id());

        return $group;
    }
}
