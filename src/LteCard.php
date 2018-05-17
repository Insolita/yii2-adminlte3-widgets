<?php

namespace insolita\adminlte3;

use yii\bootstrap4\Widget;
use yii\helpers\Html;
use function strtr;

class LteCard extends Widget
{
    /**
     * default,success,info,danger,warning,primary,secondary,dark
     * and also *-gradient when isSolid = true
     *
     * @var string $type
     */
    public $type;
    
    /**
     * @var bool
     */
    public $isOutlined = true;
    
    /**
     * @var bool
     */
    public $isSolidBg = false;
    
    /**
     * @var bool
     */
    public $hasHeadBorder = true;
    
    /**
     * @var bool
     */
    public $removeEnabled = false;
    
    /**
     * @var bool
     */
    public $refreshEnabled = false;
    
    /**
     * @var bool
     */
    public $collapseEnabled = false;
    
    /**
     * @var bool
     */
    public $collapseRemember = false;
    
    /**
     * @var string
     */
    public $refreshAction;
    
    /**
     * @var string|null
     */
    public $title;
    
    /**
     * @var string
     */
    public $titleTag = 'h3';
    
    /**
     * @var string|null
     */
    public $body;
    
    /**
     * @var string|null
     */
    public $footer;
    
    /**
     * Tool buttons
     *
     * @var string|null $tools
     */
    public $tools;
    
    /**
     * @var array
     */
    public $options = [];
    
    public $templateTop
        = <<<HTML
<div {options}>
  <div class="card-header{border}">
    {title}{tools}
  </div>
  <div class="card-body">
    {body}
HTML;
    
    public $templateBottom
        = <<<HTML
  </div>
  {footer}
</div>
HTML;
    
    public function init()
    {
        parent::init();
        $this->prepareOptions();
        $this->registerJs();
        echo strtr($this->templateTop, [
            '{options}' => Html::renderTagAttributes($this->options),
            '{title}' => $this->renderTitle(),
            '{tools}' => $this->renderToolbar(),
            '{body}' => $this->body ?: '',
            '{border}' => $this->hasHeadBorder ? '' : ' no-border',
        ]);
    }
    
    public function run()
    {
        echo strtr($this->templateBottom, [
            '{footer}' => $this->renderFooter(),
        ]);
    }
    
    protected function renderTitle(): string
    {
        return $this->title
            ? Html::tag($this->titleTag, $this->title, ['class' => 'card-title'])
            : '';
    }
    
    protected function prepareOptions()
    {
        Html::addCssClass($this->options, 'card');
        if ($this->isSolidBg) {
            Html::addCssClass($this->options, 'bg-' . $this->type);
        } else {
            Html::addCssClass($this->options, 'card-' . $this->type);
        }
        if ($this->isOutlined) {
            Html::addCssClass($this->options, 'card-outline');
        }
    }
    
    protected function renderToolbar(): string
    {
        $tools = (string)$this->tools ?? '';
        if ($this->collapseEnabled) {
            $tools .= Html::button('<i class="fa fa-minus"></i>',
                ['class' => 'btn btn-tool', 'data-widget' => 'collapse', 'id' => $this->getId() . '_collapse']);
        }
        if ($this->refreshEnabled) {
            $tools .= Html::button('<i class="fa fa-refresh"></i>',
                ['class' => 'btn btn-tool', 'data-widget' => 'refresh', 'id' => $this->getId() . '_refresh']);
        }
        if ($this->removeEnabled) {
            $tools .= Html::button('<i class="fa fa-times"></i>',
                ['class' => 'btn btn-tool', 'data-widget' => 'remove', 'id' => $this->getId() . '_remove']);
        }
        return $tools ? Html::tag('div', $tools, ['class' => 'card-tools']) : '';
    }
    
    protected function renderFooter(): string
    {
        return $this->footer
            ? Html::tag('div', $this->footer, ['class' => 'card-footer'])
            : '';
    }
    
    protected function registerJs()
    {
        if ($this->refreshEnabled && $this->refreshAction) {
            $this->registerJsRefresh();
        }
        if ($this->collapseEnabled && $this->collapseRemember) {
            $this->registerJsCollapse();
        }
    }
    
    private function registerJsRefresh()
    {
    }
    
    private function registerJsCollapse()
    {
    }
}
