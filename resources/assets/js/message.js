$(window).load(function () {
    Vue.component('message-box', require('./components/MessageBox.vue'));
    new Vue({
        el:'#app',
    });
});




