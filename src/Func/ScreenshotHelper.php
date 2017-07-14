<?php

namespace Helper\Func;

use \Codeception\Configuration as Configuration;

trait ScreenshotHelper {
    /**
     * Set relative folder to export the screenshot
     *
     * @param string $relativePath
     * @return void
     */
    public function setCustomScreenshotDir($relativePath)
    {
        $this->screenshotDir = $relativePath . DIRECTORY_SEPARATOR;
        $this->debug("Screenshots folder is {$relativePath}");
    }
    /**
     * Takes a screenshot of the current window and saves it to `tests/_output/screenshots/[Custom/Path]/`.
     *
     * ``` php
     * <?php
     * $I->amOnPage('/user/edit');
     * $I->makeCustomScreenshot('edit_page');
     * // saved to: tests/_output/screenshots/edit_page.png
     * $I->makeCustomScreenshot(null, 'custom');
     * // saved to: tests/_output/screenshots/custom/2017-05-26_14-24-11_4b3403665fea6.png
     * ?>
     * ```
     *
     * @param $name
     */
    public function makeCustomScreenshot($name = null)
    {
        if (empty($name)) {
            $name = uniqid(date("Y-m-d_H-i-s_"));
        }
        $screenshotPath = $this->getCustomScreenshotDir();
        if (!is_dir($screenshotPath)) {
            @mkdir($screenshotPath, 0777, true);
        }
        $screenName = $screenshotPath . $name . '.png';
        $this->_saveScreenshot($screenName);
        $this->debug("Screenshot saved to $screenName");
    }

    private function getCustomScreenshotDir()
    {
        return Configuration::config()['paths']['log'] . DIRECTORY_SEPARATOR . 'screenshots' . DIRECTORY_SEPARATOR . $this->screenshotDir;
    }

    /**
     * Delete current dir and re-create it
     * There are two ways to use this function:
     * 1. Set configuration in name.suite.yml
     * ```yml
     * Helper\WebUtil:
     *  cleanup_screenshot: true #or false to disable cleanup screenshots dir when started test
     * 
     * ```
     * 2. Call directly in cest class.
     * ```php
     * $I->renewCustomScreenshotDir();
     * ```
     *
     * @return bool Folder has been re-created is TRUE. FALSE is wrong path.
     */
    public function renewCustomScreenshotDir()
    {
        $customDir = $this->getCustomScreenshotDir();
        if (file_exists($customDir)) {
            $it = new \RecursiveDirectoryIterator($customDir, \FilesystemIterator::SKIP_DOTS);
            $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($it as $file) {
                if ($file->isDir()) {
                    rmdir($file->getPathname());
                } else {
                    unlink($file->getPathname());
                }
            }
            rmdir($customDir);
            $this->debug("Screenshots dir \"{$customDir}\" has been deleted");
            mkdir($customDir, 0777, true);
            $this->debug("Screenshots dir \"{$customDir}\" has been re-created");
            return true;
        }
        return false;
    }
}