<?php
global $menu;
$menu = $settings;

function checkbox($controller, $action, $type)
{
    global $menu;

    $controller = mb_strtolower($controller);
    $action     = mb_strtolower($action);

    parse_str(urldecode($menu), $output);

    $val = isset($output[$controller][$action][$type])
                ? $output[$controller][$action][$type]
                : 1;

    $checked = $val ? "checked='checked'" : '';

    $tooltip = '';
    if ($type == MENU_ELEMENT_VISIBLE)
        $tooltip = tt('Скрыть пункт меню');
    elseif ($type == MENU_ELEMENT_NEED_AUTH)
        $tooltip = 'Доступен без авторизации';

    $name = $controller.'['.$action.']['.$type.']';
    return <<<HTML
        <span>
            <input type="hidden" name="{$name}" value="{$val}"/>
            <input type="checkbox" {$checked} data-rel="tooltip" data-placement="top" data-original-title="{$tooltip}" />
        </span>
HTML;

}

function checkbox2($controller, $type)
{
    global $menu;

    $controller = mb_strtolower($controller);
    $action     = 'main';

    parse_str(urldecode($menu), $output);

    $val = isset($output[$controller][$action][$type])
                ? $output[$controller][$action][$type]
                : 1;

    $checked = $val ? "checked='checked'" : '';

    $name = $controller.'['.$action.']['.$type.']';
    return <<<HTML
            <label>
                <input type="checkbox" class="ace ace-switch ace-switch-3" {$checked} />
                <span class="lbl"></span>
                <input type="hidden" name="{$name}" value="{$val}" />
            </label>
HTML;

}

foreach ($blocks as $block) :

    $name       = $block['name'];
    $controller = $block['controller'];
    $items      = $block['items'];

?>
<div class="span3 widget-box collapsed" style="margin: 10px 10px 0 0">
    <div class="widget-header">
        <h5><?=tt($name)?></h5>

        <div class="widget-toolbar">
            <a data-action="collapse" href="#">
                <i class="icon-chevron-down"></i>
            </a>
        </div>
        <div class="widget-toolbar no-border">
            <?=checkbox2($controller, MENU_ELEMENT_VISIBLE)?>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <ol class="dd-list">
                <?php foreach ($items as $action => $name): ?>
                    <li class="dd-item" >
                        <div class="dd-handle">
                            <?=checkbox($controller, $action, MENU_ELEMENT_VISIBLE)?>
                            <?=checkbox($controller, $action, MENU_ELEMENT_NEED_AUTH)?>
                            <?=tt($name)?></div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</div>
<?php
endforeach;