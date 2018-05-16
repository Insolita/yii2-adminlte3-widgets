<?php

namespace insolita\adminlte3;

use function strtr;
use yii\base\InvalidConfigException;
use yii\bootstrap4\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class LteSideBar extends Nav
{
    /**
     * @example
     * [
     *     'label' => 'Home',
     *     'url' => ['site/index'],
     *     'icon' =>'fa fa-icon',
     *     'badge' => '<span class="right badge badge-danger">New</span>',
     *     'linkOptions' => [...],
     *  ],
     **/
    public $items = [];
    
    public $activateItems = true;
    
    public $activateParents = true;
    
    public $brandEnabled = true;
    
    public $brand = ['image' => '', 'link' => '#', 'text' => ''];
    
    public $brandTemplate
        = <<<HTML
<a href="{link}" class="brand-link">
  <img src="{image}"
       alt="{text}"
       class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">{text}</span>
</a>
HTML;
    
    public $userEnabled = false;
    
    public $user = ['image' => '', 'link' => '#', 'text' => ''];
    
    public $userTemplate
        = <<<HTML
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{image}" class="img-circle elevation-2" alt="{text}">
    </div>
    <div class="info">
      <a href="{link}" class="d-block">{text}</a>
    </div>
</div>
HTML;
    
    public $dropDownCaret = '<i class="right fa fa-angle-left"></i>';
    
    public $containerOptions = ['class' => 'main-sidebar sidebar-dark-primary elevation-4'];
    
    public $dropDownOptions = ['class' => 'nav nav-treeview'];
    
    public $options
        = [
            'class' => 'nav nav-pills nav-sidebar flex-column',
            'data-widget' => 'treeview',
            'data-accordion' => 'false',
            'role' => 'menu',
        ];
    
    public $template
        = <<<HTML
<aside {containerOptions}>
{brand}
<div class="sidebar">
{user}
<nav class="mt-2">{menu}</nav>
</div>
</aside>
HTML;
    
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $menu = parent::run();
        $brand = $this->brandEnabled ? $this->renderBrand() : '<a href="#" class="brand-link"></a>';
        $user = $this->userEnabled ? $this->renderUser() : '';
        return strtr($this->template, [
            '{brand}' => $brand,
            '{user}' => $user,
            '{menu}' => $menu,
            '{containerOptions}' => Html::renderTagAttributes($this->containerOptions),
        ]);
    }
    
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = $item['options'] ?? [];
        $iconClass = $item['icon'] ?? '';
        $icon = Html::tag('i', '', ['class' => 'nav-icon ' . $iconClass]);
        $label = Lte::append($item['badge'] ?? '', $label);
        $items = $item['items'] ?? [];
        $url = $item['url'] ?? '#';
        $linkOptions = $item['linkOptions'] ?? [];
        
        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }
        $hasActiveChild = false;
        if (empty($items)) {
            $items = '';
        } else {
            //$linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, 'has-treeview');
            if (is_array($items)) {
                
                $items = $this->isChildActive($items, $hasActiveChild);
                $items = $this->renderSubItems($items);
            }
            $label = Lte::append($this->dropDownCaret, $label);
        }
        
        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');
        
        if ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, 'active');
        }
        if ($this->activateParents && $hasActiveChild) {
            Html::addCssClass($options, 'menu-open');
        }
        $label = Lte::prepend($icon, Html::tag('p', $label));
        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
    
    public function renderSubItems(iterable $items)
    {
        $renderedItems = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $renderedItems[] = $this->renderItem($item);
        }
        
        return Html::tag('ul', implode("\n", $renderedItems), $this->dropDownOptions);
    }
    
    protected function renderBrand()
    {
        return strtr($this->brandTemplate, [
            '{link}' => $this->brand['link'] ?? '#',
            '{image}' => $this->brand['image'] ?? '',
            '{text}' => $this->brand['text'] ?? '',
        ]);
    }
    
    protected function renderUser()
    {
        return strtr($this->userTemplate, [
            '{link}' => $this->user['link'] ?? '#',
            '{image}' => $this->user['image'] ?? '',
            '{text}' => $this->user['text'] ?? '',
        ]);
    }
    
    /**
     * Check to see if a child item is active optionally activating the parent.
     *
     * @param array $items  @see items
     * @param bool  $active should the parent be active too
     *
     * @return array @see items
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            $childItems = ArrayHelper::getValue($child, 'items');
            if (is_array($childItems)) {
                $activeParent = false;
                $items[$i]['items'] = $this->isChildActive($childItems, $activeParent);
                if ($activeParent) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }
}
