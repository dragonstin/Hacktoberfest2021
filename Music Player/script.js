const img=document.querySelector('img');
const music=document.querySelector("audio");
const play=document.getElementById("play");
const artist=document.getElementById("artist");
const title=document.getElementById("title");
const prev=document.getElementById("prev");
const next=document.getElementById("next");

const songs=[{
    name: "m",
    title: "Lock Down",
    artist: "BongGuy",
},
{
    name: "m",
    title: "Lock Down1",
    artist: "BongGuy1",
},
{
    name: "m",
    title: "Lock Down2",
    artist: "BongGuy2",
},

];


let isPlaying=false;

const playMusic = () =>{
    music.play();
    isPlaying=true;
    play.classList.replace("fa-play","fa-pause");
    img.classList.add("anime");
};


const pauseMusic = () =>{
    music.pause();
    isPlaying=false;
    play.classList.replace("fa-pause","fa-play");
    img.classList.remove("anime");
};



play.addEventListener('click',() =>{
if(isPlaying){
    pauseMusic();
}
else{
    playMusic();
}
});






// changing song
const loadSong = (songs) => {
    title.textContent = songs.title;
    artist.textContent = songs.artist;
    music.src="music/"+songs.name+".mp4";
    img.src="images/"+songs.name+".jpg";
};


songindex=0;


const nextsong=()=>{

songindex=(songindex+1)%songs.length;
loadSong(songs[songindex]);
playMusic();
};

const prevsong=()=>{

songindex=(songindex - 1 + songs.length) % songs.length;
loadSong(songs[songindex]);
playMusic();
};


next.addEventListener('click',nextsong);
prev.addEventListener('click',prevsong);
