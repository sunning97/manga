<template>
    <div class="post__comments-respond">
        <div class="">
            <h5>Viết bình luận của bạn</h5>
            <form action="" method="post" v-if="user">
                <p class="post__comments-respond-comment">
                    <label for="comment">Comment</label>
                    <textarea id="comment" name="comment" class="form-control" cols="45" aria-required="true" v-model="comment" @focus="isCommentEmpty = false"></textarea>
                    <span class="text-danger" role="alert" v-if="isCommentEmpty">
                        <strong>Bình luận không được để trống</strong>
                    </span>
                    <span class="text-danger" role="alert" v-if="isSpam">
                        <strong>Để tránh spam vui lòng bình luận lại sau 5 giây</strong>
                    </span>
                </p>
                <p class="post__comments-respond-submit">
                    <input id="submit" type="submit" name="submit" size="30" value="Đăng" @click="postComment">
                </p>
            </form>
            <div v-else>
                <b>Vui lòng đăng nhập để viết bình luận</b>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            user:{
                type:Object,
                default:null
            }
        },
        data(){
            return {
                comment:'',
                isCommentEmpty:false,
                isPassTime:true,
                isSpam:false
            }
        },
        mounted(){

        },
        methods:{
            postComment:function () {
                var tmp = this;
                event.preventDefault();
                if(!this.isPassTime){
                    this.isSpam = true;
                    return;
                }

                if(this.comment == '')
                {
                    this.isCommentEmpty = true;
                    return ;
                }

                this.isPassTime = false;
                this.$emit('postComment',this.comment);
                setTimeout(function(){ tmp.isPassTime = true; tmp.isSpam = false }, 5000);
                this.comment = '';

            }
        }
    }
</script>