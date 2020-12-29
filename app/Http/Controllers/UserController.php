<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSendTransaction;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return UsersResource
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getAll();
            $resource = new UsersResource($users);
        } catch (Exception $exception) {
            $resource = new ErrorResource($exception);
        }
        return $resource;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return UserResource
     */
    public function show(Request $request)
    {
        $userId = $request->id;
        try {
            $user = $this->userRepository->getById($userId);
            $resource = new UserResource($user);
        } catch (Exception $exception) {
            $resource = new ErrorResource($exception);
        }
        return $resource;
    }

    public function transactions(Request $request)
    {
        $userId = $request->id;
        $with = ['wallet.sourceTransactions.sourceWallet.user'];
        try {
            $user = $this->userRepository->getById($userId, $with);
            $resource = new UserResource($user);
        } catch (Exception $exception) {
            $resource = new ErrorResource($exception);
        }
        return $resource;
    }

    public function sendTransaction(UserSendTransaction $request, TransactionService $transactionService)
    {
        $sourceUserId = $request->id;
        $destinationUserId = $request->get('destination_user_id');
        $amount = $request->get('amount');
        try {
            $sourceUser = $this->userRepository->getById($sourceUserId);
            $destinationUser = $this->userRepository->getById($destinationUserId);
            $transaction = $transactionService->executeTransaction($sourceUser->wallet, $destinationUser->wallet, $amount);
            $resource = new TransactionResource($transaction);
        } catch (Exception $exception) {
            $resource = new ErrorResource($exception);
        }
        return $resource;
    }

}
