$(document).ready(function() {
	   
$("#vm").click(function() {
						$("#loading").html("Loading Virtual Machines :)");
						   $("#loading").show();
						   $("#loading").animate({"width": "100%"},(1000), function(){
																				    $.get("includes/ajax.php", { action:"vmlist"}, function(data){
																													   
																								$("#main").html(data);
																								$("#loading").html("Virtual Machines Loaded!");
																								$("#loading").animate({"width": "0%"},(1000), function() {$("#loading").hide();
																																											 
																																											 
																																											 });
																								
																													   })
																				   
																				   });

     

						   
					
						  
						   
						   });
$("#os").click(function() {
						   
						   
						$.get("includes/ajax.php", { action:"images"}, function(data){
															   
										$("#main").html(data);
										
															   })
						   
						   });
$("#pkgs").click(function() {
						   
						   
						$("#main").html("Display Packages to create new Virtual Machines ");
						   
						   });
$("#si").click(function() {
						   
						   
						$("#main").html("Show Server information and current Memory and HDD usage :)");
						   
						   });
						   
						   
						   
						   

$(".start").live("click", function(){
						   
						    start_this = this.id;
								
								start_this=start_this.substr(6,10);
  $("#loading").html("Trying to start Virtual Machine ("+start_this+")");
 $("#loading").show();
						   $("#loading").animate({"width": "100%"},(2000), function(){
																				   
																				   
																				    $.get("includes/vzdo.php", { action:"start", id:start_this}, function(data){
																													   
										$("#loading").html(data);
										$("#loading").animate({"width": "0%"},(200));
										$("#loading").html(data);
										$("#loading").animate({"width": "100%"},(2000), function(){
										$("#loading").animate({"width": "0%"},(2000), function(){
										$("#loading").hide();														
																								
																								});													
																								
																								});
										
										
										  $.get("includes/ajax.php", { action:"vmlist"}, function(data){
															   
										$("#main").html(data);
										
															   })
										
															   })
																				   
																				   });

     
						   
						   });

$(".stop").live("click", function(){
						   
						    stop_this = this.id;
								
								stop_this=stop_this.substr(5,10);

						   
						   });

$(".restart").live("click", function(){
						   
						    restart_this = this.id;
								
								restart_this=restart_this.substr(8,12);

						   
						   });

$(".suspend").live("click", function(){
						   
						    suspend_this = this.id;
								
								suspend_this=suspend_this.substr(8,12);

						   
						   });


imgid=1;
$(".createvm").live("click" , function(){
						 
						thisid = this.id;
						imgid = this.id;
						imgname=$("#"+thisid).attr("image");
						logo=$("#"+thisid).attr("src");
						
						  $("#main").html('<form name="createform">Hostname:<input type="text" id="hname" name="hostname"><br>Os Image: <img src="logos/'+logo+'">'+imgname+'<br>Root Password: <input type="text" id="password" name="password"><br>IP Address: <input type="text" id="ip" name="ip"><input type="button" value="Create it Now SoloWiz!" id="crtbutton" name="createit"></form>');
						 
						 
						 });

$("#crtbutton").live("click" , function(){
						 hname=$("#hname").attr("value");	
						  password=$("#password").attr("value");
						   ip=$("#ip").attr("value");

							
						  
																			
						   $("#loading").html("Trying to Create a VM ");
 $("#loading").show();
						   $("#loading").animate({"width": "100%"},(2000), function(){
									   
																				    $.get("includes/vzdo.php", { action:"create", hostname:hname,hdd:20,password:password,ip:ip,template:imgid}, function(data){
																													   
										$("#loading").html(data);
										$("#loading").animate({"width": "0%"},(200));
										$("#loading").html(data);
										$("#loading").animate({"width": "100%"},(2000), function(){
										$("#loading").animate({"width": "0%"},(2000), function(){
										$("#loading").hide();														
																								
																								});													
																								
																								});
										
										
										 
										
															   });
																				   
																				   });

						 
						 });



 });