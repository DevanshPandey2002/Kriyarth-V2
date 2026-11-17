(function(){
 'use strict';
 var $=function(s,c){return(c||document).querySelector(s)},$$=function(s,c){return[].slice.call((c||document).querySelectorAll(s))};
 var h=$('#kr-header');
 if(!h)return;
 var solid=function(){h.classList.toggle('is-solid',window.scrollY>40)};
 solid();addEventListener('scroll',solid,{passive:true});

 var burger=$('[data-burger]'),sb=$('[data-search]'),sp=$('#kr-search');
 burger.addEventListener('click',function(){var o=h.classList.toggle('is-open');burger.setAttribute('aria-expanded',o)});
 sb.addEventListener('click',function(){var open=sp.hidden;sp.hidden=!open;sb.setAttribute('aria-expanded',open);if(open){var i=$('input[type=search]',sp);if(i)i.focus()}});
 document.addEventListener('keydown',function(e){if(e.key==='Escape'){sp.hidden=true;sb.setAttribute('aria-expanded','false');h.classList.remove('is-open')}});

 /* hero slider */
 var hero=$('[data-hero]');
 if(hero){
  var slides=$$('.kr-slide',hero),dots=$('.kr-hero__dots',hero),i=0,t=null;
  var go=function(n,user){
   i=(n+slides.length)%slides.length;
   slides.forEach(function(s,k){s.classList.toggle('is-active',k===i);s.setAttribute('aria-hidden',k!==i)});
   $$('button',dots).forEach(function(b,k){b.setAttribute('aria-current',k===i)});
   if(user)restart();
  };
  var restart=function(){clearInterval(t);if(!matchMedia('(prefers-reduced-motion: reduce)').matches)t=setInterval(function(){go(i+1)},7000)};
  slides.forEach(function(_,n){var b=document.createElement('button');b.type='button';b.setAttribute('aria-label','Go to slide '+(n+1));b.addEventListener('click',function(){go(n,true)});dots.appendChild(b)});
  $('[data-prev]',hero).addEventListener('click',function(){go(i-1,true)});
  $('[data-next]',hero).addEventListener('click',function(){go(i+1,true)});
  hero.addEventListener('mouseenter',function(){clearInterval(t)});
  hero.addEventListener('mouseleave',restart);
  go(0);restart();
 }

 /* project rails */
 $$('.kr-rail-wrap').forEach(function(w){
  var r=$('.kr-rail',w);
  $$('[data-rail]',w).forEach(function(b){b.addEventListener('click',function(){
   var c=$('.kr-card',r);r.scrollBy({left:(+b.dataset.rail)*(c?c.offsetWidth+20:300),behavior:'smooth'});
  })});
 });

 /* work filter (supports ?area=slug) */
 var f=$('[data-filter]');
 if(f){
  var btns=$$('button',f),cards=$$('.kr-grid .kr-card');
  var set=function(a){btns.forEach(function(b){b.classList.toggle('is-on',b.dataset.f===a)});cards.forEach(function(c){c.hidden=!(a==='all'||c.dataset.area===a)})};
  btns.forEach(function(b){b.addEventListener('click',function(){set(b.dataset.f)})});
  var q=new URLSearchParams(location.search).get('area');
  set(q&&btns.some(function(b){return b.dataset.f===q})?q:'all');
 }

 /* reading progress on project pages */
 var pr=$('.kr-progress');
 if(pr){var upd=function(){var d=document.documentElement,m=d.scrollHeight-innerHeight;pr.style.transform='scaleX('+(m>0?Math.min(1,scrollY/m):0)+')'};upd();addEventListener('scroll',upd,{passive:true})}
})();
