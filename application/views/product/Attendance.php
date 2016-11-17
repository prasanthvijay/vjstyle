
<style>table.newsheet
{
    width: 90%;
    font-family: Arial, sans-serif;
}

table.newsheet th
{
    background-color: #25587e;
    color: white;
    padding: 5px;
}

table.newsheet td
{
    padding: 10px;
    margin: 0;
}

.rollno
{
    width: 10%;
    border: 1px solid gray;
    text-align: center;
    vertical-align: middle;
}

.userinfo
{
    width: 40%;
    border: 1px solid gray;
}

.att-record
{
    width: 5%;
    border: 1px solid gray;
    font-weight: bold;
}

span.present
{
    color: green;
}

span.absent
{
    color: red;
}

</style>
<div class= "container">
<br><br><br><br><br><br><br><br>
<table class="newsheet">
    <tr class="header">
        <th>Roll#</th>
        <th>Student</th>
        <th class="date-header" cname="12Sep2013">12-Sep</th>
    </tr>
    <tr uid="1" class="userrow">
        <td class="rollno">47</td>
        <td class="userinfo">Jatin Shah (jatinsh)</td>
        <td class="att-record 12Sep2013"><span class="present">P</span></td>
    </tr>
    <tr uid="2" class="userrow">
        <td class="rollno">47</td>
        <td class="userinfo">Vidhi Desai (vadesai)</td>
        <td class="att-record 12Sep2013"><span class="absent">A</span></td>
    </tr>
    <tr uid="3" class="userrow">
        <td class="rollno">47</td>
        <td class="userinfo">Arjun Shah (arjun)</td>
        <td class="att-record 12Sep2013"><span class="present">P</span></td>
    </tr>
    <tr uid="4" class="userrow">
        <td class="rollno">47</td>
        <td class="userinfo">Ankini Shah (ankini)</td>
        <td class="att-record 12Sep2013"><span class="absent">A</span></td>
    </tr>
    <tr uid="5" class="userrow">
        <td class="rollno">47</td>
        <td class="userinfo">Abhijit Deshmukh (abdesh)</td>
        <td class="att-record 12Sep2013"><span class="present">P</span></td>
    </tr>
</table>


<input type="text" size="10" class="datepicker" id="att-date" />
<a href="#" id="add_sheet">Add</a>
<a href="#" id="dump_sheet">Dump</a> 

<script>
$('.datepicker').datepicker({'dateFormat':'d-M-yy'});

function getDateMonthFromDate(datestr)
{
    //split them
    var tokens = datestr.split('-');
    
    //join first two
    return tokens[0] + '-' + tokens[1];
}

function getDateBasedClassName(datestr)
{
    var tokens = datestr.split('-');
    return tokens[0] + tokens[1] + tokens[2];
}

$('.att-record').live('click',function(){
    var pora = $(this).find('span').text();
    if(pora === 'A') {
        $(this).find('span').removeClass('absent').addClass('present').text('P');
    }
    else if(pora === 'P'){
        $(this).find('span').removeClass('present').addClass('absent').text('A');        
    }

});

$('#add_sheet').click(function(event){
    event.preventDefault();
        
    var date = $('#att-date').val();
    
    if(date.length == 0) {
        alert('Please probvide date');
        return;
    }
    
    var title = getDateMonthFromDate(date);
    var className = getDateBasedClassName(date);
    
    //create a header row
    $('<th></th>').addClass('date-header').attr({'cname':className}).append(title).appendTo('table.newsheet tr.header');
    
    
    
    $('table.newsheet tr.userrow').each(function(){
        var span = $('<span></span>').addClass('present').text('P');
        var td = $('<td></td>').addClass('att-record').addClass(className);
        span.appendTo(td);
        td.appendTo($(this));
    });
});


$('#dump_sheet').click(function(event){
    event.preventDefault();
    
    //get class names of interested
    $('table.newsheet tr.header th.date-header').each(function(){
        var dateOfAttendance = $(this).attr('cname');
        var present = [];
        //for this date find the users who are present
        $('table.newsheet tr.userrow').each(function(){
            var pora = $(this).find('.' + dateOfAttendance + ' span').text();
            if(pora === 'P')
                present.push(parseInt($(this).attr('uid')));
        });
        
        console.log(dateOfAttendance + " : " + present.join('-'));
    });
    
});</script>
