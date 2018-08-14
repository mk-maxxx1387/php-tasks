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
			month: null
		}
	},
	methods: {
		buildCalendar: function(yearInp=null, monthInp=null){
			this.setSelectedDate(yearInp, monthInp);

			//let currDate = new Date();
			/*let currYear = new Date().getFullYear();
			let currMonth = new Date().getMonth();
			let currDay = new Date();
			*/
			console.log(this.selectedDate.year);
			console.log(this.selectedDate.month);

			let year = this.selectedDate.year;
			let month = this.selectedDate.month;

			let daysInMonth = this.daysInMonth(year, month);
			let firstMonthDay = this.firstMonthDay(year, month);
			let colsTotal = Math.ceil((daysInMonth+firstMonthDay)/7)*7; 

			console.log(`firstMonthDay:${firstMonthDay}`);
			//console.log(`month:${month}`);
			console.log(`daysInMonth: ${daysInMonth}`);
			console.log(`colsTotal: ${colsTotal}`);
			//console.log(`currWeekDay:${this.currWeekDay(year, month)}`);
			let colIndex = 0;
			let day = 1;
			let week = 1;
			this.monthArr = [];
			this.monthArr[week] ={};
			do{
				let currDayNum = colIndex%7;
				//monthArr.push(week);
			    if((colIndex < firstMonthDay) || (colIndex >= (firstMonthDay+daysInMonth))){
			    	
			    	this.monthArr[week][currDayNum] = null;
			    	//monthArr[week][colIndex%7] = {};
			    } else {
			    	className = '';
			    	if(this.currYear() == year && 
			    		this.currMonth() == month &&
			    		this.currDay() == day){
			    		className = 'today';
			    	} 
			    	else if (currDayNum == 6 || currDayNum == 5) {
			    		className = 'holiday';
			    	}
			    	this.monthArr[week][currDayNum] = {
			    		'year': year, 
			    		'month': month, 
			    		'day': day, 
			    		'class': className
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
		currDay: function(year, month){
			return new Date(year, month).getDate();
		},
		currYear: function(){
			return new Date().getFullYear();
		},
		currMonth: function(){
			return new Date().getMonth();
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