Vue.component('admin-index',require('./components/admin/AdminIndex'));
var app = new Vue({
    el:'#app',
    data:{
        url:$('.active').data('url')
    }
});