var app = new Vue({
    el:'#app',
    data:{
        name:'',
        searchResult:[],
    },
    watch:{
        name:function () {
            this.getSearch();
        }
    },
    methods:{
        getSearch:function () {
            if(this.name == ''){
                this.searchResult = [];
                return;
            }

            axios.post('/admin/axios/role/search',{
                data:this.name
            }).then(response=>{
                this.searchResult = response.data;
            }).catch(error=>{
                this.searchResult = [];
            });
        }
    },
});