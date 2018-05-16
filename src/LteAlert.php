<?php

namespace insolita\adminlte3;

use yii\bootstrap4\Widget;
use yii\helpers\Html;

class LteAlert extends Widget
{
    /**
     * info,danger,success,warning,primary
     * @var string $type
     */
    public $type = Lte::TYPE_SUCCESS;
    
    /**
     * show or not close button
     * @var boolean $closable
     */
    public $closable = true;
    
    /**
     * @var string $text
     */
    public $text = '';
    
    /**
     * @var string
     */
    public $title;
    
    /**
     * icon class like "ion ion-bag"  or "fa fa-beer"
     * @var string $icon
     */
    public $icon;
    
    public $templateWithTitle = <<<HTML
<div {options}>{close}<h5><i class="icon {icon}"></i> {title}</h5>{message}
HTML;
    
    public $template= <<<HTML
<div {options}>{close}<i class="icon {icon}"></i> {message}
HTML;
    
    public $closeTemplate = <<<HTML
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
HTML;

    /**
     * @var array
     */
    public $iconMap = [
            Lte::TYPE_DANGER  => 'fa fa-lg fa-ban',
            Lte::TYPE_INFO    => 'fa fa-lg fa-info',
            Lte::TYPE_WARNING => 'fa fa-lg fa-warning',
            Lte::TYPE_SUCCESS => 'fa fa-lg fa-check',
            Lte::TYPE_LIGHT => 'fa fa-lg fa-smile-o',
            Lte::TYPE_DARK => 'fa fa-lg fa-asterisk',
        ];
    

    public function init()
    {
        parent::init();
        if (!$this->icon) {
            $this->icon = $this->iconMap[$this->type] ?? 'fa fa-question';
        }
        Html::addCssClass($this->options, 'alert');
        Html::addCssClass($this->options, 'alert-' . $this->type);
        if ($this->closable) {
            Html::addCssClass($this->options, 'alert-dismissable');
        }
        $template = $this->title ? $this->templateWithTitle : $this->template;
        echo strtr(
            $template,
            [
                '{options}' => Html::renderTagAttributes($this->options),
                '{close}'   => $this->closable? $this->closeTemplate: '',
                '{title}'   => $this->title,
                '{icon}'    => $this->icon,
                '{message}' => $this->text,
            ]
        );
    }

    public function run()
    {
        return '</div>';
    }
}
