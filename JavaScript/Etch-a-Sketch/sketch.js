const main = document.querySelector(".maincontainer");
const random = document.querySelector("#random");
const eraser = document.querySelector("#erase");
const clear = document.querySelector("#clear");
const pastel = document.querySelector("#pastel")
const toggle = document.querySelector("#toggle");
let usercolor = document.querySelector("#colorpicker");
let currentsize= document.querySelector("#slider");

let startsize=16;
let mode="userpick";
let color;

clear.onclick= () => actclear();
random.onclick = () => changemode("random");
eraser.onclick= () => changemode("erase");
pastel.onclick= () => changemode("pastel");
toggle.onclick= () => addgridlines();

usercolor.onchange= (e) => changemode("userpick");
currentsize.onchange=(e) => changesize(e.target.value);

function changesize(newsize){
    let x= document.querySelector("#size");
    x.textContent="GRID: "+newsize + " X " + newsize;
    startsize=newsize;
    actclear();
    
}
let x=0;
function addgridlines(){
    let lines = document.getElementsByClassName("gridcell");
    if(x===0){
    for (let i=0; i < lines.length; i++) {
        lines[i].style.border="solid 1px rgb(192, 192, 192)";
        x=1;
        }
    }
    else{
        for (let i=0; i < lines.length; i++) {
            lines[i].style.border="none";
            x=0;
            }

    }

}
function changemode(selectedmode){
    mode=selectedmode;
    changecolor;
}

function actclear(){
    let elements = document.getElementsByClassName("gridcell");
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
    defaultGrid(startsize);
}

function defaultGrid(size){
    main.style.setProperty('--grid-rows', size);
    main.style.setProperty('--grid-cols', size);
    for (let x=0;x<size*size;x++){
        let cell = document.createElement("div");
        cell.style.backgroundColor= "#FFFFFF";
        cell.addEventListener("mouseover",changecolor);
        main.appendChild(cell).className="gridcell";
    }
}

function changecolor(e){
    if(mode === "random"){
        let x = Math.floor(Math.random() * 256);
        let y = 100 + Math.floor(Math.random() * 256);
        let z = 50 + Math.floor(Math.random() * 256);
        let  bgColor = "rgb(" + x + "," + y + "," + z + ")";
        e.target.style.backgroundColor= bgColor;
    }
    else if(mode === "pastel"){
        let pastels=['#A1E2D2','#CCF1DE','#ECF3DC','#F5E3D7','#E1D3EF','#B7C6E6'];
        e.target.style.backgroundColor= pastels[Math.floor(Math.random()*pastels.length)];

    }
    else if(mode === "erase"){
        e.target.style.backgroundColor="#FFFFFF";
    }

    else if(mode === "userpick"){
        color=usercolor.value;
        e.target.style.backgroundColor=color;
    }
}

defaultGrid(startsize)