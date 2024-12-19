(()=>{function t(e){return t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},t(e)}function e(){"use strict";/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */e=function(){return n};var r,n={},o=Object.prototype,i=o.hasOwnProperty,a=Object.defineProperty||function(t,e,r){t[e]=r.value},c="function"==typeof Symbol?Symbol:{},u=c.iterator||"@@iterator",s=c.asyncIterator||"@@asyncIterator",f=c.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(r){l=function(t,e,r){return t[e]=r}}function h(t,e,r,n){var o=e&&e.prototype instanceof w?e:w,i=Object.create(o.prototype),c=new N(n||[]);return a(i,"_invoke",{value:T(t,r,c)}),i}function p(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}n.wrap=h;var v="suspendedStart",d="suspendedYield",y="executing",g="completed",m={};function w(){}function b(){}function x(){}var L={};l(L,u,(function(){return this}));var k=Object.getPrototypeOf,E=k&&k(k(G([])));E&&E!==o&&i.call(E,u)&&(L=E);var $=x.prototype=w.prototype=Object.create(L);function S(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function j(e,r){function n(o,a,c,u){var s=p(e[o],e,a);if("throw"!==s.type){var f=s.arg,l=f.value;return l&&"object"==t(l)&&i.call(l,"__await")?r.resolve(l.__await).then((function(t){n("next",t,c,u)}),(function(t){n("throw",t,c,u)})):r.resolve(l).then((function(t){f.value=t,c(f)}),(function(t){return n("throw",t,c,u)}))}u(s.arg)}var o;a(this,"_invoke",{value:function(t,e){function i(){return new r((function(r,o){n(t,e,r,o)}))}return o=o?o.then(i,i):i()}})}function T(t,e,n){var o=v;return function(i,a){if(o===y)throw new Error("Generator is already running");if(o===g){if("throw"===i)throw a;return{value:r,done:!0}}for(n.method=i,n.arg=a;;){var c=n.delegate;if(c){var u=P(c,n);if(u){if(u===m)continue;return u}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(o===v)throw o=g,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);o=y;var s=p(t,e,n);if("normal"===s.type){if(o=n.done?g:d,s.arg===m)continue;return{value:s.arg,done:n.done}}"throw"===s.type&&(o=g,n.method="throw",n.arg=s.arg)}}}function P(t,e){var n=e.method,o=t.iterator[n];if(o===r)return e.delegate=null,"throw"===n&&t.iterator.return&&(e.method="return",e.arg=r,P(t,e),"throw"===e.method)||"return"!==n&&(e.method="throw",e.arg=new TypeError("The iterator does not provide a '"+n+"' method")),m;var i=p(o,t.iterator,e.arg);if("throw"===i.type)return e.method="throw",e.arg=i.arg,e.delegate=null,m;var a=i.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=r),e.delegate=null,m):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,m)}function O(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function _(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function N(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(O,this),this.reset(!0)}function G(e){if(e||""===e){var n=e[u];if(n)return n.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var o=-1,a=function t(){for(;++o<e.length;)if(i.call(e,o))return t.value=e[o],t.done=!1,t;return t.value=r,t.done=!0,t};return a.next=a}}throw new TypeError(t(e)+" is not iterable")}return b.prototype=x,a($,"constructor",{value:x,configurable:!0}),a(x,"constructor",{value:b,configurable:!0}),b.displayName=l(x,f,"GeneratorFunction"),n.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===b||"GeneratorFunction"===(e.displayName||e.name))},n.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,x):(t.__proto__=x,l(t,f,"GeneratorFunction")),t.prototype=Object.create($),t},n.awrap=function(t){return{__await:t}},S(j.prototype),l(j.prototype,s,(function(){return this})),n.AsyncIterator=j,n.async=function(t,e,r,o,i){void 0===i&&(i=Promise);var a=new j(h(t,e,r,o),i);return n.isGeneratorFunction(e)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},S($),l($,f,"Generator"),l($,u,(function(){return this})),l($,"toString",(function(){return"[object Generator]"})),n.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},n.values=G,N.prototype={constructor:N,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=r,this.done=!1,this.delegate=null,this.method="next",this.arg=r,this.tryEntries.forEach(_),!t)for(var e in this)"t"===e.charAt(0)&&i.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=r)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(n,o){return c.type="throw",c.arg=t,e.next=n,o&&(e.method="next",e.arg=r),!!o}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],c=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var u=i.call(a,"catchLoc"),s=i.call(a,"finallyLoc");if(u&&s){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&i.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var o=n;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var a=o?o.completion:{};return a.type=t,a.arg=e,o?(this.method="next",this.next=o.finallyLoc,m):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),_(r),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;_(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,n){return this.delegate={iterator:G(t),resultName:e,nextLoc:n},"next"===this.method&&(this.arg=r),m}},n}function r(t,e,r,n,o,i,a){try{var c=t[i](a),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}function n(t){return function(){var e=this,n=arguments;return new Promise((function(o,i){var a=t.apply(e,n);function c(t){r(a,o,i,c,u,"next",t)}function u(t){r(a,o,i,c,u,"throw",t)}c(void 0)}))}}function o(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,i(n.key),n)}}function i(e){var r=function(e,r){if("object"!==t(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var o=n.call(e,r||"default");if("object"!==t(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===r?String:Number)(e)}(e,"string");return"symbol"===t(r)?r:String(r)}var a=function(){function t(){var r,o,a,c=this;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),r=this,o="$form",a=$(".notification-settings-form"),(o=i(o))in r?Object.defineProperty(r,o,{value:a,enumerable:!0,configurable:!0,writable:!0}):r[o]=a,this.$form.find(".send-test-message").on("click",function(){var t=n(e().mark((function t(r){return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,c.openSendTestMessageModal(r);case 2:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),$("#send-test-message-modal").on("click","button#send-test-message-modal-button",(function(t){c.sendTestMessage(t)})),this.$form.on("submit",function(){var t=n(e().mark((function t(r){var n;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(r.preventDefault(),r.stopPropagation(),!(n=$(r.currentTarget)).valid()){t.next=6;break}return t.next=6,c.saveSettings(n.find('button[type="submit"]'));case 6:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),this.$form.find("#get-telegram-chat-ids").on("click",function(){var t=n(e().mark((function t(r){return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,c.getTelegramChatIds(r);case 2:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()),$(".js-telegram-bot-token").on("change",(function(t){$(t.currentTarget).val()?$(".telegram-chat-id-wrapper").show():$(".telegram-chat-id-wrapper").hide()}))}var r,a,c,u,s,f;return r=t,a=[{key:"saveSettings",value:(f=n(e().mark((function t(r){var n,o,i=arguments;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return n=!(i.length>1&&void 0!==i[1])||i[1],o=r.closest("form"),t.next=4,$httpClient.make().withButtonLoading(r).post(o.prop("action"),o.serialize()).then((function(t){var e=t.data;n&&Botble.showSuccess(e.message),o.find(".send-test-message").removeClass("d-none")}));case 4:case"end":return t.stop()}}),t)}))),function(t){return f.apply(this,arguments)})},{key:"getTelegramChatIds",value:(s=n(e().mark((function t(r){var n;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r.preventDefault(),r.stopPropagation(),n=$(r.currentTarget),t.next=5,this.saveSettings(n,!1);case 5:$httpClient.make().withButtonLoading(n).post(n.data("url")).then((function(t){var e=t.data;$("#telegram-list-chat-ids").html(""),$.each(e,(function(t,e){$("#telegram-list-chat-ids").append("<li><code>".concat(t,"</code>: <strong>").concat(e,"</strong></li>"))}))}));case 6:case"end":return t.stop()}}),t,this)}))),function(t){return s.apply(this,arguments)})},{key:"sendTestMessage",value:function(t){t.preventDefault(),t.stopPropagation();var e=$("#send-test-message-modal"),r=e.find("form"),n=$(t.currentTarget);$httpClient.make().withButtonLoading(n).post(r.prop("action"),r.serialize()).then((function(t){var r=t.data;Botble.showSuccess(r.message),e.modal("hide")}))}},{key:"openSendTestMessageModal",value:(u=n(e().mark((function t(r){var n,o;return e().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r.preventDefault(),r.stopPropagation(),n=$(r.currentTarget),t.next=5,this.saveSettings(n);case 5:(o=$("#send-test-message-modal")).find('input[name="driver"]').val(n.data("driver")),o.modal("show");case 8:case"end":return t.stop()}}),t,this)}))),function(t){return u.apply(this,arguments)})}],a&&o(r.prototype,a),c&&o(r,c),Object.defineProperty(r,"prototype",{writable:!1}),t}();$((function(){new a}))})();