<template>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày đăng kí</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody v-if="this.searchInput == '' && this.searchUsers.length == 0">
                <tr v-for="(user,index) in users">
                    <td>{{ getIndex(index) }}</td>
                    <td>{{ `${user.f_name} ${user.l_name}` }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ date_format(user.created_at) }}</td>
                    <td @click="changeBan(user,index)" class="click"><div :class="`text-${(user.banned == 'F') ? 'success' : 'danger'}`"><b>{{ getState(user.banned) }}</b></div></td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a :href="`${url}/${user.id}`" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></a>
                            <a :href="`${url}/${user.id}/edit`" class="btn btn-sm btn-primary" v-if="checkPermission('update-users')">Cập nhật <i class="ti-pencil"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" v-if="checkPermission('delete-users')" @click="showDelete(user,index)">Xóa <i class="ti-trash"></i></button>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody v-if="this.searchInput != '' && this.searchUsers.length > 0">
                <tr v-for="(user,index) in searchUsers">
                    <td>{{ (index+1) }}</td>
                    <td>{{ `${user.f_name} ${user.l_name}` }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ date_format(user.created_at) }}</td>
                    <td @click="changeBan(user,index)" class="click"><div :class="`text-${(user.banned == 'F') ? 'success' : 'danger'}`"><b>{{ getState(user.banned) }}</b></div></td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a :href="`${url}/${user.id}`" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></a>
                            <a :href="`${url}/${user.id}/edit`" class="btn btn-sm btn-primary" v-if="checkPermission('update-users')">Cập nhật <i class="ti-pencil"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" v-if="checkPermission('delete-users')">Xóa <i class="ti-trash"></i></button>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody v-if="this.searchInput != '' && this.searchUsers.length == 0 && !isSearching">
                <tr class="text-center">
                    <td colspan="5">Không tìm thấy</td>
                </tr>
                </tbody>
                <tbody v-if="isSearching">
                <tr class="text-center">
                    <td colspan="5">Đang tìm kiếm...</td>
                </tr>
                </tbody>
                <tbody v-if="this.users.length == 0">
                <tr class="text-center">
                    <td colspan="5">Không có dữ liệu</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            users: {
                type: Array,
                default: [],
            },
            url:{
                type:String,
                default:''
            },
            pagination: {
                type: Object,
                default: {}
            },
            permissions: {
                type: Array,
                default: [],
                required: true
            },
            searchUsers: {
                type: Array,
                default: []
            },
            searchInput: {
                type: String,
                default: ''
            },
            isSearching: {
                type: Boolean,
                defautl: false
            }
        },
        methods: {
            date_format: function (str) {
                return $.format.date(str, "dd-MM-yyyy");
            },
            getIndex: function (index) {
                return (this.pagination.current_page - 1) * this.pagination.per_page + index + 1;
            },
            checkPermission: function (permission) {
                return (this.permissions.indexOf(permission) > -1) ? (true) : (false);
            },
            getState: function (state) {
                return (state == 'F') ? 'Hoạt động' : 'Bị cấm';
            },
            changeBan:function (user,index) {
                var tmp = this;

                if(this.searchInput != '' && this.searchUsers.length > 0)
                {
                    swal({
                        title: "Xác nhận hành động",
                        text: (user.banned == 'T') ? 'Bỏ Cấm người ngày?' : 'Cấm người này?',
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: (user.banned == 'T') ? "Bỏ cấm" : "Cấm",
                        closeOnConfirm: true
                    }, function(){
                        axios.post('/admin/axios/ban-account',{
                            account_type:'user',
                            account_id:user.id,
                            ban: (user.banned == 'T') ? 'F' : 'T'
                        }).then(rs => {
                            tmp.$emit('changeBan',{
                                search:true,
                                user:user,
                                index:index,
                                ban:(user.banned == 'T') ? 'F' : 'T'
                            });
                            swal("Thành công!", (user.banned == 'T') ? "Đã Bỏ cám người đùng" : "Đã cấm người dùng", "success");
                        }).catch(e =>{
                            swal("Thất bại!", "Có lỗi trong quá trình xử lý", "error");
                        });
                    });

                    return;
                }

                swal({
                    title: "Xác nhận hành động",
                    text: (user.banned == 'T') ? 'Bỏ Cấm người ngày?' : 'Cấm người này?',
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: (user.banned == 'T') ? "Bỏ cấm" : "Cấm",
                    closeOnConfirm: true
                }, function(){
                    axios.post('/admin/axios/ban-account',{
                        account_type:'user',
                        account_id:user.id,
                        ban: (user.banned == 'T') ? 'F' : 'T'
                    }).then(rs => {
                        tmp.$emit('changeBan',{user:user,index:index,ban:(user.banned == 'T') ? 'F' : 'T'});
                        swal("Thành công!", (user.banned == 'T') ? "Đã Bỏ cám người đùng" : "Đã cấm người dùng", "success");
                    }).catch(e =>{
                        swal("Thất bại!", "Có lỗi trong quá trình xử lý", "error");
                    });
                });

            },
            showDelete:function (user,index) {
                swal({
                    title: "Xóa người dùng này?",
                    text: "Sau khi xóa người dùng sẽ không sử dụng tài khoản này được đâu T.T",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Xóa",
                    closeOnConfirm: true
                }, function(){

                });
            }
        }

    }
</script>

<style scoped>
    .click{
        cursor: pointer;
    }
</style>