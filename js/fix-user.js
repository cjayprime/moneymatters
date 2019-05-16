$(document).ready(function(){
    
    //Accounts
    SelectedFiles = [];
    $('.save').click(function(){
        var self = $(this);
        var id = self.parent('div').prev('div').children('input').attr('id');
        var value = $('#'+id).val();
        var data = {type: 'upload', command: 'edit', id: 'account'};
        data[id] = value;

        var formdata = new FormData();
        if(id == 'profilepicture'){
            //PICTURES
            if(SelectedFiles.length > 0){
                formdata.append('profilepicture',SelectedFiles[0]);
                for(var key in data)formdata.append(key,data[key]);
            }else{
                inputError(self,'You need to select a file');
                return;
            }
        }else if(id == 'password'){
            if($('#password').val().length > 0 && ($('#password').val() == $('#repeat-password').val())){
                for(var key in data)formdata.append(key,data[key]);
            }else{
                if(!($('#password').val() == $('#repeat-password').val()))
                inputError(self,'Both fields must be the same');
                if($('#password').val().length == 0)
                inputError(self,'You need to fill in the field');
                return;
            }
        }else{
            if(value.length > 0){
                for(var key in data)formdata.append(key,data[key]);
            }else{
                inputError(self,'You need to fill in the field');
                return;
            }
        }

        $.ajax({url: 'action.php',data: formdata,
            method:'POST',
            dataType:"json",
            success:function(res,status,xhr){
                console.log(res);
                if(res.success)
                uploadSuccess(self,res.message)
                else
                uploadSuccess(self,res.message+' An error occurred, check the form and try again.')
            },
            error:function(res,status,xhr){
                console.log(res.responseText);
                uploadSuccess(self,res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
            },
            contentType: false,
            processData: false
        });
    });
    $('input[type=file]').change(function(e){
        var obj = $('.save').eq(0);
        var files = e.target.files;
        for(var i = 0; i < files.length; i++){
            var reader = new FileReader();
            var f = files[i];
            if(f.size <= 153600 && (f.type == 'image/png' || f.type == 'image/jpg' || f.type == 'image/jpeg')){
                uploadSuccess(obj,'Selected file accepted');
                SelectedFiles.push(f);
            }else if(f.size > 153600){
                //Size Error
                uploadError(obj,'Size Error: The size of this image ('+f.name+') is too large','The maximum size for an image file is 150KB.');
            }else if(f.type != 'image/png' && f.type != 'image/jpg' && f.type != 'image/jpeg'){
                //Type Error
                uploadError(obj,'Size Error: The type of this image ('+f.name+') is not ".png" or "jp(e)g"','The file type for images must be "png" or "jp(e)g"');
            }
        }
    });
    function inputError(obj,txt){
        var p = obj.parent('div').prevAll('p').css({color:'red'});
        p.text(txt);
    }
    function uploadSuccess(obj,txt){
        var p = obj.parent('div').prevAll('p').css({color:'grey'});
        p.text(txt);
    }
    function uploadError(obj,txt){
        var p = obj.parent('div').prevAll('p').css({color:'red'});
        p.text(txt);
    }





    //Notifications
    $(document).on('ifChanged','input.icheck',function(){
        var id = $(this).data('notice');
        console.log(id)
        if(id)
        $.ajax({url: 'action.php',data: {command:'switch',type:'notifications',id:id, currentStatus: $(this).prop('checked')},
            method:'POST',
            dataType:"json",
            success:function(res,status,xhr){
                console.log(res);
                $('.theme-account-notifications-title').eq(1).text(res.message);
            },
            error:function(res,status,xhr){
                console.log(res.responseText);
                $('.theme-account-notifications-title').eq(1).text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
            },
        });
    });
    

    //Sign up
    $('#signup').click(function(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var othernames = $('#othernames').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var password = $('#password').val();
        var repeatpassword = $('#repeat-password').val();
        
        var success = {border:'1px solid #dedede'};
        var error = {border:'1px solid red'};
        
		if(firstname == ''){
			$('#firstname').css(error);
            return;
		}else $('#firstname').css(success);
		
		if(lastname == ''){
			$('#lastname').css(error);
            return;
		}else $('#lastname').css(success);
		
		if(othernames == ''){
			$('#othernames').css(error);
            return;
		}else $('#othernames').css(success);
		
		if(email == ''){
			$('#email').css(error);
            return;
		}else $('#email').css(success);
		
		if(phone == ''){
			$('#phone').css(error);
            return;
		}else $('#phone').css(success);
		
		if((password == '' || repeatpassword == '') || (password != repeatpassword)){
            if(password != repeatpassword)
            $('#password,#repeat-password').css(error);
            
		    if(password == '')
            $('#password').css(error);
            
            if(repeatpassword == '')
            $('#repeat-password').css(error);
            
            return;
		}else{
            $('#password,#repeat-password').css(success);
        }
		
		if(firstname && lastname && othernames && email && phone && password){
            var data = {type: 'upload', command: 'create', id: 'account', firstname: firstname, lastname: lastname, othernames: othernames, email: email, phone: phone, password: password};
            $.ajax({url: 'action.php',data: data,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res);
                    if(res.success)
                    window.location = 'account.php';
                    else
                    $('#error').text(res.message+' An error occurred, check the form and try again.');
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                    $('#error').text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
                }
            });
        }
    });

    //Sign in
    $('#signin').click(function(){
        var email = $('#email').val();
        var password = $('#password').val();
        
        var success = {border:'1px solid #dedede'};
        var error = {border:'1px solid red'};
        
		if(email == ''){
			$('#email').css(error);
            return;
		}else $('#email').css(success);
		
		if(password == ''){
			$('#password').css(error);
            return;
		}else $('#password').css(success);
		
		if(email && password){
            var data = {type: 'upload', command: 'confirm', id: 'account', email: email, password: password};
            $.ajax({url: 'action.php',data: data,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res);
                    if(res.success)
                    window.location = 'account.php';
                    else
                    $('#error').text(res.message+' An error occurred, check the form and try again.');
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                    $('#error').text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
                }
            });
        }
    });


});

