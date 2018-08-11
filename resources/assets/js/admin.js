Vue.component('admin-index',require('./components/admin/adminIndex/AdminIndex'));
var app = new Vue({
    el:'#app',
    data:{
        url:$('.active').data('url')
    }
});