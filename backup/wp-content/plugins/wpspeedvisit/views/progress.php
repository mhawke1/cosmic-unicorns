<script>
    /* NProgress, (c) 2013, 2014 Rico Sta. Cruz - http://ricostacruz.com/nprogress
     * @license MIT */
    !function(n,e){"function"==typeof define&&define.amd?define(e):"object"==typeof exports?module.exports=e():n.NProgress=e()}(this,function(){function n(n,e,t){return n<e?e:n>t?t:n}function e(n){return 100*(-1+n)}function t(n,t,r){var i;return i="translate3d"===c.positionUsing?{transform:"translate3d("+e(n)+"%,0,0)"}:"translate"===c.positionUsing?{transform:"translate("+e(n)+"%,0)"}:{"margin-left":e(n)+"%"},i.transition="all "+t+"ms "+r,i}function r(n,e){return("string"==typeof n?n:s(n)).indexOf(" "+e+" ")>=0}function i(n,e){var t=s(n),i=t+e;r(t,e)||(n.className=i.substring(1))}function o(n,e){var t,i=s(n);r(n,e)&&(t=i.replace(" "+e+" "," "),n.className=t.substring(1,t.length-1))}function s(n){return(" "+(n&&n.className||"")+" ").replace(/\s+/gi," ")}function a(n){n&&n.parentNode&&n.parentNode.removeChild(n)}var u={};u.version="0.2.0";var c=u.settings={minimum:.08,easing:"linear",positionUsing:"",speed:200,trickle:!0,trickleSpeed:200,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};u.configure=function(n){var e,t;for(e in n)void 0!==(t=n[e])&&n.hasOwnProperty(e)&&(c[e]=t);return this},u.status=null,u.set=function(e){var r=u.isStarted();e=n(e,c.minimum,1),u.status=1===e?null:e;var i=u.render(!r),o=i.querySelector(c.barSelector),s=c.speed,a=c.easing;return i.offsetWidth,l(function(n){""===c.positionUsing&&(c.positionUsing=u.getPositioningCSS()),f(o,t(e,s,a)),1===e?(f(i,{transition:"none",opacity:1}),i.offsetWidth,setTimeout(function(){f(i,{transition:"all "+s+"ms linear",opacity:0}),setTimeout(function(){u.remove(),n()},s)},s)):setTimeout(n,s)}),this},u.isStarted=function(){return"number"==typeof u.status},u.start=function(){u.status||u.set(0);var n=function(){setTimeout(function(){u.status&&(u.trickle(),n())},c.trickleSpeed)};return c.trickle&&n(),this},u.done=function(n){return n||u.status?u.inc(.3+.5*Math.random()).set(1):this},u.inc=function(e){var t=u.status;return t?t>1?void 0:("number"!=typeof e&&(e=t>=0&&t<.2?.1:t>=.2&&t<.5?.04:t>=.5&&t<.8?.02:t>=.8&&t<.99?.005:0),t=n(t+e,0,.994),u.set(t)):u.start()},u.trickle=function(){return u.inc()},function(){var n=0,e=0;u.promise=function(t){return t&&"resolved"!==t.state()?(0===e&&u.start(),n++,e++,t.always(function(){0===--e?(n=0,u.done()):u.set((n-e)/n)}),this):this}}(),u.render=function(n){if(u.isRendered())return document.getElementById("nprogress");i(document.documentElement,"nprogress-busy");var t=document.createElement("div");t.id="nprogress",t.innerHTML=c.template;var r,o=t.querySelector(c.barSelector),s=n?"-100":e(u.status||0),l=document.querySelector(c.parent);return f(o,{transition:"all 0 linear",transform:"translate3d("+s+"%,0,0)"}),c.showSpinner||(r=t.querySelector(c.spinnerSelector))&&a(r),l!=document.body&&i(l,"nprogress-custom-parent"),l.appendChild(t),t},u.remove=function(){o(document.documentElement,"nprogress-busy"),o(document.querySelector(c.parent),"nprogress-custom-parent");var n=document.getElementById("nprogress");n&&a(n)},u.isRendered=function(){return!!document.getElementById("nprogress")},u.getPositioningCSS=function(){var n=document.body.style,e="WebkitTransform"in n?"Webkit":"MozTransform"in n?"Moz":"msTransform"in n?"ms":"OTransform"in n?"O":"";return e+"Perspective"in n?"translate3d":e+"Transform"in n?"translate":"margin"};var l=function(){function n(){var t=e.shift();t&&t(n)}var e=[];return function(t){e.push(t),1==e.length&&n()}}(),f=function(){function n(n){return n.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,function(n,e){return e.toUpperCase()})}function e(n){var e=document.body.style;if(n in e)return n;for(var t,r=i.length,o=n.charAt(0).toUpperCase()+n.slice(1);r--;)if((t=i[r]+o)in e)return t;return n}function t(t){return t=n(t),o[t]||(o[t]=e(t))}function r(n,e,r){e=t(e),n.style[e]=r}var i=["Webkit","O","Moz","ms"],o={};return function(n,e){var t,i,o=arguments;if(2==o.length)for(t in e)void 0!==(i=e[t])&&e.hasOwnProperty(t)&&r(n,t,i);else r(n,o[1],o[2])}}();return u});
</script>

<style>
    /* Make clicks pass-through */
    #nprogress {
        pointer-events: none;
    }

    #nprogress .bar {
        background: #29d;

        position: fixed;
        z-index: 100000000000000000000000000000;
        top: 0;
        left: 0;

        width: 100%;
        height: 2px;
    }

    /* Fancy blur effect */
    #nprogress .peg {
        display: block;
        position: absolute;
        right: 0px;
        width: 100px;
        height: 100%;
        box-shadow: 0 0 10px #29d, 0 0 5px #29d;
        opacity: 1.0;

        -webkit-transform: rotate(3deg) translate(0px, -4px);
        -ms-transform: rotate(3deg) translate(0px, -4px);
        transform: rotate(3deg) translate(0px, -4px);
    }

    /* Remove these to get rid of the spinner */
    #nprogress .spinner {
        display: block;
        position: fixed;
        z-index: 100000000000000000000000000000;
        top: 15px;
        right: 15px;
    }

    #nprogress .spinner-icon {
        width: 18px;
        height: 18px;
        box-sizing: border-box;

        border: solid 2px transparent;
        border-top-color: #29d;
        border-left-color: #29d;
        border-radius: 50%;

        -webkit-animation: nprogress-spinner 400ms linear infinite;
        animation: nprogress-spinner 400ms linear infinite;
    }

    .nprogress-custom-parent {
        overflow: hidden;
        position: relative;
    }

    .nprogress-custom-parent #nprogress .spinner,
    .nprogress-custom-parent #nprogress .bar {
        position: absolute;
    }

    @-webkit-keyframes nprogress-spinner {
        0%   { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes nprogress-spinner {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>