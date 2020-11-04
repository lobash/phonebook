<?php

namespace views;

class View
{
    /** @var array */
    private $aData = [];

    /** @var string */
    private $sViewPath = '';

    /**
     * View constructor.
     * @param string $sTemplate
     */
    public function __construct(string $sTemplate)
    {
        try {
            $sFilePath = ROOT . '/views/template/' . strtolower($sTemplate) . '.php';
            if (file_exists($sFilePath) === false) {
                throw new \Exception('template not found');
            }

            $this->sViewPath = $sFilePath;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * @param string $sName
     * @param string $sValue
     * @return void
     */
    public function assign(string $sName, $sValue): void
    {
        $this->aData[$sName] = $sValue;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        extract($this->aData);
        return require $this->sViewPath;
    }
}