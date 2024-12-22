<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuperadminStudentResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use InvalidArgumentException;

class SuperadminStudentController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function getStudents(Request $request)
    {
        $isSearch = $request->has('search');

        $query = User::query()
            ->whereHas('roles', function ($q) {

                $q->where('name', 'student');
            });

        $query->when($isSearch && $request->input('search') !== null, function ($q) use ($request) {

            return $q->where('email', 'like', '%'.$request->input('search').'%');
        });

        $query->when(!$isSearch && $request->input('from_date') !== null, function ($q) use ($request) {

            return $q->whereBetween('created_at', [$request->input('from_date'), $request->input('to_date') ?? Carbon::now()->toDateString()]);
        });

        $students = $query->orderBy('created_at', 'desc')->paginate(20);

        return SuperadminStudentResource::collection($students);
    }

    /**
     * @param User $user
     * @return Response
     * @throws BindingResolutionException
     */
    public function deleteUser(User $user)
    {
        DB::transaction(function () use ($user) {

            if($user->isFilled) {
                $user->student()->logs();
                $user->student()->delete();
            }

            $user->delete();
        });

        return response()->noContent();
    }
}
