<?php

namespace insolita\adminlte3;

use yii\bootstrap4\Html;
use yii\bootstrap4\Widget;

class LteCallout extends Widget
{
    /**
     * info,danger,success,warning,primary
     * @var string $type
     */
    public $type = Lte::TYPE_INFO;
    
    /**
     * @var string $title
     */
    public $title = '';
    
    /**
     * @var string $text
     **/
    public $text = '';
    
    /**
     * @inheritdoc
     */
    public $options = [];
    
    
    public $topTemplate = '<div {options}><h5>{title}</h5>';
    public $endTemplate = '</div>';
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'callout');
        Html::addCssClass($this->options, 'callout-' . $this->type);
        echo strtr(
            $this->topTemplate,
            [
                '{options}' => Html::renderTagAttributes($this->options),
                '{title}'    => $this->title,
            ]
        );
        if ($this->text) {
            echo $this->text;
        }
    }

    public function run()
    {
        return $this->endTemplate;
    }
}
