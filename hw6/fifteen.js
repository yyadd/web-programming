"use strict";

function $(id){
    return document.getElementById(id);
}
var emptycol = 3;
var emptyrow = 3;
var numbers = 100;
var movableTiles = []; 
function movable(obj){    
    var x = parseInt(obj.style.left, 10);
    var y = parseInt(obj.style.top, 10);
    var ex = emptycol * numbers;
    var ey = emptyrow * numbers;
    var fx = ((x - numbers == ex) || (x + numbers == ex)) && (y == ey);
    var fy = ((y - numbers == ey) || (y + numbers == ey)) && (x == ex); 
    var result = [x,y,ex,ey,fx||fy];
    return result;
}
function move(obj) {
    var tt = movable(obj);
    if (tt[4]) {
        obj.style.left = tt[2] + "px";
        obj.style.top  = tt[3] + "px";
        emptycol = tt[0] / numbers;
        emptyrow = tt[1] / numbers;
        var tiles = $("puzzlearea").getElementsByTagName("div");
        movableTiles.length=0;
        for (var i =0; i< Math.pow(4,2)-1; i++){    
            tt = movable(tiles[i]);
            if (tt[4]){
                tiles[i].className += " movablepiece";
                movableTiles.push(i);
            }else{
                tiles[i].className = "puzzlepiece";
            }
        }
    }
}
function shuffle(){
    var tiles = $("puzzlearea").getElementsByTagName("div");
    for (var i=0; i<1000 ; i++){
        move(tiles[ movableTiles[ parseInt(Math.random() * movableTiles.length)] ]);
    }
}
window.onload = function(){
    $("shufflebutton").onclick = function(){ shuffle();};
    var tiles = $("puzzlearea").getElementsByTagName("div");
    var pos;
    for (var row=0; row<4; row++)
    {
        for (var col=0; col<4;col++){
            pos = row*4 + col;
            if(pos >=  Math.pow(4,2) - 1){
                break;
            }
            tiles[pos].className ="puzzlepiece";
            tiles[pos].style.left = numbers*col+"px";
            tiles[pos].style.top = numbers*row+"px";
            tiles[pos].style.backgroundPosition = "-"+numbers*col+"px -"+(numbers*row+"px");
            tiles[pos].onclick = function(){ move(this);};
        }
    }
};



