<?php

class GUI
{

    /**
     * Run the script
     */
    public function run()
    {
        header('Content-type: text/html; charset=utf-8');
        header('X-Robots-Tag: noindex');
        echo '__HEADER__';
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
        echo '__FOOTER__';
    }

    /**
     * Just shows the intro
     */
    protected function step0()
    {
        echo '__STEP0__';
    }

    /**
     * Check requirements
     */
    protected function step1()
    {
        echo '__STEP1-INTRO__';
        $check = new Check();
        echo '<div class="requirements">';
        $results = $check->runAllChecks(array($check, 'echoAsHtml'));
        echo '</div>';

        if ($results[Check::FAILURE] > 0) {
            echo '__STEP1-FAIL__';
        } else {
            if ($results[Check::WARNING] > 0) {
                echo '__STEP1-WARN__';
            } else {
                echo '__STEP1-GOOD__';
            }
            echo '__STEP1-NEXT__';
        }
    }

    /**
     * Explain everything
     */
    protected function step2()
    {
        echo '__STEP2__';
    }

    /**
     * Reset the wiki
     */
    protected function step3()
    {
        echo '__STEP3-INTRO__';

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

        echo '__STEP3-OUTRO__';
    }

    /**
     * Delete the script
     */
    protected function stepDelete()
    {
        Recover::selfDelete();
        echo '__STEP-DELETED__';
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