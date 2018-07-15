var app = new Vue({
    el: '#wrapper',
    methods:{
        sendEmail: function (event) {
            event.preventDefault();
            var email = $('#email').val();
            if(email.length == 0){
                $('#notice').html('<div class="text-danger ml-2"><b>Vui lòng nhập email!</b></div>');
            } else {
                axios.post($(event.path[0]).data('url'), {
                    email: $('#email').val()
                }).then(rs => {
                    if (rs.data == 'ok') {
                        $('#notice').html('<div class="text-success ml-2"><b>Mail đã được gửi! Vui lòng kiểm tra hòm thư của bạn</b></div>');
                        $('#input').remove();
                    } else {
                        let html = '';
                        $.each(rs.data, function (k, i) {
                            html += '<div class="text-danger ml-2"><b>' + i + '</b></div>'
                        });
                        $('#notice').html(html);
                    }
                }).catch(e => {})
            }
        }
    },
});