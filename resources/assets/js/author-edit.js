var vue = new  Vue({
    el: '#app',
    data:{
        name:'',
    },
    mounted(){
        this.getAuthor();
    },
    methods:{
        getAuthor:function () {
            this.name = $('.active').data('name');
        },
        getSlug:function (str) {
            return str_slug(str);
        }
    }
});