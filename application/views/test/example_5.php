<form>   
<input class="disableButton" id="email" type="email" />         
<input class="disableButton" id="pass" type="password" />
<select id="state" class="selected-state disableButton" >
    <option value="">State</option>
    <option value="AL">AL</option>
    <option value="AK">AK</option>
    ...
</select>
<input id="emailPassSubmit" type="submit" disabled="disabled" value="test" />
</form>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
	$(function(){
        $('.disableButton').on('keyup change', function(){
            if ($('#email').val() == '' || $('#pass').val() == '' || $('#state').val() == '') {
                    $('#emailPassSubmit').prop('disabled', true);
            } else {
                    $('#emailPassSubmit').prop('disabled', false);
            }
        });
    });
</script>