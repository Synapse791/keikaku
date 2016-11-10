<?php

namespace Keikaku\Contracts\Services;

interface ServiceErrors
{
    function getError(): string;

    function getErrorDescription(): string;

    function getErrorCode(): int;
}