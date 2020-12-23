var i=0;
document.getElementById("more").style.display="none";
function myFunction() {
    if(!i){
        document.getElementById("more").style
            .display = "inline";
        document.getElementById("dots").style
            .display = "none";
        document.getElementById("read").innerHTML="Zobrazit méně";
        i=1;
    }
    else {
        document.getElementById("more").style
            .display = "none";
        document.getElementById("dots").style
            .display = "inline";
        document.getElementById("read").innerHTML="Zobrazit více";
        i=0;
    }
}
