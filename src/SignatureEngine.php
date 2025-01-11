<?php

namespace Meklad\Signature;

use Illuminate\Support\Facades\Crypt;

/**
 * This engine class handels the generate of signature and vaidation.
 * 
 * @author Ahmed <ahmed.meklad.news@email.com>
 */
class SignatureEngine
{
    /**
     * Generate the signature.
     *
     * @param string $appKey
     * @param string $appSecret
     * @param int|string|null $timestamp
     * @return string
     */
    public function generate(
        string $appKey,
        string $appSecret,
        int|string|null $timestamp = null)
    : string {
        if(!$timestamp) {
            $timestamp = time();
        }

        return $timestamp . '.' . base64_encode($appKey . ':' . $appSecret);
    }

    /**
     * Validate the signature.
     *
     * @param string $signature
     * @param string $appKey
     * @param string $appSecret
     * @param int|string|null $timestamp
     * @return bool
     */
    public function validate(
        string $signature,
        string $appKey,
        string $appSecret,
        int|string|null $timestamp)
    : bool {
        return hash_equals(
            $this->generate(
                $appKey,
                $appSecret,
                $timestamp
            ),
            $signature
        );
    }
}
