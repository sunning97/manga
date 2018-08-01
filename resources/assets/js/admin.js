var app = new Vue({
    el:'#app',
    data:{
        adminActive:[]
    },
    mounted(){
        this.getAdmins('ACTIVE');
    },
    methods:{
        getAdmins:function (type) {
            axios.post('/admin/axios/get-admins',{
                state:type
            }).then(respone=>{
                this.adminActive = respone.data;
            })
        }
    }
});