<?php
declare(strict_types=1);

namespace ForwardSo\Http\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class Generate
{
    public function __invoke(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $body = \json_decode($content);

        if (empty($body->url)) {
            throw new BadRequestHttpException("Missing URL on body.");
        }

        return new JsonResponse($body->url, JsonResponse::HTTP_CREATED);
    }
}