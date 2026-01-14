<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Response;
use Cake\I18n\I18n;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Language middleware to set locale from `lang` route param.
 */
class LanguageMiddleware implements MiddlewareInterface
{
    private string $default;
    /** @var array<int, string> */
    private array $supported;

    /**
     * @param array{default?: string, supported?: array<string>} $options
     */
    public function __construct(array $options = [])
    {
        $default = (string)($options['default'] ?? 'en');
        $supported = $options['supported'] ?? [$default];
        $supported = is_array($supported) ? $supported : [$default];

        $this->default = strtolower($default);
        $normalized = array_map('strtolower', $supported);
        $this->supported = array_values(array_unique($normalized));
        if (!in_array($this->default, $this->supported, true)) {
            $this->supported[] = $this->default;
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $lang = $request->getParam('lang');
        $lang = is_string($lang) ? strtolower($lang) : $this->default;

        if (!in_array($lang, $this->supported, true)) {
            return $this->redirectToDefault($request);
        }

        I18n::setLocale($lang);

        return $handler->handle($request);
    }

    private function redirectToDefault(ServerRequestInterface $request): ResponseInterface
    {
        $path = trim($request->getUri()->getPath(), '/');
        $segments = $path === '' ? [] : explode('/', $path);
        if ($segments === []) {
            $segments = [$this->default];
        } else {
            if ($this->isLanguageSegment($segments[0])) {
                $segments[0] = $this->default;
            } else {
                array_unshift($segments, $this->default);
            }
        }

        $redirectPath = '/' . implode('/', $segments);
        $query = $request->getUri()->getQuery();
        if ($query !== '') {
            $redirectPath .= '?' . $query;
        }

        return (new Response())
            ->withLocation($redirectPath)
            ->withStatus(302);
    }

    private function isLanguageSegment(string $segment): bool
    {
        return preg_match('/^[a-z]{2}$/i', $segment) === 1;
    }
}
