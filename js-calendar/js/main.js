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
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Now',
			'Dec'
		],
		monthArr: [

		],
		/*selectedData: {
			year: null,
			month: null,
			day: null
		}*/
	},
	methods: {
		buildCalendar: function(year, month){
			//let currDate = new Date();
			let currYear = new Date().getFullYear();
			let currMonth = new Date().getMonth();
			let currDay = new Date()
			let daysInMonth = this.daysInMonth(year, month);
			let firstMonthDay = this.firstMonthDay(year, month);
			let colsTotal = Math.round((daysInMonth+firstMonthDay)/7)*7; 
			console.log(`firstMonthDay:${this.firstMonthDay(year, month)}`);
			console.log(`month:${month}`);
			console.log(`daysInMonth: ${this.daysInMonth(year, month)}`);
			console.log(`daysInMonth: ${colsTotal}`);
			//console.log(`currWeekDay:${this.currWeekDay(year, month)}`);
			let colIndex = 0;
			let day = 1;
			//let monthArr = [];
			let week = 1;
			this.monthArr[week] ={};
			do{
				let currDayNum = colIndex%7;
				//monthArr.push(week);
			    if((colIndex < firstMonthDay) || (colIndex >= (firstMonthDay+daysInMonth))){
			    	
			    	this.monthArr[week][currDayNum] = null;
			    	//monthArr[week][colIndex%7] = {};
			    } else {
			    	className = '';
			    	if(currYear == year && 
			    		currMonth == month &&
			    		currDay == day){
			    		className = 'today';
			    	} 
			    	else if (currDayNum == 6 || currDayNum == 5) {
			    		className = 'holiday';
			    	}
			    	this.monthArr[week][currDayNum] = {'year': year, 'month':month, 'day': day, 'class': className};
			    	day++
			    }
			    if(currDayNum == 6){
			    	
			    	week++;
			    	if (week <= (colsTotal/7)) {
			    		this.monthArr[week] ={};
			    	}    	
			    }
			    colIndex++;
			    
			}while(colIndex < colsTotal);
			
		},
		daysInMonth: function(year, month){
			return new Date(year, month-1, 0).getDate();	
		},
		currDay: function(year, month){
			return new Date(year, month-1).getDate();
		},
		/*currWeekDay: function(year, month){
			let res = new Date(year, month-1).getDay();
			
			return res;
		},*/
		firstMonthDay: function(year, month){

			let res = new Date(year, month-1, 1).getDay();
			if (res == 0) {
				return 7;
			}
			return res;
		} 
	},
	beforeMount(){
		this.buildCalendar(2018, 8);
	}
});