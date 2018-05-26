<?php

class Recover
{
    /**
     * Run the script
     */
    public function run()
    {
        echo '__HEADER__';
        try {
            $this->perFlightCheck();
            $this->step0();

        } catch (Exception $e) {
            $this->showError($e);
        }
        echo '__FOOTER__';
    }


    protected function step0()
    {
        echo '__INTRO__';
    }

    /**
     * @param Exception $e
     */
    protected function showError($e)
    {
        echo '<div class="error">';
        echo htmlspecialchars($e->getMessage());
        echo '</div>';
    }

    /**
     * Ensures this script may run at all
     */
    protected function perFlightCheck()
    {
        if (defined('ISBUILD') && (time() - filemtime(__FILE__) > 60 * 60)) {
            // FIXME implement deletion here

            throw new RuntimeException(
                'This file was uploaded more than an hour ago. I simply assume that it was ' .
                'forgotten and should not be here anymore. Upload it again if you really need it.'
            );
        }

        if (!file_exists(__DIR__ . ' / doku . php')) {
            throw new RuntimeException(
                'doku . php does not exist next to the recovery file located in ' . __DIR__ .
                ' . Did you upload the recovery file to the wrong location ? '
            );
        }
    }

    /**
     * Disables all plugins except the bare minimum
     */
    protected function disableAllPlugins()
    {
        $plugindir = __DIR__ . ' / lib / plugins';
        if (!is_dir($plugindir)) {
            throw new RuntimeException("Plugin directory $plugindir seems not to exist");
        }

        $pluginconf = __DIR__ . ' / conf / plugins . local . php';
        if (!is_writable($pluginconf)) {
            throw new RuntimeException("Can't write plugin configuration at $pluginconf");
        }

        // absolute minimum set of plugins:
        $wanted = array('acl', 'authplain', 'config', 'extension', 'usermanager');

        // find all potential plugins
        $plugins = glob("$plugindir/*", GLOB_ONLYDIR);
        $plugins = array_map('basename', $plugins);
        $plugins = array_intersect($plugins, $wanted);


        $newconfig = "\n\n";
        $newconfig .= "// The following lines were added be dokuwiki-recover\n";
        $newconfig .= "// " . date('Y-m-d H:i:s') . "\n";
        foreach ($plugins as $plugin) {
            $newconfig .= "\$plugins['$plugin'] = 0;\n";
        }

        $ok = file_put_contents($pluginconf, $newconfig, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing plugin configuration to $pluginconf failed");
        }
    }

    /**
     * Overwrite some crucial variables
     */
    protected function setFailoverConfig()
    {
        $config = __DIR__ . '/conf/local.php';
        if (!file_exists($config)) {
            throw new RuntimeException("Local config $config does not exist. Was this wiki never configured?");
        }

        if (!is_writable($config)) {
            throw new RuntimeException("Can't write to local configuration at $config");
        }

        $newconfig = "\n\n";
        $newconfig .= "// The following lines were added be dokuwiki-recover\n";
        $newconfig .= "// " . date('Y-m-d H:i:s') . "\n";
        $newconfig .= "\$conf['useacl'] = 1;\n";
        $newconfig .= "\$conf['authtype'] = 'authplain';\n";
        $newconfig .= "\$conf['superuser'] = '@dokuwiki-recover';\n";
        $newconfig .= "\$conf['userewrite'] = 0;\n";
        $newconfig .= "\$conf['lang'] = 'en';\n";
        $newconfig .= "\$conf['template'] = 'dokuwiki';\n";

        $ok = file_put_contents($config, $newconfig, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing local configuration to $config failed");
        }
    }

    /**
     * Creates a new user/password
     *
     * @return string[] user, password
     */
    protected function addNewAdmin()
    {
        $config = __DIR__ . '/conf/users.auth.php';
        if (!file_exists($config)) {
            throw new RuntimeException("User config $config does not exist. Was this wiki never configured?");
        }

        if (!is_writable($config)) {
            throw new RuntimeException("Can't write to user configuration at $config");
        }

        // random new user/password, not cryptographically sound, but good enough for temporary
        $user = 'recover-' . substr(md5(mt_rand() . time()), 0, 6);
        $pass = substr(md5(mt_rand() . time()), 0, 8);
        $hash = sha1($pass);

        $newline = "\n$user:$hash:DokuWiki Recovery User. Delete after use:none@example.com:dokuwiki-recover\n";
        $ok = file_put_contents($config, $newline, FILE_APPEND);
        if (!$ok) {
            throw new RuntimeException("Writing user configuration to $config failed");
        }

        return array($user, $pass);
    }

}