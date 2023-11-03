<?php
declare(strict_types=1);

namespace POPP\Registry;

class ApplicationHelper
{
    /**
     * @throws AppException
     */
    public function getOptions(): array
    {
        $optionFile = __DIR__ . "/data/woo_options.xml";

        if (! file_exists($optionFile)) {
            throw new AppException('Could not find options file');
        }

        $options = simplexml_load_file($optionFile);
        $dsn = (string) $options->dsn;

        return [$dsn];
    }
}