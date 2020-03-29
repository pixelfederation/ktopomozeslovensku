<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use RuntimeException;

/**
 *
 */
final class CssManifestReader
{
    /**
     * @var string
     */
    private $manifestFile;

    /**
     * @param string $manifestFile
     */
    public function __construct(string $manifestFile)
    {
        $this->manifestFile = $manifestFile;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function getCssFile(string $filename): string
    {
        if (!file_exists($this->manifestFile)) {
            throw new RuntimeException(
                sprintf(
                    'Unable to find manifest.json file in directory %s, please run `yarn run styles-build` first!', $this->manifestFile
                )
            );
        }

        /** @var array $content */
        $content = json_decode(file_get_contents($this->manifestFile), true);

        // Given file is not in hash map, then return input name
        if (!array_key_exists($filename, $content)) {
            return $filename;
        }

        return $content[$filename];
    }
}
