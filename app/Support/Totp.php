<?php

namespace App\Support;

final class Totp
{
    private const BASE32 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    public static function secret(int $bytes = 20): string
    {
        return self::base32Encode(random_bytes($bytes));
    }

    public static function verify(string $secret, string $code, ?int $timestamp = null): bool
    {
        if (! preg_match('/^\d{6}$/', $code)) {
            return false;
        }

        $key = self::base32Decode($secret);
        if ($key === '') {
            return false;
        }

        $counter = intdiv($timestamp ?? time(), 30);
        for ($offset = -1; $offset <= 1; $offset++) {
            $value = $counter + $offset;
            if ($value < 0) {
                continue;
            }

            $binaryCounter = pack('N2', intdiv($value, 4_294_967_296), $value % 4_294_967_296);
            $hash = hash_hmac('sha1', $binaryCounter, $key, true);
            $position = ord($hash[19]) & 0x0f;
            $number = ((ord($hash[$position]) & 0x7f) << 24)
                | ((ord($hash[$position + 1]) & 0xff) << 16)
                | ((ord($hash[$position + 2]) & 0xff) << 8)
                | (ord($hash[$position + 3]) & 0xff);

            if (hash_equals(str_pad((string) ($number % 1_000_000), 6, '0', STR_PAD_LEFT), $code)) {
                return true;
            }
        }

        return false;
    }

    public static function provisioningUri(string $email, string $secret): string
    {
        $label = rawurlencode('Any2Convert:'.$email);
        $query = http_build_query([
            'secret' => $secret,
            'issuer' => 'Any2Convert',
            'algorithm' => 'SHA1',
            'digits' => 6,
            'period' => 30,
        ]);

        return "otpauth://totp/{$label}?{$query}";
    }

    private static function base32Encode(string $input): string
    {
        $output = '';
        $buffer = 0;
        $bits = 0;

        foreach (unpack('C*', $input) ?: [] as $byte) {
            $buffer = ($buffer << 8) | $byte;
            $bits += 8;
            while ($bits >= 5) {
                $bits -= 5;
                $output .= self::BASE32[($buffer >> $bits) & 31];
            }
            $buffer &= (1 << $bits) - 1;
        }

        if ($bits > 0) {
            $output .= self::BASE32[($buffer << (5 - $bits)) & 31];
        }

        return $output;
    }

    private static function base32Decode(string $input): string
    {
        $input = strtoupper(rtrim($input, '='));
        $output = '';
        $buffer = 0;
        $bits = 0;

        foreach (str_split($input) as $character) {
            $value = strpos(self::BASE32, $character);
            if ($value === false) {
                return '';
            }

            $buffer = ($buffer << 5) | $value;
            $bits += 5;
            if ($bits >= 8) {
                $bits -= 8;
                $output .= chr(($buffer >> $bits) & 0xff);
                $buffer &= (1 << $bits) - 1;
            }
        }

        return $output;
    }
}
