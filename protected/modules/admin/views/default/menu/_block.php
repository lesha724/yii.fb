<?php

/**
 * @var $settings array
 * @var $blocks array
 */
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

    $label = '';
    switch ($type){
        case MENU_ELEMENT_VISIBLE:
            $label = tt('Активный');
            break;
        case MENU_ELEMENT_NEED_AUTH:
            $label = tt('Доступен без авторизации');
            break;
        case MENU_ELEMENT_AUTH_STUDENT:
            $label = tt('Доступен студентам');
            break;
        case MENU_ELEMENT_AUTH_TEACHER:
            $label = tt('Доступен преподователям');
            break;
        case MENU_ELEMENT_AUTH_PARENT:
            $label = tt('Доступен родителям');
            break;
        default:
            $label = '';
            break;
    }

    $name = $controller.'['.$action.']['.$type.']';
    return <<<HTML
        <label class="checkbox">
            <input type="hidden" name="{$name}" value="{$val}"/>
            <input type="checkbox" class="type-{$type}" {$checked}/>{$label}
        </label>
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
                <?php foreach ($items as $action => $value): ?>
                    <li class="dd-item" >
                        <div class="dd-handle">
                            <?php
                                if(!is_array($value)) {
                                    echo '<div>' . tt($value) . '</div>';
                                    echo checkbox($controller, $action, MENU_ELEMENT_VISIBLE);
                                    echo checkbox($controller, $action, MENU_ELEMENT_NEED_AUTH);

                                    echo '<div class="block-auth-role">';
                                    echo checkbox($controller, $action, MENU_ELEMENT_AUTH_STUDENT);
                                    echo checkbox($controller, $action, MENU_ELEMENT_AUTH_TEACHER);
                                    echo checkbox($controller, $action, MENU_ELEMENT_AUTH_PARENT);
                                    echo '</div>';

                                }else{
                                    $nameAction = $value['name'];
                                    $authOnly = $value['authOnly'];
                                    echo checkbox($controller, $action, MENU_ELEMENT_VISIBLE);
                                    echo '<div>'.tt('Доступен для:').'</div>';
                                    echo '<ul>';
                                    if(is_array($authOnly)) {
                                        foreach ($authOnly as $auth) {
                                            echo '<li>' . $auth . '</li>';
                                        }
                                    }else
                                        echo '<li>' . $authOnly . '</li>';
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</div>
<?php
endforeach;

$type = MENU_ELEMENT_NEED_AUTH;
try {
    Yii::app()->clientScript->registerScript('menu-admin-edit', <<<JS
    
        function setVisibleBlockAuthRole(elem){
                var parent = elem.closest('.dd-handle');
                var block = parent.find('.block-auth-role');
                if(jQuery.isEmptyObject(block))
                    return;
                
                if ( elem.is( ':checked' ) )
                {
                    block.hide();
                }else{
                    block.show();
                }
        }
        
        $(document).ready(function() {
            var list = $('.type-{$type}');
            list.each(function() {
                setVisibleBlockAuthRole($(this));
            });
        });

        $('.type-{$type}').change(function() {
            setVisibleBlockAuthRole($(this));
        });
JS
    );
} catch (CException $e) {
    throw $e;
}