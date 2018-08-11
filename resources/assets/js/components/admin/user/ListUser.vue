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
                        <td>{{ getState(user.banned) }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></a>
                                <a href="" class="btn btn-sm btn-primary" v-if="checkPermission('update-users')">Cập nhật <i class="ti-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" v-if="checkPermission('delete-users')">Xóa <i class="ti-trash"></i></button>
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
                        <td>{{ getState(user.banned) }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></a>
                                <a href="" class="btn btn-sm btn-primary" v-if="checkPermission('update-users')">Cập nhật <i class="ti-pencil"></i></a>
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
        props:{
            users:{
                type:Array,
                default:[],
            },
            pagination:{
                type:Object,
                default: {}
            },
            permissions:{
                type:Array,
                default:[],
                required:true
            },
            searchUsers:{
                type:Array,
                default:[]
            },
            searchInput:{
                type:String,
                default:''
            },
            isSearching:{
                type:Boolean,
                defautl:false
            }
        },
        methods:{
            date_format:function (str) {
                return $.format.date(str, "dd-MM-yyyy");
            },
            getIndex:function (index) {
                return (this.pagination.current_page - 1)* this.pagination.per_page + index + 1;
            },
            checkPermission:function (permission) {
                if(this.permissions.indexOf(permission) > -1)
                    return true;

                return false;
            },
            getState:function (state) {
                return (state == 'T') ? 'Hoạt động' : 'Bị cấm'
            }
        }

    }
</script>