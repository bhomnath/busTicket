<html>
    <head>
        <title>Bus Ticketing</title> 
      
        <meta name=viewport content="width=device-width, initial-scale=1">
<meta content="homnath.com.np Provide First real online booking portal for all tourist bus in nepal, book online ticket for kathmandu, pokhra to delhi." name="description">
<meta name="keywords" content="Kathmandu online bus ticket service,ticket booking, ticket booking in nepal, online ticket booking, bus online, bus ticket, e ticketing, e-ticketing, e-ticket, online ticket, bus on hire, car on hire, bus-ticket, buses to book, bus to book, book, Nepal online bus booking, Kathmandu pokhara touris bus in nepal">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/styles.css' ?>" />
         <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/fontIcon/style.css' ?>" />
    </head>
    <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url() . "contents/styles/jquery-ui.css"; ?>"/>
<script src="<?php echo base_url() . "contents/scripts/jquery1.10.2.js"; ?>"></script>
<script src="<?php echo base_url() . "contents/scripts/jquery-ui.js"; ?>"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
</head>
<script>
    $(function() {

        $("#from").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'index.php/home/fromQuery'; ?>",
                    dataType: "json",
                    data: {'userA': request.term},
                    success: function(msgs)
                    {
                        response(msgs);
                    }
                });
            }

        });

    });

    $(function() {

        $("#to").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'index.php/home/toQuery'; ?>",
                    dataType: "json",
                    data: {'userA': request.term},
                    success: function(msgs)
                    {
                        response(msgs);
                    }
                });
            }

        });

    });

 $(document).ready(function() {   
 
 $('#sbutton').click(function(){
    var from = $('#from').val();
    var to = $('#to').val();
    var depDate = $('#CheckIn').val();
    
    $.ajax({
        type: "POST",
        url:"<?php echo base_url() .'index.php/home/showBuses' ?>",
        data: {
            'from': from,
            'to' : to,
            'depDate' : depDate},
        success: function(msg)
        {
           //alert(msg);
           $('#form-side-content-all').css({'display': 'block'});
            $('#form-side-content-all').html(msg);

        }
         
    });
    
    });
 
 
 
    });

