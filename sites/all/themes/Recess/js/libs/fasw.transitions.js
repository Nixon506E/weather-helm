function ft(params){var ol=document.addEventListener?"DOMContentLoaded":"load";var navB=params.navB||"";var but=params.but||false;var cBa=params.cBa||function(){};function aDL(url,t,o){if(window.XMLHttpRequest){r=new XMLHttpRequest()}else if(window.ActiveXObject){r=new ActiveXObject("Microsoft.XMLHTTP")}if(r!=undefined){r.onreadystatechange=function(){Ol(r,t,o)};r.open("GET",url,true);r.send("")}}function Ol(r,t,o){if(r.readyState==4){if(r.status==200||r.status==0){t.innerHTML=r.responseText;o()}else{t.innerHTML="Error:\n"+r.status+"\n"+r.statusText}}}function DE(){var dochtml=document.body.innerHTML;document.body.innerHTML="";var d1=document.createElement("div");d1.id="d1";d1.style.zIndex=2;d1.style.position="absolute";d1.style.width="100%";d1.style.height="100%";d1.style.left="0px";d1.style.top="0px";document.body.appendChild(d1);d1.innerHTML=dochtml;var d2=document.createElement("div");d2.id="d2";d2.style.zIndex=1;d2.style.position="absolute";d2.style.width="100%";d2.style.height="100%";d2.style.left="0px";d2.style.top="0px";document.body.appendChild(d2);return{d1:d1,d2:d2}}function timeOuts(e,d1,d2){setTimeout(function(){d1.className=e+" out"},1);setTimeout(function(){d2.className=e+" in"},1);setTimeout(function(){document.body.innerHTML=d2.innerHTML;cBa()},706)}function slideTo(href,effect,pushstate){var d=DE();var d1=d.d1;var d2=d.d2;aDL(href,d2,function(){if(pushstate&&window.history.pushState)window.history.pushState("","",href);timeOuts(effect,d1,d2)})}function dC(e){var o;var o=e.srcElement||e.target;var tn=o.tagName.toLowerCase();if(!but||tn!="input"||o.getAttribute("type")!="button"){while(tn!=="a"&&tn!=="body"){o=o.parentNode;tn=o.tagName.toLowerCase()}if(tn==="body")return}var t=o.getAttribute("data-ftrans");if(t){e.preventDefault();var hr=o.getAttribute("href")||o.getAttribute("data-href");if(hr)slideTo(hr,t,true)}}function aE(ev,el,f){if(el.addEventListener)el.addEventListener(ev,f,false);else if(el.attachEvent){var r=el.attachEvent("on"+ev,f);return r}}aE("click",window,dC);aE(ol,document,function(ev){aE("popstate",window,function(e){slideTo(location.pathname,navB,false)})})}