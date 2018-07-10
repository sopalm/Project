<script>
	$(document).ready(function() {
		$('.edit-sup').click(function(){
                var supID = $(this).attr('data-supID');
                var tag = $(this).attr('data-tag');
                $('#supID').val(supID);
                $('#tag').val(tag);
        } );
    } );
</script?