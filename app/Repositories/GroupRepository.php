<?php


namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupRepository implements RepositoryInterface
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

    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param array $data
     * @return Group
     */
    public function create(array $data): Group
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

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function show($id)
    {
        return $this->group->find($id);
    }

    /**
     * @return mixed
     */
    public function getAllMyGroups()
    {
        $user = Auth::user();
        return $user->groups()
            ->with([
                'createdUser',
                'payments' => function ($query) {
                    $query->with('user')->latest();
                }
            ])
            ->withCount(['users'])
            ->orderBy('is_favorite', 'desc')
            ->get();
    }
}
