@if(session('success'))
    <script>
        $.toast({
            heading: 'Thành công!',
            text: '@foreach (session('success') as $mess) {{ $mess }} <br>@endforeach',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        });
    </script>
@endif