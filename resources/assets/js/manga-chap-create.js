var app = new Vue({
    el: '#app',
    data: {
        name:'',
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
    }
});