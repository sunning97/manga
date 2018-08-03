var app = new Vue({
    el:'#app',
    data:{
        roles:[],
        current_role: $('.active').data('role')
    },
    mounted(){
        this.getRoles();
    },
    methods:{
        getRoles:function () {
            axios.get('/admin/axios/roles').then(response=>{
                this.roles = response.data;
            });
        }
    }
});