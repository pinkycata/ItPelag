<?php

$test = new SettingsRepository(new GlobalSettings, new CustomLogger);

class CustomLogger{
    public function log1(string $message){
        $fileName = __DIR__ . "/logs.txt";
        $logMessage = `log message: $message`;
        file_put_contents($fileName, $logMessage);
    }
}

class GlobalSettings
{
    function getSetting(string $key, string $default = '') : array
    { 
        return [$key => $default];
    }
    
    function getOption(string $key): string {
        switch ($key)
        {
            case 'key2':
                return '5';
            case 'uploads_use_yearmonth_folders':
                return '10';
            default:
                return "default";
        }
    }
}

class SettingsRepository
{
    public function __construct(
        private GlobalSettings $globalSettings,
        private CustomLogger $customLogger
    ){}

    private $settings = [
            'use-yearmonth-folders' => '2', 
            'wp-uploads' => '1', 
            'copy-to-s3' => '2', 
            'serve-from-s3' => '3', 
            'object-prefix' => '4', 
            'object-versioning' => '1212', 
    ];

    private function getDefaultObjectPrefix(): string
    {
        return 'get_default_object_prefix';
    }
    
    function getSetting(string $key, string $default = ''): string
    {
        if (
            isset($this->settings['wp-uploads'])
            && in_array($key, array('copy-to-s3', 'serve-from-s3'))
        ) {
            return $default;
        }elseif (
            'object-versioning' == $key
            && !isset($this->settings['object-versioning'])
        ) { 
            return $default;
        }elseif(
            'object-prefix' == $key 
            && !isset($this->settings['object-prefix'])
        ) { 
            return $this->getDefaultObjectPrefix(); 
        }else {
            $this->customLogger->log1('step 3'); 
            if (
                'use-yearmonth-folders' == $key 
                && !isset($this->settings['use-yearmonth-folders'])
            ) {
                return $this->globalSettings->getOption('uploads_use_yearmonth_folders');
            }else {
                $value = $this->globalSettings->getSetting($key, $default);
                return $value[$key];
            }
        }
    }
    
}