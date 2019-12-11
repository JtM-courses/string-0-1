<?php

/**
 * Class LockClass
 */
class LockClass
{
    /**
     * @param $message
     * @param $key
     * @return bool
     */
    private function validate ($message, $key): bool
    {
        return is_string($message) && (ctype_digit($key) || is_int($key));
    }

    /**
     * @param string $start
     * @param string $end
     * @return string
     */
    private function generateDictionary(string $start, string $end): string
    {
        $res = [];
        for ($i = ord($start); $i <= ord($end); ++$i) {
            $res[] = chr($i);
        }

        return implode('', $res);
    }

    /**
     * @param string $message
     * @param int $key
     * @return string
     */
    private function proccess(string $message, int $key): string
    {
        $dictionary = $this->generateDictionary('a', 'z') . $this->generateDictionary('A', 'Z') . ' .,';
        $messageArray = str_split($message);
        $output = '';

        foreach ($messageArray as $char) {
            $charId = strpos($dictionary, $char);
            $newCharId = $charId + $key;
            while ($newCharId > strlen($dictionary)) {
                $newCharId -= strlen($dictionary) + 1;
            }
            $output .= $dictionary[$newCharId];
        }

        return $output;
    }

    /**
     * @param $message
     * @param $key
     * @return string
     * @throws Exception
     */
    public function lock($message, $key): string
    {
        if (!$this->validate($message, $key)) {
            throw new Exception('Error format', 400);
        }

        return $this->proccess($message, $key);
    }

    /**
     * @param $message
     * @param $key
     * @return string
     * @throws Exception
     */
    public function unlock($message, $key): string
    {
        return $this->lock($message, -$key);
    }
}
