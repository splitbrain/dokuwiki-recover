<?php


class Check
{
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const FAILURE = 'failure';

    const LEARNMORE = 'https://www.dokuwiki.org/requirements:';

    /**
     * Runs all checks
     *
     * When a formatter callback is given, that callback is executed for each
     * check's result. You can use this class' echoAs* methods for this.
     *
     * The return contains the counts of failures, warnings and successes
     *
     * @param null|callable $formatter
     * @return array
     */
    public function runAllChecks($formatter = null)
    {
        $counts = array(
            self::SUCCESS => 0,
            self::WARNING => 0,
            self::FAILURE => 0,
        );

        $checks = $this->getAllChecks();
        foreach ($checks as $entry) {
            $func = array_shift($entry);
            $result = call_user_func_array(array($this, $func), $entry);
            if ($result === null) continue;
            $counts[$result['success']]++;
            if (is_callable($formatter)) $formatter($result);
        }

        return $counts;
    }

    /**
     * Returns a list of all checks that should be executed
     *
     * @return array[] Each entry is the method name followed by the needed parameters
     */
    public function getAllChecks()
    {
        return array(
            array('checkPhpVersion', '5.6.0'),
            array('checkMbStringExtension'),
            array('checkSSL'),
            array('checkPregUtf8'),
            array('checkPregUnicode'),
            array('checkLocale'),

            array('checkFunctionAvailability', 'addslashes'),
            array('checkFunctionAvailability', 'chmod'),
            array('checkFunctionAvailability', 'copy'),
            array('checkFunctionAvailability', 'fgets'),
            array('checkFunctionAvailability', 'file'),
            array('checkFunctionAvailability', 'file_exists'),
            array('checkFunctionAvailability', 'file_get_contents'),
            array('checkFunctionAvailability', 'filesize'),
            array('checkFunctionAvailability', 'flush'),
            array('checkFunctionAvailability', 'fopen'),
            array('checkFunctionAvailability', 'fseek'),
            array('checkFunctionAvailability', 'fsockopen'),
            array('checkFunctionAvailability', 'ftell'),
            array('checkFunctionAvailability', 'glob'),
            array('checkFunctionAvailability', 'header'),
            array('checkFunctionAvailability', 'htmlspecialchars_decode'),
            array('checkFunctionAvailability', 'ignore_user_abort'),
            array('checkFunctionAvailability', 'ini_get'),
            array('checkFunctionAvailability', 'json_encode'),
            array('checkFunctionAvailability', 'mail'),
            array('checkFunctionAvailability', 'mkdir'),
            array('checkFunctionAvailability', 'ob_start'),
            array('checkFunctionAvailability', 'opendir'),
            array('checkFunctionAvailability', 'pack'),
            array('checkFunctionAvailability', 'parse_ini_file'),
            array('checkFunctionAvailability', 'preg_replace'),
            array('checkFunctionAvailability', 'readfile'),
            array('checkFunctionAvailability', 'realpath'),
            array('checkFunctionAvailability', 'rename'),
            array('checkFunctionAvailability', 'rmdir'),
            array('checkFunctionAvailability', 'serialize'),
            array('checkFunctionAvailability', 'session_start'),
            array('checkFunctionAvailability', 'spl_autoload_register'),
            array('checkFunctionAvailability', 'stream_select'),
            array('checkFunctionAvailability', 'unlink'),
            array('checkFunctionAvailability', 'usleep'),

            array('checkFunctionAvailability', 'utf8_encode', false),
            array('checkFunctionAvailability', 'utf8_decode', false),
            array('checkFunctionAvailability', 'imagecreatetruecolor', false),

            array('checkIniOff', 'open_basedir', false),
            array('checkIniOff', 'short_open_tag', false),
            array('checkIniOn', 'date.timezone', false),
        );
    }

    // region: Output Methods

