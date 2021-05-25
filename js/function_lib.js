// Changes background
function swap_background(interval, frames) {
	var int = 1;
	function func() {
        var x = document.getElementsByClassName("html");
        x[0].id = "b"+int;
        int++;
        if(int == frames+1) { int = 1; }
    }
    
    var swap = window.setInterval(func, interval);
}


