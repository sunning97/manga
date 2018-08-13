<template>
    <div>
        <ul class="nav customtab2 nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" @click="admin('ACTIVE',1)"><a href="#home6" class="nav-link active" role="tab" data-toggle="tab"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Tài khoản đã kíck hoạt</span></a></li>
            <li role="presentation" class="nav-item" @click="admin('INACTIVE',1)"><a href="#profile6" class="nav-link" role="tab" data-toggle="tab"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Tài khoản chưa kích hoạt</span></a></li>
        </ul>
        <div class="tab-content">
            <div class="row">
                <input class="form-control" type="text" v-model="searchData" placeholder="Nhập vào tên, email, vai trò...">
            </div>
            <admin-list @changeBan="changeBan" :admins="admins" :permissions="permissions" :roles="roles" :url="url" :pagination="pagination" :searchResult="searchResult" :searchData="searchData" :isSearching="isSearching" :isAdminsEmpty="isAdminsEmpty"></admin-list>
            <pagination :pagination="pagination" :offset="offset" @click.native="getAdmins(state,pagination.current_page)" v-if="pagination.per_page < pagination.total && searchResult.length == 0 && searchData.length == ''"></pagination>
        </div>
    </div>
</template>

<script>
    import AdminList from './AdminList';
    import Pagination from './Pagination';
    export default {
        components:{
            'admin-list':AdminList,
            'pagination':Pagination
        },
        props:{
            url:{
                type:String,
            }
        },
        data(){
            return{
                searchData:'',
                searchResult:[],
                isSearching:false,
                admins:[],
                isAdminsEmpty:false,
                pagination:{},
                offset:3,
                roles:[],
                state:'ACTIVE',
                permissions:[]
            }
        },
        mounted(){
            this.checkPermission('delete-admins');
            this.checkPermission('update-admins');
            this.checkPermission('read-admins');
            this.getRoles();
            this.getAdmins(this.state,1);
        },
        watch:{
            searchData:function () {
                this.getSearch();
            }
        },
        methods:{
            getAdmins:function (state,page) {
                axios.post(`/admin/axios/get-admins?page=${page}`,{
                    state:state
                }).then(response=>{
                    this.admins = response.data.data;
                    this.pagination = response.data;
                    if(this.admins.length == 0) this.isAdminsEmpty = true;
                    else this.isAdminsEmpty = false;
                })
            },
            getRoles:function () {
                axios.get('/admin/axios/get-roles').then(response=>{
                    this.roles = response.data;
                })
            },
            getIndex:function (index) {
                return (this.pagination.current_page -1)*this.pagination.per_page + index +1;
            },
            admin:function (state) {
                this.state = state;
                this.admins = [];
                this.searchResult = [];
                this.searchData = '';
                this.getAdmins(this.state,1);
            },
            getSearch:function () {
                if(this.searchData == '')
                {
                    this.searchResult = [];
                    return;
                }
                this.isSearching = true;
                axios.post('/admin/axios/search-admin',{
                    data:this.searchData,
                    state:this.state
                }).then(response=>{
                    this.isSearching = false;
                    this.searchResult = response.data;
                }).catch(error=>{
                    this.isSearching = false;
                    this.isAdminsEmpty = true;
                    this.searchResult = [];
                });
            },
            checkPermission:function (permission) {
                axios.post('/admin/axios/admin/check-permission',{
                    permission:permission
                }).then(response=>{
                    if(response.data == 'ok'){
                        this.permissions.push(permission);
                    }
                });
            },
            changeBan:function (data) {
                var tmp = this;
                if(data.search){
                    tmp.searchResult[data.index].banned = data.ban;
                    tmp.admins.forEach(function (admin,index) {
                        (admin.id == data.admin.id) ? (tmp.admins[index].banned = data.ban) : (null);
                    });
                    return;
                }

                tmp.admins[data.index].banned = data.ban;
            }
        }
    }
</script>