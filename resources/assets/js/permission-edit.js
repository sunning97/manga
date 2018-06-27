var name = $('.page-title').data('name');
var app = new Vue({
    el: '#app',
    data: {
        name:name,
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSlug: function(str) {
            arr_str = str.split(' ');
            if(arr_str[0] == 'Xóa' || arr_str[0] == 'xóa' || arr_str[0] == 'Xoa' || arr_str[0] == 'xoa'){
                return str_slug('delete '+arr_str[1]);
            } else if(arr_str[0] == 'Thêm' || arr_str[0] == 'thêm' || arr_str[0] == 'Them' || arr_str[0] == 'them'){
                return str_slug('create '+arr_str[1]);
            } else if(arr_str[0] == 'Sửa' || arr_str[0] == 'sửa' || arr_str[0] == 'Sua' || arr_str[0] == 'sua'){
                return str_slug('update '+arr_str[1]);
            } else if(arr_str[0] == 'Xem' || arr_str[0] == 'xem'){
                return str_slug('read '+arr_str[1]);
            }
        },
    }
});
