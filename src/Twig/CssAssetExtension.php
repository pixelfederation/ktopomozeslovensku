<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Twig;

use App\Service\CssManifestReader;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 *
 */
final class CssAssetExtension extends AbstractExtension
{
    /**
     * @var CssManifestReader
     */
    private $manifestReader;

    /**
     * @param CssManifestReader $manifestReader
     */
    public function __construct(CssManifestReader $manifestReader)
    {
        $this->manifestReader = $manifestReader;
    }

    /**
     *
     * @return array|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('css_asset', [$this, 'cssAsset'])
        ];
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    public function cssAsset(string $fileName): string
    {
        return $this->manifestReader->getCssFile($fileName);
    }
}
