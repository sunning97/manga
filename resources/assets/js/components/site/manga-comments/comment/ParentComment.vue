<template>
    <div>
        <div class="row mb-5">
            <div class="col-md-2">
                <img class="img-responsive" :src="`${url}/${comment.avatar}`" :alt="`${comment.f_name} ${comment.l_name}`">
            </div>
            <div class="col-md-10 bg-info rounded">
                <div class="post__comments-item-reply">
                    <span class="btn btn-default" @click="reply">Reply</span>
                </div>
                <div class="post__comments-item-info">
                    <div class="post__comments-item-info-author">
                        <span><a href="#">{{ `${comment.f_name} ${comment.l_name}` }}</a></span>
                    </div>
                    <div class="post__comments-item-info-date">
                        <span><a href="#">{{ date_format(comment.created_at) }}</a></span>
                    </div>
                </div>
                <div class="post__comments-item-post">
                    <p>{{ comment.content }}</p>
                </div>
            </div>
            <div class="row" v-if="isReply">
                <div class="col-md-11 col-md-push-1">
                    <div class="post__comments-respond">
                        <form action="" method="post">
                            <p class="post__comments-respond-comment">
                                <textarea id="comment" name="comment" cols="30" aria-required="true" v-model="content" @focus="isEmpty = false"></textarea>
                                <span class="text-danger" v-if="isEmpty">
                                    <strong>Bình luận không được để trống</strong>
                                </span>
                                <span class="text-danger" v-if="isSpam">
                                    <strong>Để tránh spam vui lòng bình luận lại sau 5 giây</strong>
                                </span>
                            </p>
                            <p class="post__comments-respond-submit">
                                <input id="submit" type="submit" name="submit" size="30" value="Đăng" @click="postComment">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <child-comment v-if="comments.length > 0" :comments="comments" :url="url"></child-comment>
        <hr>
    </div>
</template>
<script>
    import ChildComment from './ChildComment';
    export default {
        props:{
            comment:{
                type:Object,
                default:{}
            },
            url:{
                type:String,
                default:''
            }
        },
        data(){
          return{
              comments:[],
              isReply:false,
              content:'',
              isEmpty:false,
              isPassTime:true,
              isSpam:false
          }
        },
        mounted(){
            this.childComments();
        },
        methods:{
            childComments:function () {
                axios.post('/axios/get-child-comment',{
                    parent_comment:this.comment.comment_id
                }).then(response=>{
                    this.comments = response.data;
                }).catch(error=>{
                    this.comments = [];
                });
            },
            date_format:function (str) {
                return $.format.date(str, "dd-MM-yyyy");
            },
            reply:function () {
                this.isReply = !this.isReply;
            },
            postComment:function () {
                var tmp = this;
                event.preventDefault();

                if(!tmp.isPassTime)
                {
                    tmp.isSpam = true;
                    return;
                }

                if(tmp.content == '') {
                    tmp.isEmpty = true;
                    return false;
                }

                tmp.isPassTime = false;
                setTimeout(function(){ tmp.isPassTime = true; tmp.isSpam = false }, 5000);
                tmp.content = '';
            }
        },
        components:{
            'child-comment':ChildComment
        }
    }
</script>