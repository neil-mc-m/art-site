/**
 * Created by neil on 26/07/2016.
 */
$(document).ready(function(){
    $("#large-view").click(function(){
        $("#view").css("column-count", "3");
    });
   
    $("#small-view").click(function(){
        $("#view").css("column-count", "8");
    });
});