var app = new Vue({
    el: '#app',
    data: {
        name:'',
        authors:[],
        genres:[],
        teams:[]
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
            axios.get('/admin/axios/authors').then(rs => {
                this.authors = rs.data;
            }).catch(e =>{});
        },
        getGenres: function () {
            axios.get('/admin/axios/genres').then(rs => {
                this.genres = rs.data;
            }).catch(e =>{});
        },
        getTeams: function () {
            axios.get('/admin/axios/translate-teams').then(rs => {
                this.teams = rs.data;
            }).catch(e =>{});
        }
    },
    mounted: function () {
        this.getAuthors();
        this.getGenres();
        this.getTeams();
    }
});
$('#input-file-now').dropify();
$(".select2").select2();
$('.summernote').summernote({
    height: 250,
    focus: false
});