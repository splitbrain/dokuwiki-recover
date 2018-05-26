<?php

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