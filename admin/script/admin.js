// JavaScript Document
$(document).ready(function(e){
	//Resize
	$(".main-container").height(
		$(window).height()-
		$(".header").outerHeight()-
		$(".module-tool").outerHeight()-
		$(".footer").outerHeight()-
		$(".mheader").outerHeight()-20);
	//Checkbox
	$(".module-list .check-all").change(function(e){
		$(".module-list .check-item").prop("checked",$(this).prop("checked")).each(function(index, element) {
			($(this).prop("checked"))?$(this).parent().parent("tr").addClass("checked"):$(this).parent().parent("tr").removeClass("checked");
		});;
	});
	$(".module-list .check-item").change(function(e){
		($(this).prop("checked"))?$(this).parent().parent("tr").addClass("checked"):$(this).parent().parent("tr").removeClass("checked");
	});
	
	$(".sortable tbody").sortable({handle: 'td:first'}).disableSelection();
	$(".sortable tr").each(function(index, element) {
        $(element).find("td:first").addClass("handle");
    });
});