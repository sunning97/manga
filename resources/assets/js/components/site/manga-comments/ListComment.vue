<template>
    <div>
        <h5 v-if="comments.length > 0">{{ totalComments }} Bình luận</h5>
        <h5 v-else class="text-center"><b>Không có bình luận nào</b></h5>
        <ul class="post__comments-list" id="commnent">
            <div class="text-center" v-if="comments.length == 0 && isPage">Đang tải...</div>
            <li class="post__comments-item" v-for="comment in comments">
                <parent-comment :comment="comment" :url="url"></parent-comment>
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
            }
        },
        mounted(){
            $('#commnent').slimScroll({
                height: '500px',
            });
        },
        methods:{

        },
        components:{
            'parent-comment':ParentComment,
        }
    }
</script>