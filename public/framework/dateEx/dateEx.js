var dateEx = {
	monthNames: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Augustus","September","Oktober","November","Desember"],
	weekDayNames : ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],
	weekDayNamesAbbrv : ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
	dateToInput: function(date){
		return date.getFullYear()+"-"+("0"+(date.getMonth()+1)).slice(-2)+"-"+("0" + date.getDate()).slice(-2);
	},
	dateToAbbrvDate: function(date){
		return date.getDate()+" "+this.monthNames[date.getMonth()]+" "+date.getFullYear();
	},
	dateToAbbrvTime: function(date){
		return date.getDate()+" "+this.monthNames[date.getMonth()]+" "+date.getFullYear()+" "
		+("0"+String(date.getHours())).slice(-2)+":"
		+("0"+String(date.getMinutes())).slice(-2)+":"
		+("0"+String(date.getSeconds())).slice(-2);
	},
	print: function(obj){
		if(obj instanceof Date){

		}
		else if(typeof obj == 'string'){
			obj = new Date(obj)
		}
		else{
			throw "It is not date"
		}
		var tanggalstring = this.dateToAbbrvDate(obj)
		if(tanggalstring.indexOf('NaN')>-1 || tanggalstring.indexOf('undefined')>-1){
			tanggalstring = ""
		}
		return tanggalstring
	},
	printTime: function(obj){
		if(obj instanceof Date){

		}
		else if(typeof obj == 'string'){
			obj = new Date(obj)
		}
		else{
			throw "It is not date"
		}
		var tanggalstring = this.dateToAbbrvTime(obj)
		if(tanggalstring.indexOf('NaN')>-1 || tanggalstring.indexOf('undefined')>-1){
			tanggalstring = ""
		}
		return tanggalstring
	}
}
