
/* for button press*/
var instruments=document.querySelectorAll(".drum").length;
for (var i=0;i<instruments;i++){
    document.querySelectorAll(".drum")[i].addEventListener("click",function(){
      var buttonname=this.innerHTML;
      makesound(buttonname);
      buttonAnimation(buttonname);
    });
}

/* for keypress*/

for (var i=0;i<instruments;i++){
    document.addEventListener("keypress",function(event){
     makesound(event.key);
     buttonAnimation(event.key);
     });
}

/*for making sound*/

function makesound(key){
  switch(key){
          case "w":
            var tom1=new Audio("sounds/tom-1.mp3");
            tom1.play();
            break;
          case "a":
            var tom2=new Audio("sounds/tom-2.mp3");
            tom2.play();
            break;
          case "s":
            var tom3=new Audio("sounds/tom-3.mp3");
            tom3.play();
            break;
          case "d":
            var tom4=new Audio("sounds/tom-4.mp3");
            tom4.play();
            break;
          case "j":
            var snare=new Audio("sounds/snare.mp3");
            snare.play();
            break;
          case "k":
            var kick=new Audio("sounds/kick-bass.mp3");
            kick.play();
            break;
          case "l":
            var clash=new Audio("sounds/crash.mp3");
            clash.play();
            break;
      }
}

function buttonAnimation(curkey){
    var buttonanim=document.querySelector('.'+curkey);
    buttonanim.classList.add("pressed");
    setTimeout(function(){
       buttonanim.classList.remove("pressed");
},100);
}