</script>
 <script>
        $(function(){
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkin = $('#CheckIn').datepicker({
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkout.setValue(newDate);
  }
  checkin.hide();
  $('#CheckOut')[0].focus();
}).data('datepicker');
var checkout = $('#CheckOut').datepicker({
  onRender: function(date) {
	return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');
});

 
!function( $ ) {
	
	// Picker object
	
	var Datepicker = function(element, options){
		this.element = $(element);
		this.format = DPGlobal.parseFormat(options.format||this.element.data('date-format')||'mm/dd/yyyy');
		this.picker = $(DPGlobal.template)
							.appendTo('body')
							.on({
								click: $.proxy(this.click, this)//,
								//mousedown: $.proxy(this.mousedown, this)
							});
		this.isInput = this.element.is('input');
		this.component = this.element.is('.date') ? this.element.find('.add-on') : false;
		
		if (this.isInput) {
			this.element.on({
				focus: $.proxy(this.show, this),
				//blur: $.proxy(this.hide, this),
				keyup: $.proxy(this.update, this)
			});
		} else {
			if (this.component){
				this.component.on('click', $.proxy(this.show, this));
			} else {
				this.element.on('click', $.proxy(this.show, this));
			}
		}
	
		this.minViewMode = options.minViewMode||this.element.data('date-minviewmode')||0;
		if (typeof this.minViewMode === 'string') {
			switch (this.minViewMode) {
				case 'months':
					this.minViewMode = 1;
					break;
				case 'years':
					this.minViewMode = 2;
					break;
				default:
					this.minViewMode = 0;
					break;
			}
		}
		this.viewMode = options.viewMode||this.element.data('date-viewmode')||0;
		if (typeof this.viewMode === 'string') {
			switch (this.viewMode) {
				case 'months':
					this.viewMode = 1;
					break;
				case 'years':
					this.viewMode = 2;
					break;
				default:
					this.viewMode = 0;
					break;
			}
		}
		this.startViewMode = this.viewMode;
		this.weekStart = options.weekStart||this.element.data('date-weekstart')||0;
		this.weekEnd = this.weekStart === 0 ? 6 : this.weekStart - 1;
		this.onRender = options.onRender;
		this.fillDow();
		this.fillMonths();
		this.update();
		this.showMode();
	};
	
	Datepicker.prototype = {
		constructor: Datepicker,
		
		show: function(e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (e ) {
				e.stopPropagation();
				e.preventDefault();
			}
			if (!this.isInput) {
			}
			var that = this;
			$(document).on('mousedown', function(ev){
				if ($(ev.target).closest('.datepicker').length == 0) {
					that.hide();
				}
			});
			this.element.trigger({
				type: 'show',
				date: this.date
			});
		},
		
		hide: function(){
			this.picker.hide();
			$(window).off('resize', this.place);
			this.viewMode = this.startViewMode;
			this.showMode();
			if (!this.isInput) {
				$(document).off('mousedown', this.hide);
			}
			//this.set();
			this.element.trigger({
				type: 'hide',
				date: this.date
			});
		},
		
		set: function() {
			var formated = DPGlobal.formatDate(this.date, this.format);
			if (!this.isInput) {
				if (this.component){
					this.element.find('input').prop('value', formated);
				}
				this.element.data('date', formated);
			} else {
				this.element.prop('value', formated);
			}
		},
		
		setValue: function(newDate) {
			if (typeof newDate === 'string') {
				this.date = DPGlobal.parseDate(newDate, this.format);
			} else {
				this.date = new Date(newDate);
			}
			this.set();
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		place: function(){
			var offset = this.component ? this.component.offset() : this.element.offset();
			this.picker.css({
				top: offset.top + this.height,
				left: offset.left
			});
		},
		
		update: function(newDate){
			this.date = DPGlobal.parseDate(
				typeof newDate === 'string' ? newDate : (this.isInput ? this.element.prop('value') : this.element.data('date')),
				this.format
			);
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		fillDow: function(){
			var dowCnt = this.weekStart;
			var html = '<tr>';
			while (dowCnt < this.weekStart + 7) {
				html += '<th class="dow">'+DPGlobal.dates.daysMin[(dowCnt++)%7]+'</th>';
			}
			html += '</tr>';
			this.picker.find('.datepicker-days thead').append(html);
		},
		
		fillMonths: function(){
			var html = '';
			var i = 0
			while (i < 12) {
				html += '<span class="month">'+DPGlobal.dates.monthsShort[i++]+'</span>';
			}
			this.picker.find('.datepicker-months td').append(html);
		},
		
		fill: function() {
			var d = new Date(this.viewDate),
				year = d.getFullYear(),
				month = d.getMonth(),
				currentDate = this.date.valueOf();
			this.picker.find('.datepicker-days th:eq(1)')
						.text(DPGlobal.dates.months[month]+' '+year);
			var prevMonth = new Date(year, month-1, 28,0,0,0,0),
				day = DPGlobal.getDaysInMonth(prevMonth.getFullYear(), prevMonth.getMonth());
			prevMonth.setDate(day);
			prevMonth.setDate(day - (prevMonth.getDay() - this.weekStart + 7)%7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setDate(nextMonth.getDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName,
				prevY,
				prevM;
			while(prevMonth.valueOf() < nextMonth) {
				if (prevMonth.getDay() === this.weekStart) {
					html.push('<tr>');
				}
				clsName = this.onRender(prevMonth);
				prevY = prevMonth.getFullYear();
				prevM = prevMonth.getMonth();
				if ((prevM < month &&  prevY === year) ||  prevY < year) {
					clsName += ' old';
				} else if ((prevM > month && prevY === year) || prevY > year) {
					clsName += ' new';
				}
				if (prevMonth.valueOf() === currentDate) {
					clsName += ' active';
				}
				html.push('<td class="day '+clsName+'">'+prevMonth.getDate() + '</td>');
				if (prevMonth.getDay() === this.weekEnd) {
					html.push('</tr>');
				}
				prevMonth.setDate(prevMonth.getDate()+1);
			}
			this.picker.find('.datepicker-days tbody').empty().append(html.join(''));
			var currentYear = this.date.getFullYear();
			
			var months = this.picker.find('.datepicker-months')
						.find('th:eq(1)')
							.text(year)
							.end()
						.find('span').removeClass('active');
			if (currentYear === year) {
				months.eq(this.date.getMonth()).addClass('active');
			}
			
			html = '';
			year = parseInt(year/10, 10) * 10;
			var yearCont = this.picker.find('.datepicker-years')
								.find('th:eq(1)')
									.text(year + '-' + (year + 9))
									.end()
								.find('td');
			year -= 1;
			for (var i = -1; i < 11; i++) {
				html += '<span class="year'+(i === -1 || i === 10 ? ' old' : '')+(currentYear === year ? ' active' : '')+'">'+year+'</span>';
				year += 1;
			}
			yearCont.html(html);
		},
		
		click: function(e) {
			e.stopPropagation();
			e.preventDefault();
			var target = $(e.target).closest('span, td, th');
			if (target.length === 1) {
				switch(target[0].nodeName.toLowerCase()) {
					case 'th':
						switch(target[0].className) {
							case 'switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								this.viewDate['set'+DPGlobal.modes[this.viewMode].navFnc].call(
									this.viewDate,
									this.viewDate['get'+DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate) + 
									DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1)
								);
								this.fill();
								this.set();
								break;
						}
						break;
					case 'span':
						if (target.is('.month')) {
							var month = target.parent().find('span').index(target);
							this.viewDate.setMonth(month);
						} else {
							var year = parseInt(target.text(), 10)||0;
							this.viewDate.setFullYear(year);
						}
						if (this.viewMode !== 0) {
							this.date = new Date(this.viewDate);
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						this.showMode(-1);
						this.fill();
						this.set();
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')){
							var day = parseInt(target.text(), 10)||1;
							var month = this.viewDate.getMonth();
							if (target.is('.old')) {
								month -= 1;
							} else if (target.is('.new')) {
								month += 1;
							}
							var year = this.viewDate.getFullYear();
							this.date = new Date(year, month, day,0,0,0,0);
							this.viewDate = new Date(year, month, Math.min(28, day),0,0,0,0);
							this.fill();
							this.set();
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						break;
				}
			}
		},
		
		mousedown: function(e){
			e.stopPropagation();
			e.preventDefault();
		},
		
		showMode: function(dir) {
			if (dir) {
				this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + dir));
			}
			this.picker.find('>div').hide().filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName).show();
		}
	};
	
	$.fn.datepicker = function ( option, val ) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data('datepicker'),
				options = typeof option === 'object' && option;
			if (!data) {
				$this.data('datepicker', (data = new Datepicker(this, $.extend({}, $.fn.datepicker.defaults,options))));
			}
			if (typeof option === 'string') data[option](val);
		});
	};

	$.fn.datepicker.defaults = {
		onRender: function(date) {
			return '';
		}
	};
	$.fn.datepicker.Constructor = Datepicker;
	
	var DPGlobal = {
		modes: [
			{
				clsName: 'days',
				navFnc: 'Month',
				navStep: 1
			},
			{
				clsName: 'months',
				navFnc: 'FullYear',
				navStep: 1
			},
			{
				clsName: 'years',
				navFnc: 'FullYear',
				navStep: 10
		}],
		dates:{
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		isLeapYear: function (year) {
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0))
		},
		getDaysInMonth: function (year, month) {
			return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month]
		},
		parseFormat: function(format){
			var separator = format.match(/[.\/\-\s].*?/),
				parts = format.split(/\W+/);
			if (!separator || !parts || parts.length === 0){
				throw new Error("Invalid date format.");
			}
			return {separator: separator, parts: parts};
		},
		parseDate: function(date, format) {
			var parts = date.split(format.separator),
				date = new Date(),
				val;
			date.setHours(0);
			date.setMinutes(0);
			date.setSeconds(0);
			date.setMilliseconds(0);
			if (parts.length === format.parts.length) {
				var year = date.getFullYear(), day = date.getDate(), month = date.getMonth();
				for (var i=0, cnt = format.parts.length; i < cnt; i++) {
					val = parseInt(parts[i], 10)||1;
					switch(format.parts[i]) {
						case 'dd':
						case 'd':
							day = val;
							date.setDate(val);
							break;
						case 'mm':
						case 'm':
							month = val - 1;
							date.setMonth(val - 1);
							break;
						case 'yy':
							year = 2000 + val;
							date.setFullYear(2000 + val);
							break;
						case 'yyyy':
							year = val;
							date.setFullYear(val);
							break;
					}
				}
				date = new Date(year, month, day, 0 ,0 ,0);
			}
			return date;
		},
		formatDate: function(date, format){
			var val = {
				d: date.getDate(),
				m: date.getMonth() + 1,
				yy: date.getFullYear().toString().substring(2),
				yyyy: date.getFullYear()
			};
			val.dd = (val.d < 10 ? '0' : '') + val.d;
			val.mm = (val.m < 10 ? '0' : '') + val.m;
			var date = [];
			for (var i=0, cnt = format.parts.length; i < cnt; i++) {
				date.push(val[format.parts[i]]);
			}
			return date.join(format.separator);
		},
		headTemplate: '<thead>'+
							'<tr>'+
								'<th class="prev">&lsaquo;</th>'+
								'<th colspan="5" class="switch"></th>'+
								'<th class="next">&rsaquo;</th>'+
							'</tr>'+
						'</thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
	};
	DPGlobal.template = '<div class="datepicker dropdown-menu">'+
							'<div class="datepicker-days">'+
								'<table class=" table-condensed">'+
									DPGlobal.headTemplate+
									'<tbody></tbody>'+
								'</table>'+
							'</div>'+
							'<div class="datepicker-months">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
							'<div class="datepicker-years">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
						'</div>';

}( window.jQuery );
</script>
<body>
    <div id="full-body-content">
        <div id="top-header-sandbar">
        <div id="header-logo-top">
            <div style="float: left; width: 80%; margin: 0px; padding: 3px 0px 3px 0px;height: 24px;">
                <span style="color: #fff;" class="icon-envelope"></span><span class="samll-font-top-header" >bhomnath@salyani.com.np</span>
             <span style="color: #fff;" class="icon-phone"></span><span class="samll-font-top-header" >9845214140</span>
            </div>
            <div style="float: left; width: 20%; margin: 0px; padding: 3px 0px 3px 0px;height: 24px;">
                <a class="samll-font-top-header" href="#">Sign Up</a><span class="samll-font-top-header">|</span>
                <a class="samll-font-top-header" href="#">Register</a><span class="samll-font-top-header">|</span>
                <a class="samll-font-top-header" href="#">Login</a>
            </div>
        </div>
        
        <div id="header-logo-title">
            <div id="brand"><img style="float: left; padding: 6px 0px 0px 0px;" src="<?php echo base_url() . "contents/images/logo.png"; ?>"height="30" alt="bus sewa"/><h3>Bus Sewa</h3></div>
            <div id="navigationTop">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>

            </ul>

        </div>
        </div></div> 
        <div class="clear"></div>
        <!-- here -->
        
        <div id="slider-body-slide-top"></div>
     <div id="slider-body-slide-above">
    <div class="glass-hero-wrap">
     
                <input type="radio" selected name="oneround" value="">One Way
                <input type="radio" name="oneround" value="">Round Trip
                    <div class="ui-widget">
                        <p><label for="from">From:</label><br/>
                       <input class="textInput" placeholder="From" id="from" >
                        </p>
                    </div>
                   <div class="ui-widget">
                       <p><label for="to">To:</label><br/>
                        <input class="textInput" placeholder="To" id="to" >
                       </p>
                    </div>
                        <p><label for="date">Date:</label><br/>
                        <input  class="textInput" id="CheckIn" type="text" value="" readonly="" name="CheckIn">
                        </p>
                        <input type="submit" value="Search Bus" id="sbutton"/>
            
    </div>
        
 </div>
