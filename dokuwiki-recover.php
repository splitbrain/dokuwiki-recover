<?php
/*> <div style="width:38em; margin: 1em auto; border-left: 3px solid #a00; padding: 0 1em;">

    <h1>Error: No PHP Support</h1>

    <p>
        It seems this server has no PHP support enabled. You need to install and enable PHP before DokuWiki or this
        script will run at all.
    </p>

    <p>
        Contact your hosting provider if you are unsure what this means.
    <p>


    <p>You can learn more at <a href="http://doku.wiki/php">http://doku.wiki/php</a>.</p>
</div> <!--*/
// built 2020-08-31 10:0:53
define('ISBUILD', true);


class GUI
{

    /**
     * Run the script
     */
    public function run()
    {
        header('Content-type: text/html; charset=utf-8');
        header('X-Robots-Tag: noindex');
        echo '<html>
<head>
    <title>DokuWiki Recovery</title>
    <meta name="robots" content="noindex">
    <style type="text/css">
        /* Sakura.css v1.0.0
 * ================
 * Minimal css theme.
 * Project: https://github.com/oxalorg/sakura
 */
/* Body */
html {
  font-size: 62.5%;
  font-family: serif; }

body {
  font-size: 1.8rem;
  line-height: 1.618;
  max-width: 38em;
  margin: auto;
  color: #4a4a4a;
  background-color: #f9f9f9;
  padding: 13px; }

@media (max-width: 684px) {
  body {
    font-size: 1.53rem; } }

@media (max-width: 382px) {
  body {
    font-size: 1.35rem; } }

h1, h2, h3, h4, h5, h6 {
  line-height: 1.1;
  font-family: Verdana, Geneva, sans-serif;
  font-weight: 700;
  overflow-wrap: break-word;
  word-wrap: break-word;
  -ms-word-break: break-all;
  word-break: break-word;
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto; }

h1 {
  font-size: 2.35em; }

h2 {
  font-size: 2.00em; }

h3 {
  font-size: 1.75em; }

h4 {
  font-size: 1.5em; }

h5 {
  font-size: 1.25em; }

h6 {
  font-size: 1em; }

small, sub, sup {
  font-size: 75%; }

hr {
  border-color: #2c8898; }

a {
  text-decoration: none;
  color: #2c8898; }
  a:hover {
    color: #982c61;
    border-bottom: 2px solid #4a4a4a; }

ul {
  padding-left: 1.4em; }

li {
  margin-bottom: 0.4em; }

blockquote {
  font-style: italic;
  margin-left: 1.5em;
  padding-left: 1em;
  border-left: 3px solid #2c8898; }

img {
  max-width: 100%; }

/* Pre and Code */
pre {
  background-color: #f1f1f1;
  display: block;
  padding: 1em;
  overflow-x: auto; }

code {
  font-size: 0.9em;
  padding: 0 0.5em;
  background-color: #f1f1f1;
  white-space: pre-wrap; }

pre > code {
  padding: 0;
  background-color: transparent;
  white-space: pre; }

/* Tables */
table {
  text-align: justify;
  width: 100%;
  border-collapse: collapse; }

td, th {
  padding: 0.5em;
  border-bottom: 1px solid #f1f1f1; }

/* Buttons, forms and input */
input, textarea {
  border: 1px solid #4a4a4a; }
  input:focus, textarea:focus {
    border: 1px solid #2c8898; }

textarea {
  width: 100%; }

.button, button, input[type="submit"], input[type="reset"], input[type="button"] {
  display: inline-block;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  white-space: nowrap;
  background-color: #2c8898;
  color: #f9f9f9;
  border-radius: 1px;
  border: 1px solid #2c8898;
  cursor: pointer;
  box-sizing: border-box; }
  .button[disabled], button[disabled], input[type="submit"][disabled], input[type="reset"][disabled], input[type="button"][disabled] {
    cursor: default;
    opacity: .5; }
  .button:focus, .button:hover, button:focus, button:hover, input[type="submit"]:focus, input[type="submit"]:hover, input[type="reset"]:focus, input[type="reset"]:hover, input[type="button"]:focus, input[type="button"]:hover {
    background-color: #982c61;
    border-color: #982c61;
    color: #f9f9f9;
    outline: 0; }

textarea, select, input[type] {
  color: #4a4a4a;
  padding: 6px 10px;
  /* The 6px vertically centers text on FF, ignored by Webkit */
  margin-bottom: 10px;
  background-color: #f1f1f1;
  border: 1px solid #f1f1f1;
  border-radius: 4px;
  box-shadow: none;
  box-sizing: border-box; }
  textarea:focus, select:focus, input[type]:focus {
    border: 1px solid #2c8898;
    outline: 0; }

input[type="checkbox"]:focus {
  outline: 1px dotted #2c8898; }

label, legend, fieldset {
  display: block;
  margin-bottom: .5rem;
  font-weight: 600; }
body {
    font-family: sans-serif;
}

.error {
    border-color: #a00;
}

.footer {
    clear: both;
    margin: 8em 0 3em 0;
}

.requirements dd code {
    display: inline-block;
    max-width: 61rem;
    overflow: auto;
}

.requirements dl.success dt::after {
    content: \' looks good✅\';
    color: #0a0;
}

.requirements dl.warning dt::after {
    content: \' might need improvement❗\';
    color: #aa0;
}
.requirements dl.failure dt::after {
    content: \' shows a problem❌\';
    color: #a00;

}



    </style>
</head>
<body>

';
        try {
            $step = isset($_REQUEST['step']) ? (int) $_REQUEST['step'] : 0;
            switch ($step) {
                case 1:
                    $this->step1();
                    break;
                case 2:
                    $this->step2();
                    break;
                case 3:
                    $this->step3();
                    break;
                case -1:
                    $this->stepDelete();
                    break;
                default:
                    $this->step0();
            }
        } catch (Exception $e) {
            $this->showError($e);
        }
        echo '

<p class="footer"><small>
    Did this script help you? Consider thanking me via <a href="http://donate.dokuwiki.org/recover">Paypal</a> or <a
        href="https://www.patreon.com/dokuwiki">Patreon</a> ❤
</small></p>

</body>
</html>';
    }

    /**
     * Just shows the intro
     */
    protected function step0()
    {
        echo '<h1>DokuWiki Problems, eh?</h1>
<p>
    This script helps you to reconfigure your DokuWiki to a state that should allow you to login again and manually
    fix things.
</p>

<blockquote class="error">
    <b>Important:</b> Having this script on your server is a security risk. Be sure to <a href="?step=-1">remove</a>
    it as soon as you\'re done with it.
</blockquote>

<p>This script has two steps:</p>

<ol>
    <li>Check Requirements</li>
    <li>Reset DokuWiki</li>
</ol>

<p>
    None of the steps will touch your actual data (pages, media) so you don\'t need to worry about that.
</p>

<p>
    Using the script happens on your own risk. Please keep in mind that this script will <b>not</b> work for you when…
</p>

<ul>
    <li>…certain files are not writable (the script will tell you about it)</li>
    <li>…you moved your <code>conf</code> directory to a different place (the script might think it succeeded, but
        it will still not work for you)
    </li>
    <li>…your PHP doesn\'t work at all (you will see some message further up)</li>
    <li>…the requirements to run DokuWiki aren\'t met (Step 1 will help you with that)</li>
</ul>

<p>
    The next step will simply check if your PHP setup matches all the requirments of the newest DokuWiki release.
    Maybe your setup is simply missing a little something? That step will not modify anything, it just checks things
    so its perfectly save to click that button :-).
</p>

<a href="?step=1" class="button" style="float: right">Step 1: Check Requirements ⮕</a>

';
    }

    /**
     * Check requirements
     */
    protected function step1()
    {
        echo '<h1>Requirements Check</h1>

<p>DokuWiki needs a working PHP environment to run. Let\'s see if we have everything we need.</p>';
        $check = new Check();
        echo '<div class="requirements">';
        $results = $check->runAllChecks(array($check, 'echoAsHtml'));
        echo '</div>';

        if ($results[Check::FAILURE] > 0) {
            echo '<h2>Problems Found</h2>

<p>It seems like there have been some problems with your PHP environment identified. The above output should
give you some hint on how to fix that. Try this script again afterwards, if needed.</p>

<p>We\'re done here. You probably want to <a href="?step=-1">delete this script</a> again.</p>';
        } else {
            if ($results[Check::WARNING] > 0) {
                echo '<h2>Only Warnings Found</h2>

<p>
    Basically everything seems to be alright. There are a few things that could use imporovements, but DokuWiki
    core should work just fine with this environment. There is probably something else wrong with your setup.
</p>

';
            } else {
                echo '<h2>Everything is A-Okay</h2>

<p>
    Everything looks fine. DokuWiki core should work just fine with this environment. There is probably something else
    wrong with your setup.
</p>

';
            }
            echo '<p>
    I\'ll explain what else we can do on the next page. Still safe to click.
</p>

<a href="?step=2" class="button" style="float: right">Explain Step 2 ⮕</a>';
        }
    }

    /**
     * Explain everything
     */
    protected function step2()
    {
        echo '<h1>Reset DokuWiki</h1>

<p>
    So your environment looks good, but your wiki is still broken? Let\'s see what we can do.
</p>

<blockquote class="error">
    First of all: if you still can log into your wiki and use the admin interface, it\'s <b>not broken</b> in a way that
    requires this script. <a href="?step=-1">Delete this script</a> and fix stuff manually. Seriously, using this
    script will create more work for you than just fixing manually. <b>You have been warned</b>.
</blockquote>

<p>Now, if you continue, this is what will happen:</p>

<ol>
    <li>switch back to the default template</li>
    <li>switch the language to English</li>
    <li>disable all plugins except the bare minimum</li>
    <li>ensure ACLs are enabled</li>
    <li>switch to the <code>authplain</code> Authentication backend</li>
    <li>turn the group <code>dokuwiki-recovery</code> into superusers</li>
    <li>create a new user in that group (we\'ll show you the user and password)</li>
</ol>

<p>This should turn your wiki back to the most barebone functionality again. Enough to log in with the new user and fix
    things manually.</p>

<p>This is the Danger Button! Only click if you\'re sure…</p>

<a href="?step=3" class="button" style="float: right">Step 2: Reset DokuWiki ⮕</a>';
    }

    /**
     * Reset the wiki
     */
    protected function step3()
    {
        echo '<h1>DokuWiki Reset</h1>
';

        $recover = new Recover();
        list($user, $password) = $recover->run();

        echo '<blockquote>';
        echo '<h2>User Created</h2>';
        echo '<p>A new user was created with the following credentials. Use it to log back into your DokuWiki:</p>';
        echo '<dl>';
        echo '<dt>User:</dt>';
        echo "<dd>$user</dd>";
        echo '<dt>Password:</dt>';
        echo "<dd>$password</dd>";
        echo '</dl>';
        echo '</blockquote>';

        try {
            Recover::selfDelete();
            echo '<p>✅ This script itself has been automatically deleted.</p>';
        } catch (Exception $e) {
            echo '<blockquote class="error">';
            echo $e->getMessage();
            echo '</blockquote>';
        }

        echo '<h2>What next?</h2>

<p>
    <b>Before you do anything</b>, save the TODO list below somewhere. Just copy\'n\'paste it to a text document or
    something.
    Then start working through it.
</p>

<ol>
    <li>Ensure this script has been deleted</li>
    <li>Log in with the user given above</li>
    <li>Check if everything works so far</li>
    <li>Upgrade your plugins (use <code>reinstall</code> in the Extension manager, even if no update is shown to be
        available, the version info might be outdated)
    </li>
    <li>Check the forum and the plugin\'s page to see if there are any known problems</li>
    <li>Re-Enable your plugins one by one and check that everything still works after each one</li>
    <li>Update your template</li>
    <li>Check the forum and the template\'s page to see if there are any known problems</li>
    <li>Re-Enable your template</li>
    <li>Re-Enable the <code>userewrite</code> configuration if you had it enabled before and you have made sure the
        prerequisites are matched
    </li>
    <li>Switch back to your favorite language</li>
    <li>Reconfigure and re-enable your auth backend if it was different before</li>
    <li>Change the <code>superuser</code> configuration back to contain your usual admin account</li>
    <li>Delete the temporary user we created above</li>
</ol>

<p><b>Good Luck!</b></p>

';
    }

    /**
     * Delete the script
     */
    protected function stepDelete()
    {
        Recover::selfDelete();
        echo '<h1>*poof*</h1>

<p>The script should be gone. Try reloading to see that it\'s gone for sure.</p>';
    }

    /**
     * @param Exception $e
     */
    protected function showError($e)
    {
        echo '<blockquote class="error">';
        echo '<h2>Error</h2>';
        echo '<b>' . htmlspecialchars($e->getMessage()) . '</b>';
        echo '<p>Looks like something went wrong and the script cannot continue. ';
        echo 'Sorry about that. See if you can fix above problem and try again. ';
        echo 'If you can\'t figure it out, maybe ask in the ';
        echo '<a href="https://forum.dokuwiki.org">Forum</a>?</p>';
        echo '</blockquote>';
    }


}


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
            array('checkSSLCerts'),
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
     * Check if there is any certificate information available
     *
     * @return array
     */
    public function checkSSLCerts()
    {
        $info = array(
            'name' => 'SSL Certificate Info',
            'state' => 'missing',
            'success' => self::FAILURE,
            'more' => 'ssl'
        );


        if (!function_exists('openssl_get_cert_locations')) {
            return $info;
        }

        $stores = openssl_get_cert_locations();

        foreach (array('ini_cafile', 'default_cert_file') as $key) {
            if (!empty($stores[$key]) && file_exists($stores[$key])) {
                $info['success'] = self::SUCCESS;
                $info['state'] = $stores[$key];
                return $info;
            }
        }

        foreach (array('ini_capath', 'default_cert_dir') as $key) {
            if (!empty($stores[$key]) && is_dir($stores[$key]) && glob($stores[$key] . '/*')) {
                $info['success'] = self::SUCCESS;
                $info['state'] = $stores[$key];
                return $info;
            }
        }

        return $info;
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


class Recover
{
    protected $plugindir;
    protected $pluginconf;
    protected $userconf;
    protected $localconf;

    /**
     * Recover constructor.
     *
     * Ensures all the files are writable before we even continue
     */
    public function __construct()
    {
        $this->plugindir = __DIR__ . '/lib/plugins';
        $this->pluginconf = __DIR__ . '/conf/plugins.local.php';
        $this->userconf = __DIR__ . '/conf/users.auth.php';
        $this->localconf = __DIR__ . '/conf/local.php';

        if (defined('ISBUILD') && (time() - filemtime(__FILE__) > 60 * 60)) {
            try {
                self::selfDelete();
                $msg = 'The file has been deleted automatically. Upload it again if you really need it.';
            } catch (Exception $e) {
                $msg = $e->getMessage();
            }

            throw new RuntimeException(
                'This file was uploaded more than an hour ago. I simply assume that it was ' .
                'forgotten and should not be here anymore. ' . $msg
            );
        }

        if (!file_exists(__DIR__ . '/doku.php')) {
            throw new RuntimeException(
                'doku.php does not exist next to the recovery file located in ' . __DIR__ .
                '. Did you upload the recovery file to the wrong location ?'
            );
        }

        if (!is_dir($this->plugindir)) {
            throw new RuntimeException("Plugin directory $this->plugindir seems not to exist");
        }


        if (!is_writable($this->pluginconf)) {
            throw new RuntimeException("Can't write plugin configuration at $this->pluginconf");
        }

        if (!file_exists($this->localconf)) {
            throw new RuntimeException("Local config $this->localconf does not exist. Was this wiki never configured?");
        }

        if (!is_writable($this->localconf)) {
            throw new RuntimeException("Can't write to local configuration at $this->localconf");
        }

        if (!file_exists($this->userconf)) {
            throw new RuntimeException("User config $this->userconf does not exist. Was this wiki never configured?");
        }

        if (!is_writable($this->userconf)) {
            throw new RuntimeException("Can't write to user configuration at $this->userconf");
        }

    }

    /**
     * Execute the reset
     *
     * @return string[] user, password
     */
    public function run()
    {
        $this->disableAllPlugins();
        $result = $this->addNewAdmin();
        $this->setFailoverConfig();
        return $result;
    }

    /**
     * Disables all plugins except the bare minimum
     */
    protected function disableAllPlugins()
    {
        // absolute minimum set of plugins:
        $wanted = array('acl', 'authplain', 'config', 'extension', 'usermanager');

        // find all potential plugins
        $plugins = glob("$this->plugindir/*", GLOB_ONLYDIR);
        $plugins = array_map('basename', $plugins);
        $plugins = array_diff($plugins, $wanted);


        $newconfig = "\n\n";
        $newconfig .= "// The following lines were added be dokuwiki-recover\n";
        $newconfig .= "// " . date('Y-m-d H:i:s') . "\n";
        foreach ($plugins as $plugin) {
            $newconfig .= "\$plugins['$plugin'] = 0;\n";
        }

        $ok = file_put_contents($this->pluginconf, $newconfig, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing plugin configuration to $this->pluginconf failed");
        }
    }

    /**
     * Overwrite some crucial variables
     */
    protected function setFailoverConfig()
    {
        $newconfig = "\n\n";
        $newconfig .= "// The following lines were added be dokuwiki-recover\n";
        $newconfig .= "// " . date('Y-m-d H:i:s') . "\n";
        $newconfig .= "\$conf['useacl'] = 1;\n";
        $newconfig .= "\$conf['authtype'] = 'authplain';\n";
        $newconfig .= "\$conf['superuser'] = '@dokuwiki-recover';\n";
        $newconfig .= "\$conf['userewrite'] = 0;\n";
        $newconfig .= "\$conf['lang'] = 'en';\n";
        $newconfig .= "\$conf['template'] = 'dokuwiki';\n";

        $ok = file_put_contents($this->localconf, $newconfig, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing local configuration to $this->localconf failed");
        }
    }

    /**
     * Creates a new user/password
     *
     * @return string[] user, password
     */
    protected function addNewAdmin()
    {
        // random new user/password, not cryptographically sound, but good enough for temporary
        $user = 'recover-' . substr(md5(mt_rand() . time()), 0, 6);
        $pass = substr(md5(mt_rand() . time()), 0, 8);
        $hash = sha1($pass);

        $newline = "\n$user:$hash:DokuWiki Recovery User. Delete after use:$user@example.com:dokuwiki-recover\n";
        $ok = file_put_contents($this->userconf, $newline, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing user configuration to $this->userconf failed");
        }

        return array($user, $pass);
    }

    /**
     * Deletes the script
     */
    public static function selfDelete()
    {
        if (!@unlink(__FILE__)) {
            throw new RuntimeException(
                'The script (located at ' . __FILE__ . ') could not be deleted automatically. You need to delete ' .
                'it yourself. Not doing so is a huge security risk!'
            );
        }
    }
}

$gui = new GUI();
$gui->run();
//-->