    /**
     * Outputs a single result through DokuWiki's msg() function
     *
     * @param array $data
     */
    public function echoAsMsg($data)
    {
        $level = -1;
        if ($data['success'] == self::SUCCESS) $level = 1;
        if ($data['success'] == self::WARNING) $level = 0;

        $msg = hsc($data['name'] . ' :' . $data['state']);
        if ($data['success'] !== self::SUCCESS) {
            if (isset($data['hint'])) {
                $msg .= '<br />' . hsc($data['hint']);
            }
            if (isset($data['more'])) {
                $msg .= '<a href="' . self::LEARNMORE . $data['more'] . '">Learn more</a>';
            }
        }
        msg($msg, $level);
    }

    /**
     * Return a single result formatted as HTML
     *
     * @param array $data
     * @return string
     */
    public function resultAsHtml($data)
    {
        $html = '';
        $html .= '<dl class="' . $data['success'] . '">';
        $html .= '<dt class="name">' . self::hsc($data['name']) . '</dt>';
        $html .= '<dd>';
        $html .= '<code class="state">' . self::hsc($data['state']) . '</code>';
        if ($data['success'] !== self::SUCCESS) {
            if (isset($data['hint'])) {
                $html .= ' <span class="hint">' . self::hsc($data['hint']) . '</span>';
            }
            if (isset($data['more'])) {
                $html .= ' <a class="more" href="' . self::LEARNMORE . $data['more'] . '">Learn more</a>';
            }
        }
        $html .= '</dd>';
        $html .= '</dl>';

        return $html;
    }

    /**
     * Directly output a single result formatted as HTML
     *
     * @param array $data
     */
    public function echoAsHtml($data)
    {
        echo $this->resultAsHtml($data);
    }

    /**
     * Return a single result formatted as plain text
     *
     * @param array $data
     * @return string
     */
    public function resultAsText($data)
    {
        $icon = '❌';
        if ($data['success'] === self::SUCCESS) $icon = '✅';
        if ($data['success'] === self::WARNING) $icon = '❗';

        $txt = $icon . ' ' . $data['name'] . ': ' . $data['state'] . "\n";
        if ($data['success'] !== self::SUCCESS) {
            if (isset($data['hint'])) {
                $txt .= '   ' . $data['hint'] . "\n";
            }
            if (isset($data['more'])) {
                $txt .= '   Learn more at ' . self::LEARNMORE . $data['more'] . "\n";
            }
        }

        return $txt;
    }

    /**
     * Directly output a single result formatted as plain text
     *
     * @param array $data
     */
    public function echoAsText($data)
    {
        echo $this->resultAsText($data);
    }

    // endregion

    // region: Checks

    /**
     * Check for minimum PHP requirement
     *
     * @param string $minversion the version required
     * @return array
     */
    public function checkPhpVersion($minversion)
    {
        $ok = version_compare(PHP_VERSION, $minversion, '>=');
        $data = array(
            'name' => 'PHP Version',
            'state' => PHP_VERSION,
            'success' => $ok ? self::SUCCESS : self::FAILURE,
            'hint' => 'You need to upgrade your PHP version to at least ' . $minversion,
            'more' => 'phpversion'
        );

        return $data;
    }

    /**
     * Check if the given function is available
     *
     * @param string $func The function to look for
     * @param bool $musthave is the function needed or just good to have?
     * @return array
     */
    public function checkFunctionAvailability($func, $musthave = true)
    {
        $data = array(
            'name' => 'Function ' . $func,
            'more' => 'functions#' . $func
        );

        $ok = function_exists($func);
        if ($ok) {
            $data['success'] = self::SUCCESS;
            $data['state'] = 'available';
        } elseif ($musthave) {
            $data['success'] = self::FAILURE;
            $data['state'] = 'not available';
            $data['hint'] = 'You might need to install an additional package, ' .
                'enable an extension or ask your provider about it.';
        } else {
            $data['success'] = self::WARNING;
            $data['state'] = 'not available, workaround will be used';
            $data['hint'] = 'DokuWiki will work without this function, but making ' .
                'it available would probably be better and plugins may require it.';
        }

        return $data;
    }

