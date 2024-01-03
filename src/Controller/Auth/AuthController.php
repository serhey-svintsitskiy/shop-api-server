<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Attribute\OpenApi as AOA;
use App\Entity\User;
use App\Model\Auth\ChangePasswordRequest;
use App\Model\Auth\SignUpRequest;
use App\Service\Auth\ChangePasswordService;
use App\Service\Auth\SignUpService;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/api/auth')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly SignUpService $signUpService,
        private readonly AuthenticationSuccessHandler $successHandler,
        private readonly ChangePasswordService $passwordService,
    ) {
    }

    #[Route(path: '/signup', methods: [Request::METHOD_POST], format: 'json')]
    #[AOA\RequestBody(type: SignUpRequest::class)]
    public function signUp(
        #[MapRequestPayload]
        SignUpRequest $signUpRequest
    ): Response {
        $user = $this->signUpService->signUp($signUpRequest);

        return $this->successHandler->handleAuthenticationSuccess($user);
    }

    #[Route(path: '/change-password', methods: [Request::METHOD_PATCH], format: 'json')]
    #[isGranted('ROLE_USER')]
    public function changePassword(
        #[MapRequestPayload]
        ChangePasswordRequest $request,
        #[CurrentUser]
        User $user,
    ): Response {
        $user = $this->passwordService->changePassword($user, $request);

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}
