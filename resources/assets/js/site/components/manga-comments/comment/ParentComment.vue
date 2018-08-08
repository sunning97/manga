<template>
    <div>
        <div class="row mb-5">
            <div class="col-md-2">
                <img class="img-responsive" :src="`${url}/${comment.avatar}`" :alt="`${comment.f_name} ${comment.l_name}`">
            </div>
            <div class="col-md-10 bg-info rounded">
                <div class="post__comments-item-reply">
                    <a href="#">Reply</a>
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
              comments:[]
          }
        },
        mounted(){
            this.getChildComments();
        },
        methods:{
            getChildComments:function () {
                axios.post('/axios/get-child-comment',{
                    parent_comment:this.comment.comment_id
                }).then(response=>{
                    this.comments = response.data;
                }).catch(error=>{

                });
            },
            date_format:function (str) {
                return $.format.date(str, "dd-MM-yyyy");
            }
        },
        components:{
            'child-comment':ChildComment
        }
    }
</script>