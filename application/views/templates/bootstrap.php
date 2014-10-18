<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Script Tutorials" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta content="homnath.com.np Provide First real online booking portal for all tourist bus in nepal, book online ticket for kathmandu, pokhra to delhi." name="description">
        <meta name="keywords" content="Kathmandu online bus ticket service,ticket booking, ticket booking in nepal, online ticket booking, bus online, bus ticket, e ticketing, e-ticketing, e-ticket, online ticket, bus on hire, car on hire, bus-ticket, buses to book, bus to book, book, Nepal online bus booking, Kathmandu pokhara touris bus in nepal">
        <title>Bus Ticketing</title> 

        <!-- attach CSS styles -->
        <link href="<?php echo base_url() . 'contents/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
        <link href="<?php echo base_url() . 'contents/styles/boot.css' ?>" rel="stylesheet" />

        <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() . "contents/styles/jquery-ui.css"; ?>"/>
        <script src="<?php echo base_url() . "contents/scripts/jquery1.10.2.js"; ?>"></script>
        <script src="<?php echo base_url() . "contents/scripts/jquery-ui.js"; ?>"></script>
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

            $('#sbutton').click(function() {
                var from = $('#from').val();
                var to = $('#to').val();
                var depDate = $('#CheckIn').val();
                if ((from == null) || (from == "") || (to == null) || (to == "") || (depDate == null) || (depDate == ""))
                {
                    $('.alert').css({'display': 'block'});
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'index.php/home/showBuses' ?>",
                        data: {
                            'from': from,
                            'to': to,
                            'depDate': depDate},
                        success: function(msg)
                        {
                            $('#myModal').html(msg);

                        }

                    });
                }
            });

            $(".close-error").click(function() {
                $('.alert').css({'display': 'none'});
            });
            
             $("#to").click(function() {
                $('.alert').fadeOut(1000);
            });
            
             $("#from").click(function() {
                $('.alert').fadeOut(1000);
            });
            
             $("#CheckIn").click(function() {
                $('.alert').fadeOut(1000);
            });
            
        });

    </script>
    <script>
        $(function() {
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


        !function($) {

            // Picker object

            var Datepicker = function(element, options) {
                this.element = $(element);
                this.format = DPGlobal.parseFormat(options.format || this.element.data('date-format') || 'mm/dd/yyyy');
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
                    if (this.component) {
                        this.component.on('click', $.proxy(this.show, this));
                    } else {
                        this.element.on('click', $.proxy(this.show, this));
                    }
                }

                this.minViewMode = options.minViewMode || this.element.data('date-minviewmode') || 0;
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
                this.viewMode = options.viewMode || this.element.data('date-viewmode') || 0;
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
                this.weekStart = options.weekStart || this.element.data('date-weekstart') || 0;
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
                    if (e) {
                        e.stopPropagation();
                        e.preventDefault();
                    }
                    if (!this.isInput) {
                    }
                    var that = this;
                    $(document).on('mousedown', function(ev) {
                        if ($(ev.target).closest('.datepicker').length == 0) {
                            that.hide();
                        }
                    });
                    this.element.trigger({
                        type: 'show',
                        date: this.date
                    });
                },
                hide: function() {
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
                        if (this.component) {
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
                place: function() {
                    var offset = this.component ? this.component.offset() : this.element.offset();
                    this.picker.css({
                        top: offset.top + this.height,
                        left: offset.left
                    });
                },
                update: function(newDate) {
                    this.date = DPGlobal.parseDate(
                            typeof newDate === 'string' ? newDate : (this.isInput ? this.element.prop('value') : this.element.data('date')),
                            this.format
                            );
                    this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
                    this.fill();
                },
                fillDow: function() {
                    var dowCnt = this.weekStart;
                    var html = '<tr>';
                    while (dowCnt < this.weekStart + 7) {
                        html += '<th class="dow">' + DPGlobal.dates.daysMin[(dowCnt++) % 7] + '</th>';
                    }
                    html += '</tr>';
                    this.picker.find('.datepicker-days thead').append(html);
                },
                fillMonths: function() {
                    var html = '';
                    var i = 0
                    while (i < 12) {
                        html += '<span class="month">' + DPGlobal.dates.monthsShort[i++] + '</span>';
                    }
                    this.picker.find('.datepicker-months td').append(html);
                },
                fill: function() {
                    var d = new Date(this.viewDate),
                            year = d.getFullYear(),
                            month = d.getMonth(),
                            currentDate = this.date.valueOf();
                    this.picker.find('.datepicker-days th:eq(1)')
                            .text(DPGlobal.dates.months[month] + ' ' + year);
                    var prevMonth = new Date(year, month - 1, 28, 0, 0, 0, 0),
                            day = DPGlobal.getDaysInMonth(prevMonth.getFullYear(), prevMonth.getMonth());
                    prevMonth.setDate(day);
                    prevMonth.setDate(day - (prevMonth.getDay() - this.weekStart + 7) % 7);
                    var nextMonth = new Date(prevMonth);
                    nextMonth.setDate(nextMonth.getDate() + 42);
                    nextMonth = nextMonth.valueOf();
                    var html = [];
                    var clsName,
                            prevY,
                            prevM;
                    while (prevMonth.valueOf() < nextMonth) {
                        if (prevMonth.getDay() === this.weekStart) {
                            html.push('<tr>');
                        }
                        clsName = this.onRender(prevMonth);
                        prevY = prevMonth.getFullYear();
                        prevM = prevMonth.getMonth();
                        if ((prevM < month && prevY === year) || prevY < year) {
                            clsName += ' old';
                        } else if ((prevM > month && prevY === year) || prevY > year) {
                            clsName += ' new';
                        }
                        if (prevMonth.valueOf() === currentDate) {
                            clsName += ' active';
                        }
                        html.push('<td class="day ' + clsName + '">' + prevMonth.getDate() + '</td>');
                        if (prevMonth.getDay() === this.weekEnd) {
                            html.push('</tr>');
                        }
                        prevMonth.setDate(prevMonth.getDate() + 1);
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
                    year = parseInt(year / 10, 10) * 10;
                    var yearCont = this.picker.find('.datepicker-years')
                            .find('th:eq(1)')
                            .text(year + '-' + (year + 9))
                            .end()
                            .find('td');
                    year -= 1;
                    for (var i = -1; i < 11; i++) {
                        html += '<span class="year' + (i === -1 || i === 10 ? ' old' : '') + (currentYear === year ? ' active' : '') + '">' + year + '</span>';
                        year += 1;
                    }
                    yearCont.html(html);
                },
                click: function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    var target = $(e.target).closest('span, td, th');
                    if (target.length === 1) {
                        switch (target[0].nodeName.toLowerCase()) {
                            case 'th':
                                switch (target[0].className) {
                                    case 'switch':
                                        this.showMode(1);
                                        break;
                                    case 'prev':
                                    case 'next':
                                        this.viewDate['set' + DPGlobal.modes[this.viewMode].navFnc].call(
                                                this.viewDate,
                                                this.viewDate['get' + DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate) +
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
                                    var year = parseInt(target.text(), 10) || 0;
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
                                if (target.is('.day') && !target.is('.disabled')) {
                                    var day = parseInt(target.text(), 10) || 1;
                                    var month = this.viewDate.getMonth();
                                    if (target.is('.old')) {
                                        month -= 1;
                                    } else if (target.is('.new')) {
                                        month += 1;
                                    }
                                    var year = this.viewDate.getFullYear();
                                    this.date = new Date(year, month, day, 0, 0, 0, 0);
                                    this.viewDate = new Date(year, month, Math.min(28, day), 0, 0, 0, 0);
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
                mousedown: function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                },
                showMode: function(dir) {
                    if (dir) {
                        this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + dir));
                    }
                    this.picker.find('>div').hide().filter('.datepicker-' + DPGlobal.modes[this.viewMode].clsName).show();
                }
            };

            $.fn.datepicker = function(option, val) {
                return this.each(function() {
                    var $this = $(this),
                            data = $this.data('datepicker'),
                            options = typeof option === 'object' && option;
                    if (!data) {
                        $this.data('datepicker', (data = new Datepicker(this, $.extend({}, $.fn.datepicker.defaults, options))));
                    }
                    if (typeof option === 'string')
                        data[option](val);
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
                dates: {
                    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                },
                isLeapYear: function(year) {
                    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0))
                },
                getDaysInMonth: function(year, month) {
                    return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month]
                },
                parseFormat: function(format) {
                    var separator = format.match(/[.\/\-\s].*?/),
                            parts = format.split(/\W+/);
                    if (!separator || !parts || parts.length === 0) {
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
                        for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
                            val = parseInt(parts[i], 10) || 1;
                            switch (format.parts[i]) {
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
                        date = new Date(year, month, day, 0, 0, 0);
                    }
                    return date;
                },
                formatDate: function(date, format) {
                    var val = {
                        d: date.getDate(),
                        m: date.getMonth() + 1,
                        yy: date.getFullYear().toString().substring(2),
                        yyyy: date.getFullYear()
                    };
                    val.dd = (val.d < 10 ? '0' : '') + val.d;
                    val.mm = (val.m < 10 ? '0' : '') + val.m;
                    var date = [];
                    for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
                        date.push(val[format.parts[i]]);
                    }
                    return date.join(format.separator);
                },
                headTemplate: '<thead>' +
                        '<tr>' +
                        '<th class="prev">&lsaquo;</th>' +
                        '<th colspan="5" class="switch"></th>' +
                        '<th class="next">&rsaquo;</th>' +
                        '</tr>' +
                        '</thead>',
                contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
            };
            DPGlobal.template = '<div class="datepicker dropdown-menu">' +
                    '<div class="datepicker-days">' +
                    '<table class=" table-condensed">' +
                    DPGlobal.headTemplate +
                    '<tbody></tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="datepicker-months">' +
                    '<table class="table-condensed">' +
                    DPGlobal.headTemplate +
                    DPGlobal.contTemplate +
                    '</table>' +
                    '</div>' +
                    '<div class="datepicker-years">' +
                    '<table class="table-condensed">' +
                    DPGlobal.headTemplate +
                    DPGlobal.contTemplate +
                    '</table>' +
                    '</div>' +
                    '</div>';

        }(window.jQuery);
    </script>
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-road" style="font-size:24px;"></i> Bus Sewa</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#information">Information</a></li>
                    <li><a href="#google_map">Contact</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


    <!-- first section - Home -->
    <div id="home" class="pad-section">
        <div style="background: rgba(0, 0, 0, 0.7); height: 100%; padding: 50px 0px;">
        <div class="container">
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Book Your Ticket Now</h2>
                        </div>
                        <div class="panel-body lead">

                            <style>


                                .close-error {
                                    float: right;
                                    font-size: 26px;
                                    font-weight: bold;
                                    line-height: 18px;
                                    color: #000000;
                                    text-shadow: 0 1px 0 #ffffff;
                                    opacity: 0.2;
                                    filter: alpha(opacity=20);
                                    padding-top: 5px;
                                    cursor: pointer;
                                }
                                .close-error:hover {
                                    color: #000000;
                                    text-decoration: none;
                                    opacity: 0.4;
                                    filter: alpha(opacity=40);
                                    cursor: pointer;
                                }

                                .alert {
                                    padding: 8px 35px 8px 14px;
                                    margin-bottom: 18px;
                                    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                                    background-color: #fcf8e3;
                                    border: 1px solid #fbeed5;
                                    -webkit-border-radius: 4px;
                                    -moz-border-radius: 4px;
                                    border-radius: 4px;
                                    color: #c09853;
                                }
                                .alert-error {
                                    background-color: #f2dede;
                                    border-color: #eed3d7;
                                    color: #b94a48;
                                }
                            </style>
                            <div class="alert alert-error" style="display:none;">

                                <span class="close-error">&times;</span>

                                <strong>Error!</strong> Please select from, to and date.

                            </div>


                            <!--from here-->
                            <div class="ui-widget">
                                <p><label for="from">From:</label><br/>
                                    <input class="textInput" placeholder="From" id="from" >
                                    <button type="button" style="margin-left:-10px; font-size: 1.05em;" data-toggle="datepicker"><i class="glyphicon glyphicon-map-marker"></i></button>
                                </p>
                            </div>
                            <div class="ui-widget">
                                <p><label for="to">To:</label><br/>
                                    <input class="textInput" placeholder="To" id="to" >
                                    <button type="button" style="margin-left:-10px;font-size: 1.05em;" data-toggle="datepicker"><i class="glyphicon glyphicon-map-marker"></i></button>
                                </p>
                            </div>
                            <p><label for="date">Date:</label><br/>
                                <input style="width: 52.5%"  class="textInput" id="CheckIn" type="text" value="" readonly="" name="CheckIn">
                                <button type="button" style="margin-left:-8px;font-size: 1.07em;" data-toggle="datepicker"><i class="glyphicon glyphicon-calendar"></i></button>
                            </p>
                            <input type="submit" style="width: 60%; padding: 5px;" value="Search Bus" id="sbutton"/>
                            <!--till here--> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /first section -->
    <div id="myModal" class="modal fade"></div>

    <!-- second section - About -->
    <div id="about" class="pad-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="images/logo.png" alt="" />
                </div>
                <div class="col-sm-6 text-center">
                    <h2>Booking Sewa is a registered online booking tool managed, developed and used by Namaste Nepal Yatayat Byabasai Sangh.</h2>
                    <p class="lead">Using this tool you can easily book our buses.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /second section -->


    <!-- third section - Services -->
    <div id="services" class="pad-section">
        <div class="container">
            <h2 class="text-center">Our Services</h2> <hr />
            <div class="row text-center">
                <div class="col-sm-3 col-xs-6">
                    <i class="glyphicon glyphicon-bold"> </i>
                    <h4>Bus Service</h4>
                    <p>We provide different types of bus services through out Nepal. We have variety of buses.</p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="glyphicon glyphicon-cutlery"> </i>
                    <h4>Fooding Service</h4>
                    <p>We offer fooding services to our valued customers through our associated hotels during travel</p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="glyphicon glyphicon-globe"> </i>
                    <h4>Online Ticketing</h4>
                    <p>We have facility of globally accessible online ticketing system. You can just book your seats from our web portal.</p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="glyphicon glyphicon-plane"> </i>
                    <h4>Tour Packages</h4>
                    <p>We have different tour packages and plans specially for domestic with cheap prive and best service. </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /third section -->


    <!-- fourth section - Information -->
    <div id="information" class="pad-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Additional information</h2>
                        </div>
                        <div class="panel-body lead">
                            Additional Text goes here. 
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Additional information</h2>
                        </div>
                        <div class="panel-body lead">
                            Additional Text goes here.  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /fourth section -->


    <!-- fifth section -->
    <div id="services" class="pad-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Contact Address</h1>
                    <h4>Namaste Nepal Yatayat Byabasi Sangh</h4>
                    <h4>Head Office : Koholpur, Banke</h4>
                    <h4>Phone No. : +977-56-532690</h4>
                    <h1>Location Map</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- /google map -->
    <style>
        #map-canvas {
            height: 450px;
            width: 95%;
            margin: 0% 2.5% 0% 2.5%;
            padding: 0px
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng(28.1990159, 81.686214);
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>


    <div id="map-canvas"></div>


    <!-- footer -->
    <footer>
        <hr />
        <div class="container">
            <p class="text-right">Copyright &copy; Bus Sewa 2014</p>
        </div>
    </footer>
    <!-- /footer -->

    <div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
            <i class="glyphicon glyphicon-chevron-up" style="font-size:24px;"></i>
        </span>
    </div>

    <!--for query-->

    <div style="position: fixed;bottom: 0;right: 4%;background:#5cb85c;display: inline;padding: 0.5%;font-weight:100;font-size: 18px;color:#FFF; width: 20%;">
        <span class="query"><span>Say your queries&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <i class="glyphicon glyphicon-chevron-up"></i></span>
        <div id="m-form" style="display: none !important;position: fixed;bottom: 5%;right: 4%;background:#5cb85c;padding:1% 1% 0% 1%;font-weight: bold;color:#FFF;width: 20%;">

            <form role="form">
                <p><b>Contact Us</b><span id="ajax-loading" class="pull-right" style="font-size: 8px; font-weight: 100;display: none;">submitting message<img src="<?php echo base_url() . 'content/images/loading.gif'; ?>" class="pull-right"></span></p>
                <div class='alert alert-success alert-dismissible' role='alert' id="alert-message" style="display: none;font-size:10px;">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <span class="glyphicon glyphicon-ok"></span> Message sucessfully sent. We will reply to you soon in your e-mail. Thank you!!!
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="naame" name="uName" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="uEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="3" id="message" name="uMsg" placeholder="Write your message to us!!!"></textarea>
                </div>
                <button type="button" class="btn btn-default" id="feedback-submit">Submit</button>
            </form>
        </div>
    </div>


    <script>

        $(function() {

            $(document).on('scroll', function() {

                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                }
            });
        });

        $(function() {

            $(document).on('scroll', function() {

                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                }
            });

            $('.scroll-top-wrapper').on('click', scrollToTop);
        });

        function scrollToTop() {
            verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
            element = $('body');
            offset = element.offset();
            offsetTop = offset.top;
            $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
        }
    </script>
    <style>
        .scroll-top-wrapper {
            position: fixed;
            opacity: 0;
            visibility: hidden;
            overflow: hidden;
            text-align: center;
            z-index: 99999999;
            background-color: #777777;
            color: #eeeeee;
            width: 40px;
            height: 40px;
            line-height: 28px;
            right: 5px;
            bottom: 5px;
            padding-top: 6px;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
        }
        .scroll-top-wrapper:hover {
            background-color: #888888;
        }
        .scroll-top-wrapper.show {
            visibility:visible;
            cursor:pointer;
            opacity: 1.0;
        }
        .scroll-top-wrapper i.fa {
            line-height: inherit;
        }

    </style>

    <!-- attach JavaScripts -->
    <script src="<?php echo base_url() . 'contents/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'contents/bootstrap/js/main.js'; ?>"></script>
    <script src="<?php echo base_url() . 'contents/scripts/jquery.easing.1.3.js' ?>"></script>
    <script>
        $('.query').on('click', function() {
            $('#m-form').slideToggle(2000, "easeOutBounce", function() {
            });

            $('#feedback-submit').click(function() {
                var valid = true;
                var name = $('#naame').val();
                var email = $('#email').val();
                var message = $('#message').val();
                var msg = "Your name is required !";
                if ((name == null) || (name == "") || (!name.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
                    $('#naame').focus();
                    $('#naame').style.border = "solid 1px red";
                    valid = false;
                }
                if ((email == null) || (email == "") || (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))) {
                    $('#email').focus();
                    $('#email').style.border = "solid 1px red";
                    valid = false;
                }
                if ((message == null) || (message == "")) {
                    $('#message').focus();
                    $('#message').style.border = "solid 1px red";
                    valid = false;
                }
                if (valid == false) {
                    $("#alert-message").css({'display': 'block'});
                    $("#alert-message").html(msg);
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'index.php/home/addMsg' ?>",
                        data: {
                            'name': name,
                            'email': email,
                            'message': message},
                        success: function(msgs)
                        {
                            $("#alert-message").css({'display': 'block'});
                            $("#alert-message").html(msgs);
                            $('#m-form').slideToggle(7000, "easeOutBounce", function() {
                            });
                        }

                    });
                }





            });








        });
    </script>
</body>
</html>
