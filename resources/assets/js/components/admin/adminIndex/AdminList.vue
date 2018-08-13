<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Họ & tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody v-if="searchResult.length == 0 && searchData == ''">
                    <tr v-for="(admin,index) in admins">
                        <td>{{ getIndex(index) }}</td>
                        <td>{{ admin.f_name+' '+ admin.l_name }}</td>
                        <td>{{ admin.email }}</td>
                        <td>{{ role(admin.role_id) }}</td>
                        <td class="click" @click="changeBan(admin,index)"><b :class="`text-${(admin.banned == 'T') ? 'danger' : 'success'}`">{{ getState(admin.banned) }}</b></td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a :href="url+'/'+admin.id" class="btn btn-sm btn-success" v-if="checkPermission('read-admins')">Xem <i class="ti-eye"></i></a>
                                <a :href="url+'/'+admin.id+'/edit'" class="btn btn-sm btn-primary" v-if="checkPermission('update-admins')">Vai trò <i class="ti-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" v-if="checkPermission('delete-admins')">Xóa <i class="ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody v-if="searchResult.length > 0 && searchData != ''">
                    <tr v-for="(admin,index) in searchResult">
                        <td>{{ getIndex(index) }}</td>
                        <td>{{ admin.f_name+' '+ admin.l_name }}</td>
                        <td>{{ admin.email }}</td>
                        <td>{{ role(admin.role_id) }}</td>
                        <td class="click" @click="changeBan(admin,index)"><b :class="`text-${(admin.banned == 'T') ? 'danger' : 'success'}`">{{ getState(admin.banned) }}</b></td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a :href="url+'/'+admin.id" class="btn btn-sm btn-success" v-if="checkPermission('read-admins')">Xem <i class="ti-eye"></i></a>
                                <a :href="url+'/'+admin.id+'/edit'" class="btn btn-sm btn-primary" v-if="checkPermission('update-admins')">Vai trò <i class="ti-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" v-if="checkPermission('delete-admins')">Xóa <i class="ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody v-if="searchResult.length == 0 && searchData != ''">
                    <tr class="text-center">
                        <td colspan="5">Không tìm thấy</td>
                    </tr>
                </tbody>
                <tbody v-if="isSearching == true && isAdminsEmpty == false">
                    <tr>
                        <td colspan="5">Đang tìm kiếm...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            url:{
                type:String,
                default:''
            },
            roles:{
                type:Array,
                default:[],
                required:true
            },
            admins:{
                type:Array,
                default:[]
            },
            permissions:{
                type:Array,
                default:[]
            },
            pagination:{
                type:Object,
                default:{},
                require:true
            },
            searchResult:{
                type:Array,
                default:[]
            },
            searchData:{
                type:String,
                default:''
            },
            isSearching:{
                type:Boolean,
                default:false
            },
            isAdminsEmpty:{
                type:Boolean,
                default:false
            }
        },
        methods:{
            role:function (id) {
                for(var i = 0;i<this.roles.length;i++)
                {
                    if(this.roles[i].id == id) return this.roles[i].name;
                }
                return 'Chưa phân vai trò';
            },
            checkPermission:function (str) {
                return (this.permissions.indexOf(str) > -1) ? (true) : (false)
            },
            getIndex:function (index) {
                return (this.pagination.current_page -1)*this.pagination.per_page + index +1;
            },
            getState:function (state) {
                return (state == 'T') ? 'Bị cấm' : 'Hoạt động'
            },
            changeBan:function (admin,index) {
                var tmp = this;
                if(tmp.searchResult.length > 0){
                    swal({
                        title: "Xác nhận hành động",
                        text: (admin.banned == 'T') ? "Bỏ cấm tài khoản này?" :"Cấm tài khoản này?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: (admin.banned == 'T') ? "Bỏ cấm" : "Cấm",
                        closeOnConfirm: true
                    }, function(){
                        axios.post('/admin/axios/ban-account',{
                            account_type:'admin',
                            account_id:admin.id,
                            ban:(admin.banned == 'T') ? 'F' : 'T'
                        }).then(rs => {
                            tmp.$emit('changeBan',{
                                search:true,
                                index:index,
                                admin:admin,
                                ban:(admin.banned == 'T') ? 'F' : 'T'
                            });
                            swal("Thành công", (admin.banned == 'T')? "Đã bỏ cấm tài khoản" : "Đã cấm tài khoản", "success");
                        }).catch(e =>{});
                    });
                    return ;
                }

                swal({
                    title: "Xác nhận hành động",
                    text: (admin.banned == 'T') ?"Bỏ cấm tài khoản này?" : "Cấm tài khoản này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: (admin.banned == 'T') ? "Bỏ cấm" : "Cấm",
                    closeOnConfirm: true
                }, function(){
                    axios.post('/admin/axios/ban-account',{
                        account_type:'admin',
                        account_id:admin.id,
                        ban:(admin.banned == 'T') ? 'F' : 'T'
                    }).then(rs => {
                        tmp.$emit('changeBan',{
                            index:index,
                            admin:admin,
                            ban:(admin.banned == 'T') ? 'F' : 'T'
                        });
                        swal("Thành công", (admin.banned == 'T')? "Đã bỏ cấm tài khoản" : "Đã cấm tài khoản", "success");
                    }).catch(e =>{});
                });
            }
        },

    }
</script>
<style scoped>
    .click{
        cursor: pointer;
    }
</style>