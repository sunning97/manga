var app = new Vue({
    el: '#app',
    data: {
        name:'',
        mangas:[]
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
        getMangas: function(){
            axios.get('/manga/axios/mangas').then(rs => {
                this.mangas = rs.data;
            }).catch(e =>{});
        }
    },mounted: function () {
        this.getMangas();
    }
});

$(".select2").select2();
