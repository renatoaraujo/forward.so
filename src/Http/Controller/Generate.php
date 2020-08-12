<?php
declare(strict_types=1);

namespace ForwardSo\Http\Controller;

use ForwardSo\Domain\Command\GenerateUrl;
use ForwardSo\Domain\ServiceBus\EventBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;

final class Generate
{
    private SerializerInterface $serializer;
    private EventBus $eventBus;

    public function __construct(SerializerInterface $serializer, EventBus $eventBus)
    {
        $this->serializer = $serializer;
        $this->eventBus = $eventBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $body = \json_decode($content);

        if (empty($body->url)) {
            throw new BadRequestHttpException("Missing URL on body.");
        }

        $command = new GenerateUrl($body->url);
        $url = $this->eventBus->handle($command);

        return new JsonResponse(
            $this->serializer->serialize($url, 'json'),
            JsonResponse::HTTP_CREATED,
            [],
            true
        );
    }
}