var app = new Vue({
    el: '#app',
    data: {
        name:$('.page-title').data('name'),
        isChangeAvatar: false,
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
    }
});
$('#input-file-now').dropify();
