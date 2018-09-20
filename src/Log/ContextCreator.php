<?php
declare(strict_types=1);

namespace Learn\Log;


class ContextCreator
{
    /**
     * @param \Learn\Http\Message\Request\RequestInterface $request
     * @param \Throwable                                   $exception
     * @return array
     */
    static function createContext($request, $exception): array
    {
        $context['id']     = $request->getRemoteAddress();
        $context['method'] = $request->getMethod();
        $context['url']    = $request->getUrl();
        $context['code']   = $exception->getCode();
        $context['file']   = $exception->getFile();
        $context['line']   = $exception->getLine();

        return $context;
    }
}