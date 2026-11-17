<?php
if(!defined('ABSPATH'))exit;
const KR_STATUS=['Personal project','Professional context','Research direction','Concept / experiment'];
const KR_ARTS=['river'=>'River (blue)','pipes'=>'Pipes (green)','contour'=>'Contour (clay)','grid'=>'Grid (ink)'];
const KR_AREAS=['gis-spatial'=>'GIS & spatial','water-systems'=>'Water systems','environment'=>'Environment','digital-systems'=>'Digital systems'];

add_action('init',function(){
 register_post_type('kr_project',['labels'=>['name'=>'Projects','singular_name'=>'Project','add_new_item'=>'Add project','edit_item'=>'Edit project'],'public'=>true,'has_archive'=>'work','rewrite'=>['slug'=>'work'],'menu_icon'=>'dashicons-location-alt','supports'=>['title','editor','excerpt','thumbnail','page-attributes'],'show_in_rest'=>true]);
 register_taxonomy('kr_area','kr_project',['labels'=>['name'=>'Areas','singular_name'=>'Area'],'hierarchical'=>true,'public'=>true,'rewrite'=>['slug'=>'area'],'show_in_rest'=>true,'show_admin_column'=>true]);
});

add_action('add_meta_boxes',function(){add_meta_box('kr_meta','Project details','kr_meta_box','kr_project','side');});
function kr_meta_box($post){
 wp_nonce_field('kr_meta','kr_meta_n');
 $s=get_post_meta($post->ID,'_kr_status',true);$a=get_post_meta($post->ID,'_kr_art',true);
 echo '<p><label>Status<br><select name="kr_status" style="width:100%">';
 foreach(KR_STATUS as $o)printf('<option value="%1$s"%2$s>%1$s</option>',esc_attr($o),selected($s,$o,false));
 echo '</select></label></p>';
 echo '<p><label>Year<br><input name="kr_year" style="width:100%" value="'.esc_attr(get_post_meta($post->ID,'_kr_year',true)).'"></label></p>';
 echo '<p><label>Tools (comma separated)<br><input name="kr_tools" style="width:100%" value="'.esc_attr(get_post_meta($post->ID,'_kr_tools',true)).'"></label></p>';
 echo '<p><label>Artwork (used when there is no featured image)<br><select name="kr_art" style="width:100%">';
 foreach(KR_ARTS as $k=>$v)printf('<option value="%s"%s>%s</option>',esc_attr($k),selected($a,$k,false),esc_html($v));
 echo '</select></label></p>';
}
add_action('save_post_kr_project',function($id){
 if(!isset($_POST['kr_meta_n'])||!wp_verify_nonce($_POST['kr_meta_n'],'kr_meta'))return;
 if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;
 if(!current_user_can('edit_post',$id))return;
 $s=sanitize_text_field(wp_unslash($_POST['kr_status']??''));
 update_post_meta($id,'_kr_status',in_array($s,KR_STATUS,true)?$s:KR_STATUS[0]);
 update_post_meta($id,'_kr_year',sanitize_text_field(wp_unslash($_POST['kr_year']??'')));
 update_post_meta($id,'_kr_tools',sanitize_text_field(wp_unslash($_POST['kr_tools']??'')));
 $a=sanitize_key($_POST['kr_art']??'');
 update_post_meta($id,'_kr_art',isset(KR_ARTS[$a])?$a:'river');
});

function kr_project($p){
 $p=get_post($p);
 $t=get_the_terms($p->ID,'kr_area');
 $has=($t&&!is_wp_error($t));
 return[
  'id'=>$p->ID,'title'=>get_the_title($p),'url'=>get_permalink($p),
  'status'=>get_post_meta($p->ID,'_kr_status',true)?:KR_STATUS[0],
  'year'=>get_post_meta($p->ID,'_kr_year',true),
  'tools'=>array_values(array_filter(array_map('trim',explode(',',(string)get_post_meta($p->ID,'_kr_tools',true))))),
  'art'=>get_post_meta($p->ID,'_kr_art',true)?:'river',
  'area'=>$has?$t[0]->name:'','area_slug'=>$has?$t[0]->slug:'',
  'blurb'=>get_the_excerpt($p),'thumb'=>get_the_post_thumbnail_url($p,'large'),
 ];
}
function kr_projects($n=-1,$exclude=0){
 $q=get_posts(['post_type'=>'kr_project','numberposts'=>$n,'orderby'=>['menu_order'=>'ASC','date'=>'DESC'],'post__not_in'=>$exclude?[$exclude]:[]]);
 return array_map('kr_project',$q);
}

/* Starter content created once when the theme is activated: areas, 4 projects, Home/About/Contact pages */
function kr_defaults(){return[
 ['River Intelligence','Personal project','river','gis-spatial','An exploration of river systems, encroachment, and spatial evidence through interactive mapping and geographic analysis.','QGIS, Spatial analysis, Data visualisation'],
 ['Water Infrastructure','Professional context','pipes','water-systems','Lessons from water-supply schemes, pipeline networks, quantity estimation, and documentation in civil engineering work.','AutoCAD, Microsoft Excel, Quantity estimation, Technical documentation'],
 ['Landscape & Change','Research direction','contour','environment','A research direction for studying vegetation, habitation, watersheds, and the changing relationship between people and landscapes.','QGIS, Spatial analysis'],
 ['Project OS','Concept / experiment','grid','digital-systems','A concept for bringing project information, workflows, and operational clarity into one thoughtfully structured digital experience.','Workflows, Web'],
];}
add_action('after_switch_theme','kr_seed');
function kr_seed(){
 if(get_option('kr_seeded'))return;
 foreach(KR_AREAS as $s=>$n)if(!term_exists($s,'kr_area'))wp_insert_term($n,'kr_area',['slug'=>$s]);
 if(!get_posts(['post_type'=>'kr_project','numberposts'=>1])){
  foreach(kr_defaults() as $i=>$d){
   $body="<!-- wp:paragraph -->\n<p>".$d[4]."</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Replace this with the project story: the question, the evidence, the method, and what changed.</p>\n<!-- /wp:paragraph -->";
   $id=wp_insert_post(['post_type'=>'kr_project','post_status'=>'publish','post_title'=>$d[0],'post_excerpt'=>$d[4],'post_content'=>$body,'menu_order'=>$i]);
   if($id&&!is_wp_error($id)){
    wp_set_object_terms($id,$d[3],'kr_area');
    update_post_meta($id,'_kr_status',$d[1]);update_post_meta($id,'_kr_art',$d[2]);update_post_meta($id,'_kr_tools',$d[5]);
   }
  }
 }
 foreach(['about'=>['About','template-about.php'],'contact'=>['Contact','template-contact.php']] as $slug=>$pg){
  if(!get_page_by_path($slug)){
   $id=wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>$pg[0],'post_name'=>$slug]);
   if($id&&!is_wp_error($id))update_post_meta($id,'_wp_page_template',$pg[1]);
  }
 }
 if(get_option('show_on_front')!=='page'){
  $h=wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>'Home','post_name'=>'home']);
  if($h&&!is_wp_error($h)){update_option('show_on_front','page');update_option('page_on_front',$h);}
 }
 flush_rewrite_rules();
 update_option('kr_seeded',1);
}
