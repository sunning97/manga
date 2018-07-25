<template>
    <div class="row send-chat-box">
        <div class="col-sm-12">
            <textarea class="form-control" v-model="content" placeholder="Nhập nội dung..." @keydown.enter="senMessage"></textarea>
            <div class="custom-send"><a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="Insert Emojis"><i class="ti-face-smile"></i></a> <a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="File Attachment"><i class="fa fa-paperclip"></i></a>
                <button class="btn btn-danger btn-rounded" type="button">Gửi</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                content:''
            }
        },
        methods:{
            senMessage:function (e) {
                e.preventDefault();
                if(this.content == '') return;
                this.$emit('newMessage',this.content);
                this.content = '';
            }
        }
    }
</script>