    /**
     * Check the mbstring extension availability
     *
     * @return array
     */
    public function checkMbStringExtension()
    {
        $data = array(
            'name' => 'Multibyte String Extension',
            'more' => 'mbstring'
        );

        if (function_exists('mb_substr')) {
            $data['success'] = self::SUCCESS;
            $data['state'] = 'available';
        } elseif (function_exists('utf8_encode') && function_exists('utf8_decode')) {
            $data['success'] = self::WARNING;
            $data['state'] = 'not available, workaround will be used';
            $data['hint'] = 'The mbstring extension speed up UTF-8 handling significantly, ' .
                'you should install and enable it.';
        } else {
            $data['success'] = self::FAILURE;
            $data['state'] = 'not available';
            $data['hint'] = 'The mbstring extension is not available and the required methods ' .
                'to work around it are not available either.';
        }

        return $data;
    }

    /**
     * Check SSL is available
     *
     * @return array
     */
    public function checkSSL()
    {
        $ok = in_array('ssl', stream_get_transports());
        return array(
            'name' => 'SSL Support',
            'state' => $ok ? 'available' : 'missing',
            'success' => $ok ? self::SUCCESS : self::FAILURE,
            'more' => 'ssl'
        );
    }

    /**
     * Check UTF-8 in PCRE
     *
     * @return array
     */
    public function checkPregUtf8()
    {
        $ok = (bool)@preg_match('/^.$/u', 'ñ');
        return array(
            'name' => 'PCRE UTF-8 Support',
            'state' => $ok ? 'available' : 'missing',
            'success' => $ok ? self::SUCCESS : self::FAILURE,
            'more' => 'pcre'
        );
    }

    /**
     * Check Unicode Property in PCRE
     *
     * @return array
     */
    public function checkPregUnicode()
    {
        $ok = (bool)@preg_match('/^\pL$/u', 'ñ');
        return array(
            'name' => 'PCRE Unicode Property Support',
            'state' => $ok ? 'available' : 'missing',
            'success' => $ok ? self::SUCCESS : self::FAILURE,
            'more' => 'pcre'
        );
    }

    /**
     * Ensure the locale is UTF-8 aware
     *
     * @return array
     */
    public function checkLocale()
    {
        $loc = setlocale(LC_ALL, 0);

        $data = array(
            'name' => 'Locale',
            'state' => $loc,
            'success' => self::SUCCESS
        );

        if (!$loc) {
            $data['success'] = self::FAILURE;
            $data['hint'] = 'No valid locale set';
        } elseif (stripos(strtolower($loc), 'utf') === false) {
            $data['success'] = self::FAILURE;
            $data['hint'] = 'Locale seems not to be a UTF-8 locale, that may cause trouble';
        }
        return $data;
    }

    /**
     * Ensure the given php.ini value is off
     *
     * @param string $var the setting to check
     * @param bool $musthave should this absolutely be disabled, or is it just good advise?
     * @return array|null
     */
    public function checkIniOff($var, $musthave = true)
    {
        if (!function_exists('ini_get')) return null;

        $fail = ($musthave) ? self::FAILURE : self::WARNING;

        $value = ini_get($var);
        $result = (bool)$value;
        return array(
            'name' => "php.ini setting $var",
            'state' => $value,
            'success' => ($result) ? $fail : self::SUCCESS,
            'hint' => "Disable $var in your php.ini"
        );
    }

    /**
     * Ensure the given php.ini value is set
     *
     * @param string $var the setting to check
     * @param bool $musthave should this absolutely be enabled, or is it just good advise?
     * @return array|null
     */
    public function checkIniOn($var, $musthave = true)
    {
        if (!function_exists('ini_get')) return null;

        $fail = ($musthave) ? self::FAILURE : self::WARNING;

        $value = ini_get($var);
        $result = (bool)$value;
        return array(
            'name' => "php.ini setting $var",
            'state' => $value,
            'success' => ($result) ? self::SUCCESS : $fail,
            'hint' => "Set $var in your php.ini"
        );
    }

    // endregion

    // region: Utilities

    /**
     * Wrapper around htmlspecialchars
     *
     * @param string $string
     * @return string
     */
    protected static function hsc($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}