<template>
    <div>
        <h5>3 Bình luận</h5>
        <ul class="post__comments-list" id="commnent">
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