<!--till here-->
        
     <!--   <div id="slider-body-slide">
            <div style="width: 26.5%; float: left;">
            <div style="width: 100%; height: 50px; background-color: red; float: left;">
                    <h3 style="color: #fff; margin: 0px; padding: 10px;">FIND YOUR TRIP</h3>
                </div>
            <div id="left-side-form">
                <input type="radio" selected name="oneround" value="">One Way
                <input type="radio" name="oneround" value="">Round Trip
                    <div class="ui-widget">
                        <p><label for="from">From:</label><br/>
                       <input class="textInput" placeholder="From" id="from" >
                        </p>
                    </div>
                   <div class="ui-widget">
                       <p><label for="to">To:</label><br/>
                        <input class="textInput" placeholder="To" id="to" >
                       </p>
                    </div>
                        
                    


                        <p><label for="date">Date:</label><br/>
                        <input  class="textInput" id="CheckIn" type="text" value="" readonly="" name="CheckIn">
                        </p>
                        <input type="submit" value="Search Bus" id="sbutton"/>
                   
               
            </div>
            </div>
            <div id="right-side-content-box">
                <img src="<?php //echo base_url() . "contents/images/monkey.jpg"; ?>" height="450" width="900" alt="bus sewa"/> 
            </div>
            
        </div> -->
        
        <div id="form-side-content-all">
            
            
        </div>
        <div class="content">
      
   <?php for($i=0;$i<3;$i++) {?>
        <div class="part">
            <div class="circle"></div>
            <div class="summary">Check the address for typing errors such as ww.example.com instead of www.example.com
If you are unable to load any pages, check your computer's network connection.
If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.</div>
            <div class="details"><span><b>View More </b>&rsaquo;&rsaquo;</span></div>
        </div>  
       
   <?php } ?>
    </div>
        <div id="other-content-all-here">
           
        </div>
        
        <div id="footer-contents-all-bottom">
            <div class="sitemap">
                <h4 style="color: #fff;">Quick Links</h4>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a>
                
            </div>
            <div class="sitemap">
                <h4 style="color: #fff;">Quick Links</h4>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a>
            </div>
            <div class="sitemap">
                <h4 style="color: #fff;">Quick Links</h4>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a>
            </div><div class="sitemap">
                <h4 style="color: #fff;">Quick Links</h4>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a><br/>
                <a href="#">Link</a>
            </div>
            <footer style="color: #fff; margin: 0 auto 0 auto; text-align: center;">&copy All rights reserved. -2014 Bussewa.</footer>
            
        </div>
        
    </div>
    
    
    
</body>
</html
<!--fro page scroll*/
<script>
                                                                var pagetop, menu, yPos, base_url='<?php //echo base_url(); ?>';
        function yScroll(){
            pagetop = document.getElementById('pagetop');
            menu = document.getElementById('menu');
            yPos = window.pageYOffset;
            if(yPos > 120){
                pagetop.style.height = "36px";
                pagetop.style.paddingTop = "4px";
                pagetop.style.filter  = 'alpha(opacity=50)';  //IE fallback
                menu.style.height = "40px";
                $(".logo_").html("<img src=" + base_url + "content/uploads/images/Central_College_logo_.png>");
            } else {
                pagetop.style.filter  = 'alpha(opacity=100)';  //IE fallback
                pagetop.style.height = "130px";
                pagetop.style.paddingTop = "10px";
                menu.style.height = "40px";
                $(".logo_").html(" ");
            }
        }
        window.addEventListener("scroll", yScroll);​
</script -->