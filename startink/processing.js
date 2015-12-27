
// Piece of js code, to get window dimensions
var winW = 800, winH = 600;
if (parseInt(navigator.appVersion)>3) {
if (navigator.appName=="Netscape") {
winW = window.innerWidth;
winH = window.innerHeight;
}
if (navigator.appName.indexOf("Microsoft")!=-1) {
winW = document.body.offsetWidth;
winH = document.body.offsetHeight;
}
}
// Set number of rectangles/bars
int count = random(40);
// Build float array to store rect properties
float[][] f = new float[count][6];
// Set up canvas
void setup(){
// Frame rate
frameRate(15);
// Size of canvas (width,height)
size(winW,winH);
for(int j=0;j< count;j++){
f[j][0]=random(winW); // X
f[j][1]=winH; // Y
f[j][2]=random(-.5,.5); // X Speed
f[j][3]=random(30,40); // opacity
f[j][4]=random(30); // red
f[j][5]=random(30); // green
f[j][6]=random(230); // blue
f[j][7]=random(winW/(count)) // bar width
}
}
// Begin main draw loop
void draw(){
// Fill background white, doesnt support transparent :(
background(#ffffff);
// Begin looping through rectangle array
for (int i=0;i< count;i++){
// Disable shape stroke/border
noStroke();
// fill color
fill( f[i][4], f[i][5], f[i][6], f[i][3]);
// Draw rectangles
rect(f[i][0],0, f[i][7],winH);
// Move rect horizontally
f[i][0]+=f[i][2];
// Wrap edges of canvas so rectangles get removed if they go out of bounds
if( f[i][0] < -f[i][7] ){ f[i][0] = random(winW); }
if( f[i][0] > winW+f[i][7] ){ f[i][0] = random(winW); }
}
} // JavaScript Document