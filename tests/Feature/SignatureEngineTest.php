<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Meklad\Signature\SignatureEngine;

class SignatureEngineTest extends TestCase
{
    private $signatureEngine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signatureEngine = new SignatureEngine();
    }

    public function testGenerateSignature()
    {
        $timestamp = '1234567890';
        $appKey = 'your-app-key';
        $appSecret = 'your-app-secret';

        $signature = $this->signatureEngine->generate($appKey, $appSecret, $timestamp);

        $expectedSignature = $timestamp . '.' . base64_encode($appKey . ':' . $appSecret);
        $this->assertEquals($expectedSignature, $signature);
    }

    public function testValidateSignature()
    {
        $timestamp = '1234567890';
        $appKey = 'your-app-key';
        $appSecret = 'your-app-secret';

        $signature = $this->signatureEngine->generate($appKey, $appSecret, $timestamp);

        $isValid = $this->signatureEngine->validate($signature, $appKey, $appSecret, $timestamp);

        $this->assertTrue($isValid);
    }

    public function testValidateInvalidSignature()
    {
        $timestamp = '1234567890';
        $appKey = 'your-app-key';
        $appSecret = 'your-app-secret';

        $signature = 'invalid.signature';

        $isValid = $this->signatureEngine->validate($signature, $timestamp, $appKey, $appSecret);

        $this->assertFalse($isValid);
    }
}
