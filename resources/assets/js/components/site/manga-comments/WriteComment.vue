<template>
    <div class="post__comments-respond">
        <div class="">
            <h5>Viết bình luận của bạn</h5>
            <form action="http://feelman.info/html/leopold/post.html" method="post" v-if="user">
                <p class="post__comments-respond-comment">
                    <label for="comment">Comment</label>
                    <textarea id="comment" name="comment" cols="45" aria-required="true"></textarea>
                </p>
                <p class="post__comments-respond-submit">
                    <input id="submit" type="submit" name="submit" size="30" value="Đăng">
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
        mounted(){

        },
        methods:{
        }
    }
</script>