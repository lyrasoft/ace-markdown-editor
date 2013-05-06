<?php
/**
 * @package     Windwalker.Framework
 * @subpackage  Helpers
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */


// No direct access
defined('_JEXEC') or die;

/**
 * A UI helper to generate modal etc.
 *
 * @package     Windwalker.Framework
 * @subpackage  Helpers
 */
class AKHelperUi {    
    
    /**
     * Set a HTML element as modal container.
     * 
     * @param   string  $selector   Modal ID to select element.
     * @param   array   $option     Modal options. 
     */
    public static function modal($selector, $option = array())
    {
        $doc = JFactory::getDocument();
        
        if(JVERSION >= 3) {
            JHtml::_('bootstrap.modal', $selector);
        }else{
            JHtml::_('behavior.modal');
            
            $script =
<<<SCRIPT
            window.addEvent('domready', function(){
                SqueezeBox.assign($$('a#{$selector}_link'), {
                    parse: 'rel',
                    onOpen: function(e) {
                        e.getChildren().show();
                    }
                });
                
                $('{$selector}').hide();
                
            });
SCRIPT;

            $doc->addScriptDeclaration($script);
        }
    }
    
    /**
     * The link to open modal.
     * 
     * @param   string  Modal title.
     * @param   string  Modal select ID.
     * @param   array   modal params.
     *
     * @return  string  Link body text.    
     */
    public static function modalLink($title, $selector, $option = array())
    {
        $tag     = JArrayHelper::getValue($option, 'tag', 'a');
        $id     = isset($option['id']) ? " id=\"{$option['id']}\"" : "id=\"{$selector}_link\"";
        $class     = isset($option['class']) ? " class=\"{$option['class']}\"" : '';
        $onclick = isset($option['onclick']) ? " onclick=\"{$option['onclick']}\"" : '';
        $icon    = JArrayHelper::getValue($option, 'icon', '');
        
        if( JVERSION >= 3 ) {
            $button = "<{$tag} data-toggle=\"modal\" data-target=\"#$selector\"{$id}{$class}{$onclick}>
                    <i class=\"{$icon}\" title=\"$title\"></i>
                    $title</{$tag}>" ;
        }
        else
        {
            $rel    = JArrayHelper::getValue($option, 'rel');
            $rel    = $rel ? " rel=\"{$rel}\"" : '';
            $button = "<a href=\"#{$selector}\"{$id}{$class}{$onclick}{$rel}>{$title}</a>" ;
        }
        
        return $button;
    }
}

