<template>
    <div>
        <ul class="nav customtab2 nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" @click="admin('ACTIVE',1)"><a href="#home6" class="nav-link active" role="tab" data-toggle="tab"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Tài khoản đã kíck hoạt</span></a></li>
            <li role="presentation" class="nav-item" @click="admin('INACTIVE',1)"><a href="#profile6" class="nav-link" role="tab" data-toggle="tab"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Tài khoản chưa kích hoạt</span></a></li>
        </ul>
        <div class="tab-content">
            <div class="row">
                <input class="form-control" type="text" v-model="searchData">
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ & tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody v-if="isSearching">
                        <tr>
                            <td colspan="5">đang tìm kiếm..</td>
                        </tr>
                    </tbody>
                    <tbody v-if="searchResult.length == 0 && searchData.length != '' && isSearching == false">
                        <tr>
                            <td colspan="5">Không tìm thấy</td>
                        </tr>
                    </tbody>
                    <tbody v-if="searchResult.length == 0 && searchData.length == ''">
                        <admin-row v-for="(admin,index) in admins" :admin="admin" :index="getIndex(index)" :role="role(admin.role_id)" :url="url" :permissions="permissions"></admin-row>
                    </tbody>
                    <tbody v-if="searchResult.length > 0 && searchData.length != ''">
                        <admin-row v-for="(admin,index) in searchResult" :admin="admin" :index="getIndex(index)" :role="role(admin.role_id)" :url="url"></admin-row>
                    </tbody>
                </table>
            </div>
            <pagination :pagination="pagination" :offset="offset" @click.native="getAdmins(state,pagination.current_page)" v-if="pagination.per_page < pagination.total && searchResult.length == 0 && searchData.length == ''"></pagination>
        </div>
    </div>
</template>

<script>
    import AdminRow from './AdminRow';
    import Pagination from './Pagination';
    export default {
        components:{
            'admin-row':AdminRow,
            'pagination':Pagination
        },
        props:{
            url:{
                typr:String,
            }
        },
        data(){
            return{
                searchData:'',
                searchResult:[],
                isSearching:false,
                admins:[],
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
                })
            },
            getRoles:function () {
                axios.get('/admin/axios/get-roles').then(response=>{
                    this.roles = response.data;
                })
            },
            role:function (id) {
                for(var i = 0;i<this.roles.length;i++)
                {
                    if(this.roles[i].id == id) return this.roles[i].name;
                }
                return 'Chưa phân vai trò';
            },
            getIndex:function (index) {
                return (this.pagination.current_page -1)*this.pagination.per_page + index +1;
            },
            admin:function (state) {
                this.state = state;
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
            }
        }
    }
</script>