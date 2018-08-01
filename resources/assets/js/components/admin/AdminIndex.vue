<template>
    <div>
        <ul class="nav customtab2 nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" @click="admin('ACTIVE',1)"><a href="#home6" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Tài khoản đã kíck hoạt</span></a></li>
            <li role="presentation" class="nav-item" @click="admin('INACTIVE',1)"><a href="#profile6" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Tài khoản chưa kích hoạt</span></a></li>
        </ul>
        <div class="tab-content">
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
                    <tbody>
                        <admin-row v-for="(admin,index) in admins" :admin="admin" :index="getIndex(index)" :role="role(admin.role_id)"></admin-row>
                    </tbody>
                </table>
            </div>
            <pagination :pagination="pagination" :offset="offset" @click.native="getAdmins(state,pagination.current_page)"></pagination>
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
        data(){
            return{
                admins:[],
                pagination:{},
                offset:3,
                roles:[],
                state:'ACTIVE'
            }
        },
        mounted(){
            this.getRoles();
            this.getAdmins(this.state,1);
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
            }
        }
    }
</script>