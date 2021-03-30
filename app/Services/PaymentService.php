<?php


namespace App\Services;


use App\Models\Payment;
use Illuminate\Support\Arr;

class PaymentService
{
    /**
     * Return payments by filter
     * @param $group
     * @param $filter
     * @return mixed
     */
    public function getFilteredPayments($group, $filter)
    {
        $payments = Payment::where('group_id', $group->id);

        if (Arr::has($filter, 'categories')) {
            $payments = $payments->whereIn('category_id', Arr::get($filter, 'categories'));
        }

        if (Arr::has($filter, 'users')) {
            $payments = $payments->whereIn('user_id', explode(',', Arr::get($filter, 'users')));
        }

        if (Arr::has($filter, 'order')) {
            $payments = $payments->orderBy(
                Arr::get($filter, 'order'),
                Arr::get($filter, 'orderdir', 'asc')
            );
        }

        return $payments->paginate(15);
    }
}
