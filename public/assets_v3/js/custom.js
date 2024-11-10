var prevScrollpos = window.pageYOffset;

window.onscroll = function() {

    var currentScrollPos = window.pageYOffset;

    if (prevScrollpos > document.getElementById("heading").getBoundingClientRect().bottom) {
        document.getElementById("navbar").style.display = "none";
    } else {
        document.getElementById("navbar").style.display = "block";
    }
    prevScrollpos = currentScrollPos;
}