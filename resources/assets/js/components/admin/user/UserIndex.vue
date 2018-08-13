<template>
    <div>
        <ul class="nav customtab2 nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" @click="changeState('ACTIVE')"><a href="#home6" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Thành viên đã xác thực</span></a></li>
            <li role="presentation" class="nav-item" @click="changeState('INACTIVE')"><a href="#profile6" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Thành viên chưa xác thực</span></a></li>
        </ul>
        <div class="col-md-12 mt-5 mb-5">
            <input type="text" class="form-control" placeholder="Nhập tên..." v-model="searchInput">
        </div>
        <list-user :url="url" :users="users" :pagination="pagination" :permissions="permissions" :searchUsers="searchResult" :searchInput="searchInput" :isSearching="isSearching"></list-user>
        <pagination :pagination="pagination" :offset="offset" v-if="pagination.per_page < pagination.total && searchInput == ''" @page="changePage"></pagination>
    </div>
</template>
<script>
    import Pagination from './Pagination';
    import Listuser from './ListUser';
    export default {
        props:{
            url:{
                type:String,
                default:''
            }
        },
        data(){
            return {
                users:[],
                permissions:[],
                state:'ACTIVE',
                pagination:{},
                offset:3,
                searchInput:'',
                searchResult:[],
                isSearching:false
            }
        },
        mounted(){
            this.getPermission('update-users');
            this.getPermission('delete-users');
            this.getUsers(this.state,1);
        },
        watch:{
            searchInput:function () {
                this.isSearching = true;
                this.getSearch();
            }  
        },
        methods:{
            getUsers: function (state,page) {
                axios.post(`/admin/axios/get-users?page=${page}`,{
                    state:state
                }).then(response => {
                    this.pagination = response.data;
                    this.users = response.data.data;
                }).catch(error => {

                })
            },
            getPermission:function(permission)
            {
                axios.post('/admin/axios/admin/check-permission',{
                    permission:permission
                }).then(response=>{
                    if(response.data == 'ok')
                        this.permissions.push(permission);
                })
            },
            changePage:function (page) {
                this.pagination.current_page = page;
                this.getUsers(this.state,page);
            },
            changeState:function (state) {
                this.state = state;
                this.getUsers(state,1)
            },
            getSearch:function () {
                if(this.searchInput == ''){
                    this.searchResult = [];
                    this.isSearching = false;
                    return;
                }

                axios.post('/admin/axios/search-user',{
                    state:this.state,
                    data:this.searchInput
                }).then(response=>{
                    this.searchResult = response.data;
                    this.isSearching = false
                }).catch(error=>{
                    this.searchResult = [];
                    this.isSearching = false
                })
            }
        },
        components:{
            'pagination':Pagination,
            'list-user':Listuser
        }
    }
</script>