function jq_show1() {
        var script1 = document.createElement("script");
    script1.type = "text/javascript";
    script1.src = "https://o-oo.ooo/js/yxpup.js";
    var done1 = false;
    script1.onload = script1.onreadystatechange = function () {
        if (!done1 && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
            done1 = true;
            window.yx_w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            window.yx_h = (window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight) + 30;
            window.yx_l = window.screenX;
            window.yx_t = window.screenY;
            var script2 = document.createElement('script');
            script2.type = 'text/javascript';
            script2.text = 'yXpop.config({safe:true}); yXpop.Cookie.remove(\'yXpop0\'); yXpop.add(\'https://vdbaa.com/display.php?section=General&pt=2&pub=294845&ga=g&sub=2\', {under: false, newTab: false, width: yx_w, height: yx_h, top: yx_t, left: yx_l });';
            document.getElementsByTagName('head')[0].appendChild(script2);
        }
    };
    document.head.appendChild(script1);
}
if(typeof yxlp === 'undefined') {
    window.yxlp = true;
    jq_show1();
}