var app = new Vue({
    el: '#app',
    data: {
        name: $('#team-name').data('name') ? $('#team-name').data('name') : '',
        isUseDefault: true,
        users:[],
        a: $('#leader').data('leader') ? $('#leader').data('leader') : '',
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
        },
        getUsers:function () {
            axios.get('/manga/axios/users').then(rs => {
                this.users = rs.data;
            }).catch(e =>{});
        },
        qwe: function (a){
            return true;
        }
    },
    mounted: function () {
        this.getUsers();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();
