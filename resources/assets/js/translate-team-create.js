var app = new Vue({
    el: '#app',
    data: {
        name:'',
        isUseDefault: true,
        users:[]
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
        }
    },
    mounted: function () {
        this.getUsers();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();
