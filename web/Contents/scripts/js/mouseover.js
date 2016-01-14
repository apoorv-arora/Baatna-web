function change()
{
document.getElementsByClassName("unmoused").className="moused";
document.getElementsByClassName("moused").item(1).className="unmoused";
console.log("ran");
}