<?php
declare(strict_types=1);

namespace Maymeow\BaseIntEncoder;

/**
 * based on something I found on forum long time ago.
 */
class BaseIntEncoder
{
    protected string $codeSet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    /**
     * @param int $n
     * @return string
     */
    public function encode(int $n) : string
    {
        $base = (string)strlen($this->codeSet);
        $converted = '';

        while ($n > 0) {
            $offset = bcmod((string)$n, $base);
            $converted = substr($this->codeSet, (int)$offset, 1) . $converted;

            $x = bcdiv((string)$n, $base);
            $n = $this->bcFloor((int)$x);
        }

        return $converted;
    }

    /**
     * @param string $code
     * @return string
     */
    public function decode(string $code) : string
    {
        $base = (string)strlen($this->codeSet);
        $c = '0';
        for ($i = strlen($code); $i; $i--) {
            $c = bcadd(
                $c,
                bcmul(
                    (string)strpos(
                        $this->codeSet,
                        substr(
                            $code,
                            (-1 * ($i - strlen($code))),
                            1
                        )
                    ),
                    bcpow($base, (string)$exponent = $i-1)
                )
            );
        }

        return bcmul((string)$c, '1', 0);
    }

    /**
     * @param int $x
     * @return int
     */
    protected function bcFloor(int $x) : int
    {
        return (int)bcmul((string)$x, '1', 0);
    }
}
