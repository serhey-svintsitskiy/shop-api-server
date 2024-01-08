<?php

declare(strict_types=1);

namespace App\Controller\Admin\User;

use App\Attribute\ArgumentResolver\MapQueryString;
use App\Attribute\OpenApi as AOA;
use App\Entity\User;
use App\Model\Admin\User\UserListRequest;
use App\Model\Admin\User\UserListResponse;
use App\Model\Admin\User\UserModel;
use App\Repository\Common\UserRepository;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/users')]
#[OA\Tag(name: 'users')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    #[Route(path: '', methods: [Request::METHOD_GET], format: 'json')]
    #[AOA\QueryPageParameter]
    #[AOA\ResponseOk(type: UserListResponse::class)]
    public function getList(
        #[MapQueryString]
        UserListRequest $request,
    ): Response {
        return $this->json(
            new UserListResponse(
                array_map(
                    fn (User $user) => UserModel::fromEntity($user),
                    $this->userRepository->findAll()
                )
            )
        );
    }

    #[Route(path: '/{id}', methods: [Request::METHOD_GET])]
    #[AOA\ResponseOk(type: UserModel::class)]
    public function getItem(
        #[MapEntity]
        User $user,
    ): Response {
        return $this->json(UserModel::fromEntity($user));
    }
}
