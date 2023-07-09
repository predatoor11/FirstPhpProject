// setInterval(function (){
    init();
// },500);
function init() {
    var rgb = document.getElementById('rgb');
    var r = 0, g = 0, b = 0;
    r = Math.floor(Math.random() * 255);
    g = Math.floor(Math.random() * 255);
    b = Math.floor(Math.random() * 255);
    
        
    var interval = setInterval(function() {
        r = red(r);
        g = red(g);
        b = red(b);
        if(r >= 255) { r = Math.floor(Math.random() * 255); }
        if(g >= 255) { g = Math.floor(Math.random() * 255); }
        if(b >= 255) { b = Math.floor(Math.random() * 255); }
        rgb.style.color = "rgb("+ r +","+ g +","+ b +")";
    }, 20);
}
function red(r) {
    r++;
    return r;
}
function green(g) {
    g++;
    return g;
}
function blue(b) {
    b++;
    return b;
}