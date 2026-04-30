<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(handleNotification, 10000);
    });

    function handleNotification() {
        $.ajax({
            url: "{{ route('conversations.notifications') }}",
            type: 'get',
            success: function(data) {
                $(document).find('.notifications-wrapper').html(data.html);
            },
            complete: function() {
                setTimeout(handleNotification, 10000);
            }
        });
    }
</script>
