<template>
    <tr>
        <td>{{ index }}</td>
        <td>{{ admin.f_name+' '+ admin.l_name }}</td>
        <td>{{ admin.email }}</td>
        <td>{{ role }}</td>
        <td class="text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-success">Xem <i class="ti-eye"></i></button>
                <button type="button" class="btn btn-sm btn-primary">Sửa <i class="ti-pencil"></i></button>
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
            }
        }
    }
</script>