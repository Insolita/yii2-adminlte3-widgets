<?php

namespace insolita\adminlte3;

use yii\bootstrap4\Widget;

class LteInfoBox extends Widget
{
    /**
     * @var string
     */
    public $icon = 'fa fa-bullhorn';
    
    /**
     * info,success,warning,danger,light,dark,primary,secondary and *-gradient also
     *
     * @var string
     */
    public $bgIconColor = Lte::TYPE_PRIMARY;
    
    /**
     * info,success,warning,danger,light,dark,primary,secondary and *-gradient also
     *
     * @var string
     */
    public $bgColor = Lte::TYPE_LIGHT;
    
    /**
     * @var
     */
    public $text;
    
    /**
     * @var
     */
    public $number;
    
    /**
     * @var bool
     */
    public $showProgress = false;
    
    /**
     * @var string
     */
    public $description = '';
    
    /**
     * @var int
     */
    public $progressNumber = 0;
    
    /**
     * @var string
     */
    public $template
        = <<<HTML
<div class="info-box{bgColor}">
  <span class="info-box-icon{bgIconColor}">{icon}</span>
  <div class="info-box-content">
    <span class="info-box-text">{text}</span>
    <span class="info-box-number">{number}</span>
    {progress}
  </div>
</div>
HTML;
    
    /**
     * @var string
     */
    public $progressTemplate
        = <<<HTML
<div class="progress"><div class="progress-bar{options}" style="width:{number}%"></div></div>
<span class="progress-description">{text}</span>
HTML;
    
    public function init()
    {
        $this->bgColor = Lte::prepend(' bg-', $this->bgColor);
        $this->bgIconColor = Lte::prepend(' bg-', $this->bgIconColor);
        parent::init();
    }
    
    /**
     * @return string
     */
    public function run()
    {
        $progress = '';
        if ($this->showProgress) {
            $progress = strtr(
                $this->progressTemplate,
                [
                    '{number}' => $this->progressNumber,
                    '{text}' => $this->description,
                    '{options}' => $this->bgColor ? '' : ' ' . $this->bgIconColor,
                ]
            );
        }
        
        return strtr(
            $this->template,
            [
                '{icon}' => '<i class="' . $this->icon . '"></i>',
                '{text}' => $this->text,
                '{bgColor}' => $this->bgColor,
                '{bgIconColor}' => $this->bgIconColor,
                '{number}' => $this->number,
                '{progress}' => $progress ?: $this->description,
            ]
        );
    }
}
