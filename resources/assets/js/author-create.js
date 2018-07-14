var data = ($('#author-name').data('name')) ? $('#author-name').data('name') : '';
var app = new Vue({
    el: '#app',
    data: {
        name: ($('#author-name').data('name')) ? $('#author-name').data('name') : ''
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
        }
    }
});