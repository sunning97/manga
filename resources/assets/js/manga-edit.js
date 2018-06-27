var id = $('.page-title').data('id');
var app = new Vue({
    el: '#app',
    data: {
        name: $('.page-title').data('name'),
        isCoverChecked: false,
        authors:[],
        genres:[]
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
        getAuthors: function () {
            axios.get('/manga/axios/authors-notin/'+id).then(rs => {
                this.authors = rs.data;
            }).catch(e =>{});
        },
        getGenres: function () {
            axios.get('/manga/axios/genres-notin/'+id).then(rs => {
                this.genres = rs.data;
            }).catch(e =>{});
        }
    },
    mounted: function () {
        this.getAuthors();
        this.getGenres();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();