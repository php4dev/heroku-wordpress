/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?e(require("jquery")):e(jQuery)}(function(p){var o=/\+/g;function s(e){return x.raw?e:encodeURIComponent(e)}function m(e,n){e=x.raw?e:function(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(o," ")),x.json?JSON.parse(e):e}catch(n){}}(e);return p.isFunction(n)?n(e):e}var x=p.cookie=function(e,n,o){var i,r;if(n!==undefined&&!p.isFunction(n))return"number"==typeof(o=p.extend({},x.defaults,o)).expires&&(r=o.expires,(i=o.expires=new Date).setTime(+i+864e5*r)),document.cookie=[s(e),"=",(r=n,s(x.json?JSON.stringify(r):String(r))),o.expires?"; expires="+o.expires.toUTCString():"",o.path?"; path="+o.path:"",o.domain?"; domain="+o.domain:"",o.secure?"; secure":""].join("");for(var t=e?undefined:{},c=document.cookie?document.cookie.split("; "):[],u=0,d=c.length;u<d;u++){var f=c[u].split("="),a=(a=f.shift(),x.raw?a:decodeURIComponent(a)),f=f.join("=");if(e&&e===a){t=m(f,n);break}e||(f=m(f))===undefined||(t[a]=f)}return t};x.defaults={},p.removeCookie=function(e,n){return p.cookie(e)!==undefined&&(p.cookie(e,"",p.extend({},n,{expires:-1})),!p.cookie(e))}});