@if($errors->any())
<script>
    $.toast({
        heading: 'Thông báo!',
        text: '@foreach ($errors->all() as $mess) {{ $mess }} <br>@endforeach',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'error',
        hideAfter: 3500
    });
</script>
@endif