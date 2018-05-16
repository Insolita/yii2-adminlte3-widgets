<?php

namespace insolita\adminlte3;

use yii\bootstrap4\Widget;
use yii\helpers\Html;

class LteSmallBox extends Widget
{
    /**
     * info,danger,success,warning,primary,secondary, dark and *-gradient also
     *
     * @var string $type
     */
    public $type = Lte::TYPE_INFO;
    
    /**
     * (Big text)
     *
     * @var string $title
     */
    public $title = '';
    
    /**
     * text under head
     *
     * @var string $text
     */
    public $text = '';
    
    /**
     * icon class such as "ion ion-bag"  or "fa fa-beer"
     *
     * @var string $icon
     */
    public $icon = '';
    
    /**
     * @var string $footer
     */
    public $footer = '';
    
    /**
     * link for footer
     *
     * @var string $link
     */
    public $link = '#';
    
    /**
     * @var string
     */
    public $template
        = <<<HTML
<div {options}>
   <div class="inner"><h3>{title}</h3><p>{text}</p></div>
   <div class="icon">{icon}</div>
   <a href="{link}" class="small-box-footer">{footer} <i class="fa fa-arrow-circle-right"></i></a>
   </div>
HTML;
    
    /**
     * @return string
     */
    public function run()
    {
        $this->type = Lte::prepend('bg-', $this->type);
        Html::addCssClass($this->options, 'small-box');
        Html::addCssClass($this->options, $this->type);
        
        return strtr(
            $this->template,
            [
                '{options}' => Lte::prepend(' ', Html::renderTagAttributes($this->options)),
                '{title}' => $this->title,
                '{text}' => $this->text,
                '{icon}' => '<i class="' . $this->icon . '"></i>',
                '{footer}' => $this->footer,
                '{link}' => $this->link,
            ]
        );
    }
}
