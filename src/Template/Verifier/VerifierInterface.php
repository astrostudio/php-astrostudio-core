<?php
namespace AstroStudio\Core\Template\Verifier;

/**
 * @template T
 */
interface VerifierInterface
{
    /**
     * @param T       $value
     * @param mixed[] $options
     *
     * @return T|null
     */
    function verify(mixed $value, array $options = []): mixed;
}
