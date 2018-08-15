<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <h5 v-if="comments.length > 0"><b>{{ totalComments }} Bình luận</b></h5>
                <h5 v-else class="text-center"><b>Không có bình luận nào</b></h5>
            </div>
            <div class="col-md-4">
                <span class="click" @click="refreshComment"><b>Làm mới bình luận</b></span>
            </div>
        </div>
        <ul class="post__comments-list" id="commnent">
            <div class="text-center" v-if="comments.length == 0 && isPage">Đang tải...</div>
            <li class="post__comments-item" v-for="comment in comments">
                <parent-comment :comment="comment" :url="url" :manga="manga"></parent-comment>
            </li>
        </ul>
    </div>
</template>
<script>
    import ParentComment from './comment/ParentComment';
    export default {
        props:{
            comments:{
                type:Array,
                default:[],
            },
            url:{
                type:String,
                default:''
            },
            totalComments:{
                type:Number,
                default:0
            },
            isPage:{
                type:Boolean,
                default:false
            },
            manga:{
                type:Object,
                default:{}
            }
        },
        mounted(){
            $('#commnent').slimScroll({
                height: '500px',
            });
        },
        methods:{
            refreshComment:function () {
                this.$emit('refreshComment');
            }
        },
        components:{
            'parent-comment':ParentComment,
        }
    }
</script>
<style scoped>
    .click{
        cursor: pointer;
    }
</style>