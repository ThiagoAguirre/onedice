<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class LanguageHelper extends Helper
{
    protected array $helpers = ['Url'];

    private string $defaultLocale;
    /** @var array<int, string> */
    private array $supportedLocales;

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $defaultLocale = (string)Configure::read('I18n.defaultLocale', 'en');
        $supportedLocales = Configure::read('I18n.languages', [$defaultLocale]);
        $supportedLocales = is_array($supportedLocales) ? $supportedLocales : [$defaultLocale];

        $this->defaultLocale = strtolower($defaultLocale);
        $normalized = array_map('strtolower', $supportedLocales);
        $this->supportedLocales = array_values(array_unique($normalized));
        if (!in_array($this->defaultLocale, $this->supportedLocales, true)) {
            $this->supportedLocales[] = $this->defaultLocale;
        }
    }

    /**
     * Build URLs while preserving the current language prefix.
     *
     * @param array|string $url URL array or string.
     * @param string|null $lang Language to force, null uses current language.
     * @param bool $full Whether to build a full URL.
     * @return string
     */
    public function url(array|string $url, ?string $lang = null, bool $full = false): string
    {
        $lang = $lang ?? $this->currentLanguage();
        $options = ['fullBase' => $full];

        if (is_array($url)) {
            $url['lang'] = $url['lang'] ?? $lang;

            return $this->Url->build($url, $options);
        }

        if ($url === '' || $url[0] !== '/') {
            return $this->Url->build($url, $options);
        }

        if ($this->hasLanguagePrefix($url)) {
            return $this->Url->build($url, $options);
        }

        return $this->Url->build('/' . $lang . $url, $options);
    }

    private function currentLanguage(): string
    {
        $lang = $this->getView()->getRequest()->getParam('lang');
        $lang = is_string($lang) ? strtolower($lang) : null;

        if (is_string($lang) && in_array($lang, $this->supportedLocales, true)) {
            return $lang;
        }

        return $this->defaultLocale;
    }

    private function hasLanguagePrefix(string $path): bool
    {
        $escaped = array_map(
            static fn (string $value): string => preg_quote($value, '#'),
            $this->supportedLocales
        );
        $pattern = '#^/(' . implode('|', $escaped) . ')(/|$)#i';

        return preg_match($pattern, $path) === 1;
    }
}
