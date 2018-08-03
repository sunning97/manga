<template>
    <tr>
        <td>{{ index }}</td>
        <td>{{ admin.f_name+' '+ admin.l_name }}</td>
        <td>{{ admin.email }}</td>
        <td>{{ role }}</td>
        <td class="text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a :href="url+'/'+admin.id" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></a>
                <a :href="url+'/'+admin.id+'/edit'" class="btn btn-sm btn-primary">Cập nhât quyền <i class="ti-pencil"></i></a>
                <button type="button" class="btn btn-sm btn-danger">Xóa <i class="ti-trash"></i></button>
            </div>
        </td>
    </tr>
</template>
<script>
    export default {
        props:{
            admin:{
                type:Object,
            },
            index:{
                type:Number
            },
            role:{
                type:String
            },
            url:{
                type:String
            }
        }
    }
</script>