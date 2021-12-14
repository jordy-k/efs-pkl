<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    $(function(){
        $('.disableButton').on('keyup change', function(){
            if ($('#new').val() != '' && $('#del').val() != '') {
                $('#submit_new').prop('hidden', true);
                $('#submit_del').prop('hidden', true);
                $('#submit_both').prop('hidden', false);
            } else {
                $('#submit_both').prop('hidden', true);
                if($('#new').val() == '' && $('#del').val() != '') {
                    $('#submit_new').prop('hidden', true);
                    $('#submit_del').prop('hidden', false);
                } else if($('#new').val() != '' && $('#del').val() == '') {
                    $('#submit_new').prop('hidden', false);
                    $('#submit_del').prop('hidden', true);
                } else if($('#new').val() == '' && $('#del').val() == '') {
                    $('#submit_new').prop('hidden', true);
                    $('#submit_del').prop('hidden', true);
                }
            }
        });
    });
</script>