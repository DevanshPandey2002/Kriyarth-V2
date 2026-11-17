<?php
if(!defined('ABSPATH'))exit;
define('KR_VER','2.0.0');
require_once get_template_directory().'/inc/art.php';
require_once get_template_directory().'/inc/data.php';

add_action('after_setup_theme',function(){
 add_theme_support('title-tag');
 add_theme_support('post-thumbnails');
 add_theme_support('html5',['search-form','gallery','caption','style','script']);
 add_theme_support('custom-logo',['height'=>60,'width'=>200,'flex-width'=>true,'flex-height'=>true]);
 add_theme_support('align-wide');
 add_theme_support('responsive-embeds');
 register_nav_menus(['primary'=>'Primary menu']);
});

add_action('wp_enqueue_scripts',function(){
 wp_enqueue_style('kr-fonts','https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Kalam:wght@400;700&family=Outfit:wght@200;300;400;500;600&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap',[],null);
 wp_enqueue_style('kr-style',get_stylesheet_uri(),[],KR_VER);
 wp_enqueue_script('kr-main',get_template_directory_uri().'/assets/js/main.js',[],KR_VER,true);
});

add_filter('wp_resource_hints',function($u,$rel){
 if($rel==='preconnect'){$u[]='https://fonts.googleapis.com';$u[]=['href'=>'https://fonts.gstatic.com','crossorigin'];}
 return $u;
},10,2);

/* Customizer: contact details, socials, footer tagline, field-notes photos */
add_action('customize_register',function($c){
 $c->add_section('kr',['title'=>'Kriyarth details','priority'=>30]);
 $f=['kr_email'=>'Contact email (forms are sent here)','kr_instagram'=>'Instagram URL','kr_linkedin'=>'LinkedIn URL','kr_youtube'=>'YouTube URL','kr_x'=>'X / Twitter URL','kr_whatsapp'=>'WhatsApp link (https://wa.me/91...)','kr_tagline'=>'Big footer tagline'];
 foreach($f as $k=>$l){
  $san=$k==='kr_email'?'sanitize_email':($k==='kr_tagline'?'sanitize_text_field':'esc_url_raw');
  $c->add_setting($k,['default'=>$k==='kr_tagline'?'Ideas into impact.':'','sanitize_callback'=>$san]);
  $c->add_control($k,['label'=>$l,'section'=>'kr','type'=>'text']);
 }
 for($i=1;$i<=8;$i++){
  $c->add_setting("kr_tile_$i",['sanitize_callback'=>'esc_url_raw']);
  $c->add_control(new WP_Customize_Image_Control($c,"kr_tile_$i",['label'=>"Field notes photo $i",'section'=>'kr']));
 }
});

/* Contact + newsletter handler (sends an email to the address above, or the admin email) */
add_action('admin_post_nopriv_kr_form','kr_form');
add_action('admin_post_kr_form','kr_form');
function kr_form(){
 $back=wp_get_referer()?:home_url('/');
 $back=remove_query_arg('kr',$back);
 $bad=!isset($_POST['_n'])||!wp_verify_nonce($_POST['_n'],'kr_form')||!empty($_POST['website']);
 $email=sanitize_email(wp_unslash($_POST['email']??''));
 if($bad||!is_email($email)){wp_safe_redirect(add_query_arg('kr','err',$back));exit;}
 $sub=(($_POST['type']??'')==='sub');
 $name=sanitize_text_field(wp_unslash($_POST['name']??''));
 $msg=sanitize_textarea_field(wp_unslash($_POST['message']??''));
 $to=get_theme_mod('kr_email')?:get_option('admin_email');
 $subject='[Kriyarth] '.($sub?'New subscriber':'New message from '.($name?:$email));
 $ok=wp_mail($to,$subject,"Name: $name\nEmail: $email\n\n$msg",['Reply-To: '.$email]);
 wp_safe_redirect(add_query_arg('kr',$ok?'ok':'err',$back));exit;
}
