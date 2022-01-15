<?php

/**
 * Slim Twig Flash.
 *
 * @link https://github.com/k-ko/slim-twig-flash for the canonical source repository
 *
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos <contact@kanellov.com>
 * @copyright Copyright (c) 2021 Knut Kohl <github@knutkohl.de>
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Twig\Extension;

use Slim\Flash\Messages;
use Twig\TwigFunction;

class SlimFlashMessages extends AbstractExtension
{
    /**
     * @var Messages
     */
    protected $messages;

    /**
     * Constructor.
     *
     * @param Messages $messages the Flash messages service provider
     */
    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Extension name.
     */
    public function getName(): string
    {
        return 'slim-twig-flash';
    }

    /**
     * Callback for twig.
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('flash', [$this, 'getMessages']),
        ];
    }

    /**
     * Returns Flash messages; If key is provided then returns messages
     * for that key.
     */
    public function getMessages(string $key = null): ?array
    {
        if (null !== $key) {
            return $this->messages->getMessage($key);
        }

        return $this->messages->getMessages();
    }
}
