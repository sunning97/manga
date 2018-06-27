var name = $('.page-title').data('name');
var id = $('.page-title').data('id');
var app = new Vue({
    el: '#app',
    data: {
        name:name,
        perSelected: []
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
        getPermission: function(){
            axios.get('/manga/axios/permissions/'+id).then(rs => {
                this.perSelected = rs.data;
            }).catch(e =>{});
        }
    },mounted: function () {
        this.getPermission();
    }
});

$(".select2").select2();
