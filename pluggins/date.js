	var myCalendar;
	function doOnLoad() {
			myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3","calendar4","calendar5","calendar6","calendar7","calendar8","calendar9","calendar10"]);
		}
	
$(function(){
	//$('form').form({
	//success:function(data){
				
		}
	});
});

//////
var $rows = $('.table tr');
$('.searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
//////
function doOnLoad()
{
window.history.forward()
}
	