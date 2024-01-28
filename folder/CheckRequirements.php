<?php

class CheckRequirements
{
    private array $message = [];

    public function __invoke()
    {
        $php = $this->checkPhpVersion();
        $composer = $this->checkComposerVersion();
        $git = $this->checkGitVersion();

        return ($php && $composer && $git) ? true : false;
    }

    public function getMessage()
    {
        return implode(PHP_EOL, $this->message);
    }

    private function checkPhpVersion($require = '8.1.0')
    {
        $return = true;

        if (version_compare(PHP_VERSION, $require) < 0) {
            $this->message[] =  "Requires php version $require or higher";
            $return = false;
        }

        if (!extension_loaded('curl')) {
            $this->message[] =  "Module php curl is required";
            $return = false;
        }
        
        return $return;
    }

    private function checkComposerVersion($require = '2.0.0')
    {
        exec('composer --version', $output);
        $version = substr($output[0], 17, 6);

        if (version_compare($version, $require) < 0) {
            $this->message[] =  "Requires composer version $require or higher";
            return false;
        }

        return true;
    }

    private function checkGitVersion($require = '2.0.0')
    {
        exec('git --version', $output);
        $version = substr($output[0], 12);

        if (version_compare($version, $require) < 0) {
            $this->message[] =  "Requires git version $require or higher";
            return false;
        }
        
        return true;
    }
}
