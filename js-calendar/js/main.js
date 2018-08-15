let app = new Vue({
	el: "#app",
	data: {
		weekDays: [
			'Mon',
			'Tue',
			'Wed',
			'Thu',
			'Fri',
			'Sat',
			'Sun'
		],
		months: [
			'January',
			'Febuary',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'Nowember',
			'December'
		],
		monthArr: [

		],
		selectedDate: {
			year: null,
			month: null,
			day: null
		},
		currEvents: [],
		eventName: '',
	},
	methods: {
		showEvents: function(day=null){
			this.currEvents = [];
			if(day !== null){
				this.selectedDate.day = day;
			}
			this.getEvents();

		},
		addEvent: function(){
			if (!this.eventName.match(/\w+/g)) {
				alert("Enter event name");
				return;
			}
			this.currEvents = [];
			this.getEvents();

			this.currEvents.push({'name': this.eventName});
			localStorage.setItem(this.getEventsId(), JSON.stringify(this.currEvents));
			this.eventName = '';
		},
		getEvents: function(){

			if (localStorage.getItem(this.getEventsId())) {
				let events = JSON.parse(localStorage.getItem(this.getEventsId()));
				this.currEvents = events;
			}	
		},
		removeEvent: function(i){
			this.currEvents.splice(i, 1);
			if(this.currEvents.length == 0){
				localStorage.removeItem(this.getEventsId());
			} else{
				localStorage.setItem(this.getEventsId(), JSON.stringify(this.currEvents));
			}
		},
		getEventsId: function(iday, imonth, iyear){
			if(iday && imonth && iyear){
				return ''+iday+imonth+iyear;
			}
			let day = this.selectedDate.day;
			let month = this.selectedDate.month;
			let year = this.selectedDate.year;
			
			return ''+day+month+year;
		},
		buildCalendar: function(yearInp=null, monthInp=null){
			this.setSelectedDate(yearInp, monthInp);

			let year = this.selectedDate.year;
			let month = this.selectedDate.month;

			let daysInMonth = this.daysInMonth(year, month);
			let firstMonthDay = this.firstMonthDay(year, month);
			let colsTotal = Math.ceil((daysInMonth+firstMonthDay)/7)*7; 

			let colIndex = 0;
			let day = 1;
			let week = 1;
			this.monthArr = [];
			this.monthArr[week] ={};
			do{
				isToday = false;
				isPlanned = false;
				isHoliday = false;
				isAccess = false;
				let currDayNum = colIndex%7;
				//monthArr.push(week);
			    if((colIndex < firstMonthDay) || (colIndex >= (firstMonthDay+daysInMonth))){
			    	
			    	this.monthArr[week][currDayNum] = null;
			    	//monthArr[week][colIndex%7] = {};
			    } else {
			    	className = '';
			    	if (this.currYear() <= year){
			    		if (true) {}
			    		isAccess = true;
			    	} 
			    	if(this.currDay() == day &&
			    		this.currMonth() == month &&
			    		this.currYear() == year){
			    		isToday = true;
			    	}
			    	if (localStorage.getItem(this.getEventsId(day, month, year))){
			    		isPlanned = true;
			    	}
			    	else if (currDayNum == 6 || currDayNum == 5) {
			    		isHoliday = true;
			    	}
			    	this.monthArr[week][currDayNum] = {
			    		'year': year, 
			    		'month': month, 
			    		'day': day,
			    		'isToday': isToday,
			    		'isHoliday': isHoliday,
			    		'isPlanned': isPlanned,
			    		'isAccess' : isAccess
			    	};
			    	day++
			    }
			    if(currDayNum == 6){
			    	
			    	week++;
			    	if (week <= (colsTotal/7)) {
			    		this.monthArr[week] = {};
			    	}    	
			    }
			    colIndex++;
			    
			} while(colIndex < colsTotal);
			
		},
		daysInMonth: function(year, month){
			return new Date(year, month+1, 0).getDate();	
		},
		currDay: function(){
			return new Date().getDate();
		},
		currYear: function(){
			return new Date().getFullYear();
		},
		currMonth: function(){
			return new Date().getMonth();
		},
		dayOfWeek: function(){

			let num = new Date(
				this.selectedDate.year,
			 	this.selectedDate.month,
			  	this.selectedDate.day).getDay();
			return this.weekDays[num];
		},
		firstMonthDay: function(year, month){

			let res = new Date(year, month, 1).getDay();
			if (res == 0) {
				res = 7;
			}
			return --res;
		},
		
		setSelectedDate: function(year, month) {
			if (month !== null) {
				if (month > 11) {
					month = 0;
					this.selectedDate.year++;
				} else if (month < 0) {
					month = 11;
					this.selectedDate.year--;
				};
				this.selectedDate.month = month;
			} else {
				if (this.selectedDate.month === null) {
					this.selectedDate.month = this.currMonth();
				}
			}

			if (year !== null ) {
				this.selectedDate.year = year;
			} else {	
				if (this.selectedDate.year === null) {
					this.selectedDate.year = this.currYear();
				}
			}
			this.selectedDate.day = null;
		},
		prewYear: function(){
			this.buildCalendar(this.selectedDate.year-1, null);
		},
		nextYear: function(){
			this.buildCalendar(this.selectedDate.year+1, null);
		},
		prewMonth: function(){
			this.buildCalendar(null, this.selectedDate.month-1);
		},
		nextMonth: function(){
			this.buildCalendar(null, this.selectedDate.month+1);
		}
	},
	beforeMount(){
		this.buildCalendar();
	}
});