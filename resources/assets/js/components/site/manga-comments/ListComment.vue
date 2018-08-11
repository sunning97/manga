<template>
    <div>
        <h5>{{ totalComments }} Bình luận</h5>
        <ul class="post__comments-list" id="commnent">
            <div class="text-center" v-if="comments.length == 0">Đang tải...</div>
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