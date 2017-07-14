<?php
namespace Helper;

use \Codeception\Configuration as Configuration;
use Helper\Func\ScreenshotHelper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class WebUtil extends \Codeception\Module\WebDriver
{
    use ScreenshotHelper;

    protected $screenshotDir = '';

    /**
     * _before test
     *
     * @param \Codeception\TestInterface $test
     * @return void
     */
    public function _before(\Codeception\TestCase $test)
    {
        $isCleanupScreenshot = isset($this->config['cleanup_screenshot']) && $this->config['cleanup_screenshot'] ?: false;
        if ($isCleanupScreenshot) {
            $this->renewCustomScreenshotDir();
        }
        parent::_before($test);
    }
}
