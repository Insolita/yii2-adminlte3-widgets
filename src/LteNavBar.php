<?php

namespace insolita\adminlte3;

use Yii;
use yii\bootstrap4\Nav;
use yii\bootstrap4\Widget;
use yii\helpers\Html;
use function array_push;
use function array_unshift;
use function strtr;

class LteNavBar extends Widget
{
    /**
     * add button for toggle left sidebar
     *
     * @var bool
     */
    public $toggleSidebar = true;
    
    /**
     * add button for toggle control sidebar
     *
     * @var bool
     */
    public $controlSidebar = false;
    
    /**
     * navbar background; support info,success,danger, primary, secondary, light, dark and *-gradient
     *
     * @var bool
     */
    public $bgColor = Lte::GRADIENT_INFO;
    
    /**
     * add navbar-light or navbar-dark color-scheme
     *
     * @var bool
     */
    public $isDark = false;
    
    public $options = ['class' => 'main-header navbar navbar-expand border-bottom'];
    
    public $leftItems = [];
    
    public $rightItems = [];
    
    public $enableSearch = false;
    
    public $searchAction = '';
    
    public $searchTemplate
        = <<<HTML
<form class="form-inline ml-3" action="{action}">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="{Search}" aria-label="{Search}">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
HTML;
    
    /**
     * Class for rendering $rightItems and $leftItems
     **/
    public $navWidgetClass = Nav::class;
    
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, Lte::prepend('bg-', $this->bgColor));
        Html::addCssClass($this->options, $this->isDark ? 'navbar-dark' : 'navbar-light');
        if ($this->toggleSidebar) {
            array_unshift($this->leftItems, '<li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>');
        }
        if ($this->controlSidebar) {
            array_push($this->rightItems, '<li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
        </li>');
        }
    }
    
    public function run()
    {
        $leftMenu = $this->renderLeftItems();
        $rightMenu = $this->renderRightItems();
        $search = $this->enableSearch ? $this->renderSearchForm() : '';
        return Html::tag('nav', $leftMenu . $search . $rightMenu, $this->options);
    }
    
    protected function renderSearchForm():string
    {
        return strtr($this->searchTemplate, [
            '{action}' => $this->searchAction,
            '{Search}' => Yii::t('app', 'Search'),
        ]);
    }
    
    protected function renderLeftItems():string
    {
        $widgetClass = $this->navWidgetClass;
        return $widgetClass::widget([
            'items' => $this->leftItems,
            'activateItems' => true,
            'options' => ['class' => 'navbar-nav'],
        ]);
    }
    
    protected function renderRightItems():string
    {
        $widgetClass = $this->navWidgetClass;
        return $widgetClass::widget([
            'items' => $this->rightItems,
            'activateItems' => true,
            'options' => ['class' => 'navbar-nav ml-auto'],
        ]);
    }
}
