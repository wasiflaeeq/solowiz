$(document).ready(function() {
	 $('.err').delay(5000).slideUp('slow'); 
	 $('.msg').delay(5000).slideUp('slow'); 
var	 errclr= "#F36";
	 
	var alphaExp = /^[a-zA-Z]+$/;
	var ip = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
	var netmask =/((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}0/;
	var num = /^[0-9e]+$/;
	
	var email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	$("input").keyup(function(){

		
						inputid = this.id;
						checkthis=$("#"+inputid).attr("checkthis");
						if(checkthis=="alpha")
						{
								if(this.value.match(alphaExp)){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');
						
						
								this.focus();
								
							}
							
						}
						else
						if(checkthis=="ip")
						{

								if(this.value.match(ip)){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');
						
						
								this.focus();
								
							}
							
						}
						else
						if(checkthis=="netmask")
						{

								if(this.value.match(netmask)){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');
						
						
								this.focus();
								
							}
							
						}
						
						else
						
						if(checkthis=="num")
						{
								if(this.value.match(num)){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');

						
						
					this.focus();
								
							}
							
						}
						else
						if(checkthis=="email")
						{
								if(this.value.match(email)){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');

						
						
					this.focus();
								
							}
							
						}
		else if(checkthis=="req")
						{
							
								if(this.value.length>5){
								$(this).css('color', 'green')
								$(this).css('background-color', 'white')
								$("#mysubmit").removeAttr('disabled');
								$("#changepass").removeAttr('disabled');
						
						
							}else{
								
						
						//$(this).css('color', errclr)
						$(this).css('color', 'black')
						$(this).css('background-color', errclr)
						$("#mysubmit").attr('disabled','disabled');
						$("#changepass").attr('disabled','disabled');

						
						
					this.focus();
								
							}
						}
				
	})

	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 });