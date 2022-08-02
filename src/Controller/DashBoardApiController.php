<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DashBoardBundle\Controller;

use Evrinoma\DashBoardBundle\Manager\DashBoardManager;
use Evrinoma\UtilsBundle\Controller\AbstractApiController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class LiveVideoApiController.
 */
final class DashBoardApiController extends AbstractApiController
{
    /**
     * @var ?Request
     */
    private ?Request $request;

    /**
     * @var DashBoardManager
     */
    private DashBoardManager $dashBoardManager;

    /**
     * ApiController constructor.
     *
     * @param SerializerInterface $serializer
     * @param RequestStack        $requestStack
     */
    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, DashBoardManager $dashBoardManager)
    {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->dashBoardManager = $dashBoardManager;
    }

    /**
     * @Rest\Get("/api/dashboard/status", options={"expose": true}, name="api_dashboard_status")
     * @OA\Get(tags={"system"})
     * @OA\Response(response=200, description="Returns system status")
     *
     * @param DashBoardManager $dashBoardManager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function systemStatusAction()
    {
        return $this->json(['system' => $this->dashBoardManager->getDashBoard()]);
    }
}
