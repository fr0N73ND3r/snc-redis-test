<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    private \Redis $redis;

    public function __construct(
        \Redis $redis
    ) {
        $this->redis = $redis;
    }

    /**
     * @Route("/main", name="main")
     */
    public function __invoke(): Response
    {
        $this->redis->incr('counter');

        return new Response($this->redis->get('counter'));
    }
}
