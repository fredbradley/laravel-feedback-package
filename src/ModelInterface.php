<?php

namespace FredBradley\Feedback;

interface ModelInterface
{
    /**
     * @param  string|null  $connection
     */
    public function setConnection(?string $connection): void;
}
