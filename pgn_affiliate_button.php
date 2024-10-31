<?php
/*
Plugin Name: Pigeon Affiliate Button
Plugin URI:  https://www.pigeon-soft.com/
Description: WordPress Plugin for creating affiliate link with image
Version:     1.0.0
Author:      Ariful Islam
Author URI:  https://ariful.net/
Text Domain: pgn_affiliate_button
Domain Path: /languages
License: GPLv2 or later

*/

function pgn_affiliate_lead_textdomain(){
    load_plugin_textdomain('pgn_affiliate_button',false, dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','pgn_affiliate_lead_textdomain');

function pgn_assets(){
    wp_enqueue_style('pgn-style',plugin_dir_url(__FILE__)."/css/style.css",null,'1.0');
}
add_action('wp_enqueue_scripts','pgn_assets');

function pgn_button($arguments){
    $defaults = array(
        'height'=>'250',
        'width'=>'200',
        'url'=>'',
        'style'=>'primary',
        'position'=>'bottom',
        'text'=>'Button',
        'src'=>'',
        'align'=>'right',
        'target'=>'',
        'rel'=>'nofollow'
    );
    $attributes = shortcode_atts($defaults, $arguments);

    $shortcode_output = '';
    if ($attributes['position']=='top'){
        $shortcode_output = <<<EOD
          
             <a href="{$attributes['url']}" rel="{$attributes['rel']}" target="{$attributes['target']}">
           <div style="display: inline; float: {$attributes['align']}">
            <button class="pgn pgn-{$attributes['style']}" style="display: block; width: {$attributes['width']}px">{$attributes['text']}</button>
           <img src="{$attributes['src']}" alt="" width="{$attributes['width']}" height="{$attributes['height']}">
           </div>
       </a>

EOD;
    }
    elseif ($attributes['position']=='bottom'){
        $shortcode_output = <<<EOD

        <a href="{$attributes['url']}" rel="{$attributes['rel']}" target="{$attributes['target']}">
           <div style="display: inline; float: {$attributes['align']}">
            
           <img src="{$attributes['src']}" alt="" width="{$attributes['width']}" height="{$attributes['height']}">
           <button class="pgn pgn-{$attributes['style']}" style="margin-top:-5px; display: block; width: {$attributes['width']}px">{$attributes['text']}</button>
           </div>
       </a>

EOD;
    }
return $shortcode_output;

}
add_shortcode('pgn_button', 'pgn_button');



