<?php
if(!defined('ABSPATH'))exit;
/* Line artwork used for hero, cards, tiles and polaroids. Colour comes from CSS (currentColor). */
function kr_art($t,$fit='slice'){
 static $a=null;
 if(!$a)$a=[
 'river'=>'<path d="M-10 40C40 10 60 70 110 50S170 20 210 60"/><path d="M-10 70C40 40 60 100 110 80S170 50 210 90"/><path d="M-10 100C40 70 60 130 110 110S170 80 210 120"/><path d="M-10 140C50 120 80 170 130 150S180 130 210 160"/><circle cx="110" cy="80" r="3"/>',
 'pipes'=>'<path d="M20 160H80V100H140V50H180"/><path d="M80 160H150V130"/><path d="M140 100H185"/><circle cx="20" cy="160" r="6"/><circle cx="80" cy="100" r="4"/><circle cx="140" cy="100" r="4"/><circle cx="180" cy="50" r="6"/><circle cx="150" cy="130" r="4"/><rect x="60" y="20" width="40" height="26" rx="3"/><path d="M80 46V100M70 20l10-10 10 10"/>',
 'contour'=>'<path d="M100 20c40 0 75 30 75 75s-35 85-80 85-70-35-70-80 35-80 75-80z"/><path d="M100 45c28 0 52 22 52 52s-25 62-57 62-50-26-50-58 25-56 55-56z"/><path d="M100 70c17 0 32 14 32 32s-15 38-35 38-30-16-30-36 15-34 33-34z"/><path d="M100 92c8 0 14 6 14 14s-8 16-16 16-12-8-12-15 6-15 14-15z"/>',
 'grid'=>'<rect x="25" y="25" width="150" height="150" rx="4"/><rect x="60" y="60" width="80" height="80"/><rect x="88" y="88" width="24" height="24"/><path d="M25 25l35 35M175 25l-35 35M25 175l35-35M175 175l-35-35"/>',
 'compass'=>'<circle cx="100" cy="100" r="62"/><circle cx="100" cy="100" r="36"/><circle cx="100" cy="100" r="8"/><path d="M100 10v40M100 150v40M10 100h40M150 100h40M36 36l28 28M164 36l-28 28M36 164l28-28M164 164l-28-28"/>',
 'spiral'=>'<path d="M20 60c40-10 70 10 90 40s50 50 80 40"/><path d="M20 100c30-4 52 10 64 30"/><circle cx="60" cy="140" r="22"/><circle cx="60" cy="140" r="10"/><circle cx="150" cy="60" r="24"/><circle cx="150" cy="60" r="11"/>',
 ];
 if(!isset($a[$t]))$t='river';
 return '<svg class="kr-art" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" preserveAspectRatio="xMidYMid '.$fit.'" aria-hidden="true">'.$a[$t].'</svg>';
}

function kr_icon($n){
 static $i=null;
 if(!$i)$i=[
 'search'=>'<circle cx="11" cy="11" r="7"/><path d="M16.5 16.5L21 21"/>',
 'mail'=>'<rect x="3" y="5" width="18" height="14" rx="3"/><path d="M4 7l8 6 8-6"/>',
 'arrow'=>'<path d="M5 12h14M13 6l6 6-6 6"/>',
 'arrow-ur'=>'<path d="M7 17L17 7M8 7h9v9"/>',
 'chev-l'=>'<path d="M15 5l-7 7 7 7"/>',
 'chev-r'=>'<path d="M9 5l7 7-7 7"/>',
 'instagram'=>'<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/>',
 'linkedin'=>'<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 11v6M8 7.5v.01M12 17v-6M12 13c0-2 4-2.5 4 0v4"/>',
 'youtube'=>'<rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="M10 9.5v5l4.5-2.5z"/>',
 'x'=>'<path d="M5 4l14 16M19 4L5 20"/>',
 'whatsapp'=>'<path d="M4 20l1.3-4.2A8 8 0 1 1 8.3 18.8z"/><path d="M9 9c0 3 3 6 6 6l1-1.5-2-1-1 .8c-1-.4-2-1.4-2.4-2.4l.8-1-1-2z"/>',
 ];
 return isset($i[$n])?'<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$i[$n].'</svg>':'';
}

function kr_url($s){
 if($s==='work')return get_post_type_archive_link('kr_project')?:home_url('/work/');
 $p=get_page_by_path($s);
 return $p?get_permalink($p):home_url('/'.$s.'/');
}

function kr_fallback_menu(){
 $w=kr_url('work');
 echo '<ul class="kr-menu"><li class="menu-item-has-children"><a href="'.esc_url($w).'">Work</a><ul class="sub-menu">';
 foreach(kr_projects() as $p)echo '<li><a href="'.esc_url($p['url']).'">'.esc_html($p['title']).'</a></li>';
 echo '</ul></li><li class="menu-item-has-children"><a href="'.esc_url($w).'">Areas</a><ul class="sub-menu">';
 foreach(KR_AREAS as $s=>$n)echo '<li><a href="'.esc_url(add_query_arg('area',$s,$w)).'">'.esc_html($n).'</a></li>';
 echo '</ul></li><li class="is-rust"><a href="'.esc_url(home_url('/#diary')).'">Field Diary</a></li>';
 echo '<li class="is-leaf"><a href="'.esc_url(home_url('/#notes')).'">Field Notes</a></li>';
 echo '<li><a href="'.esc_url(kr_url('about')).'">About</a></li></ul>';
}
