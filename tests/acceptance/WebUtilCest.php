<?php
use \AcceptanceTester as AcceptanceTester;

class WebUtilCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }
    
    public function testScreenshot(AcceptanceTester $I)
    {
        $now = time();

        $I->amOnPage('/');
        $I->waitForText('Built for developers');
        $I->makeCustomScreenshot('github-1-' . time());
    }

    public function testCreateDirAndScreenshot(AcceptanceTester $I)
    {
        $now = time();

        $I->amOnPage('/');
        $I->waitForText('Built for developers');
        $I->setCustomScreenshotDir(__FUNCTION__);
        $I->makeCustomScreenshot('github-2-' . time());
    }

    public function testRenewScreenshot(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->waitForText('Built for developers');
        $I->setCustomScreenshotDir(__FUNCTION__);
        $I->renewCustomScreenshotDir();
        $I->makeCustomScreenshot('github-3-' . time());
    }
}