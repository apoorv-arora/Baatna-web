<script type="text/javascript">
/**********************************************************************************************
* CountUp script by Praveen Lobo (http://PraveenLobo.com/techblog/javascript-countup-timer/)
* This notice MUST stay intact(in both JS file and SCRIPT tag) for legal use.
* http://praveenlobo.com/blog/disclaimer/
**********************************************************************************************/
function CountUp(initDate, id)
{   this.beginDate = new Date(initDate);
    this.countainer = document.getElementById(id);
    this.numOfDays = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
    this.borrowed = 0, this.years = 0, this.months = 0, this.days = 0;
    this.hours = 0, this.minutes = 0, this.seconds = 0;
    this.updateNumOfDays();
    this.updateCounter();
}
  
CountUp.prototype.updateNumOfDays=function(){
    var dateNow = new Date();
    var currYear = dateNow.getFullYear();
    if ( (currYear % 4 == 0 && currYear % 100 != 0 ) || currYear % 400 == 0 ) {
        this.numOfDays[1] = 29;
    }
    var self = this;
    setTimeout(function(){self.updateNumOfDays();}, (new Date((currYear+1), 1, 2) - dateNow));
}
  
CountUp.prototype.datePartDiff=function(then, now, MAX){
    var diff = now - then - this.borrowed;
    this.borrowed = 0;
    if ( diff > -1 ) return diff;
    this.borrowed = 1;
    return (MAX + diff);
}
  
CountUp.prototype.calculate=function(){
    var currDate = new Date();
    var prevDate = this.beginDate;
    this.seconds = this.datePartDiff(prevDate.getSeconds(), currDate.getSeconds(), 60);
    this.minutes = this.datePartDiff(prevDate.getMinutes(), currDate.getMinutes(), 60);
    this.hours = this.datePartDiff(prevDate.getHours(), currDate.getHours(), 24);
    this.days = this.datePartDiff(prevDate.getDate(), currDate.getDate(), this.numOfDays[currDate.getMonth()]);
    this.months = this.datePartDiff(prevDate.getMonth(), currDate.getMonth(), 12);
    this.years = this.datePartDiff(prevDate.getFullYear(), currDate.getFullYear(),0);
}
  
CountUp.prototype.addLeadingZero=function(value){
    return value < 10 ? ("0" + value) : value;
}
  
CountUp.prototype.formatTime=function(){
    this.seconds = this.addLeadingZero(this.seconds);
    this.minutes = this.addLeadingZero(this.minutes);
    this.hours = this.addLeadingZero(this.hours);
	this.months = this.addLeadingZero(this.months);
	this.days = this.addLeadingZero(this.days);
	this.year = this.addLeadingZero(this.year);
}
 
CountUp.prototype.updateCounter=function(){
    this.calculate();
    this.formatTime();
    this.countainer.innerHTML ="<span>" + this.years + "</span> <span>" + (this.years == 1? "year" : "years") + "</span>" +
        " <span>" + this.months + "</span> <span>" + (this.months == 1? "month" : "months") + "</span>" +
        " <span>" + this.days + "</span> <span>" + (this.days == 1? "day" : "days") + "</span>" +
        " <span>" + this.hours + "</span> <span>" + (this.hours == 1? "hour" : "hours") + "</span>" +
        " <span>" + this.minutes + "</span> <span>" + (this.minutes == 1? "min" : "mins") + "</span>" +
        " <span style='font-size:200%;'>" + this.seconds + "</span> <span>" + (this.seconds == 1? "sec" : "secs") + "</span>";
    var self = this;
    setTimeout(function(){self.updateCounter();}, 1000);
}

//
//function show_info()
//{console.log("ran");
//document.getElementsByClassName("moused").item(0).className="unmoused";
//document.getElementsByClassName("unmoused").item(0).className="moused";
//
//}
//
//function show_age()
//{console.log("ran");
//document.getElementsByClassName("moused").item(0).className="unmoused";
//document.getElementsByClassName("unmoused").item(1).className="moused";
//}


//to send a comment on the click of a button

	
	
	
	
	
</script>
