<template>
    <div class="post__comments">
        <list-comment :comments="comments" :url="url" class="border border-secondary"></list-comment>
        <pagination></pagination>
        <write-comment></write-comment>
    </div>
</template>
<script>
    import ListComment from './ListComment';
    import Pagination from  './Pagination';
    import WriteComment from  './WriteComment'
    export default {
        props:{
            manga:{
                type:Object,
                default:null,
                required:true
            },
            url:{
                type:String,
                default:''
            }
        },
        data(){
            return {
                comments:[],
                pagination:{

                },
                offset:5
            }
        },
        mounted(){
            this.getComment();
        },
        methods:{
            getComment:function () {
                axios.post('/axios/get-comment',{
                    manga_id:this.manga.id
                }).then(response=>{
                    this.comments = response.data.data;
                    this.pagination = response.data
                }).catch(error=>{
                   console.log(error.response.data.message)
                });
            }
        },
        components:{
            'list-comment': ListComment,
            'pagination': Pagination,
            'write-comment': WriteComment
        }
    }
</script>