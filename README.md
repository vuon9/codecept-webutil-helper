# Codecept WebUtil

![asd](https://api.travis-ci.org/vuongggggg/codecept-webutil-helper.svg?branch=master)

WebUtil is a helper for Codeception. I was extend it from WebDriver and white down some really helper functions.

### Composer installation

```
composer require vuongggggg/codecept-webutil
```

### Functions

- To make custom screenshot instead default `makeScreenshot` function:
    - `$I->makeCustomScreenshot($filename)`: The screenshot file will be saved in `tests/_output/screenshots/`.
    - `$I->setCustomScreenshotDir($screenshotOutputFolder)`: To create custom folder to save screenshots. Customized folder will be a child of `tests/_output/screenshots`.
    - `$I->renewCustomScreenshotDir()`: To delete and re-create screenshot dir when test is started.

### Suite configuration
Enable `Helper\WebUtil` module and make configurations for it instead WebDriver. Example:
```yaml
modules:
    enabled: 
        - Helper\WebUtil
    config:
        Helper\WebUtil:
            url: 'https://github.com/' # Ec server orange website
            browser: chrome # Browser: <chrome|firefox|internet explorer|MicrosoftEdge>
            host: '10.0.2.2' # Selenium Browser server host that is running
            window_size: 1024x864
            port: 4444 # Selenium Browser server port
```

### Optional configurations
- `cleanup_screenshot: true`: Always clean screenshot folder when starting test.
```yaml
modules:
    enabled: 
        - Helper\WebUtil
    config:
        Helper\WebUtil:
            #...
            cleanup_screenshot: true #Cleanup screenshot when started test
```