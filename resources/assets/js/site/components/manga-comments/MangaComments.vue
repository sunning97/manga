<template>
    <div class="post__comments bg-dark" style="background-color: rgba(212, 212, 212, 0.24);">
        <list-comment :comments="comments" :url="url" :totalComments="totalComments" class="border border-secondary"></list-comment>
        <pagination :pagination="pagination" :offset="offset" @click.native="getComment(pagination.current_page)"></pagination>
        <write-comment :user="user"></write-comment>
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
            },
            user:{
                type:Object,
                default:null
            }
        },
        data(){
            return {
                comments:[],
                pagination:{

                },
                offset:5,
                totalComments:0
            }
        },
        mounted(){
            this.getComment(1);
            this.getTotalComments();
        },
        methods:{
            getComment:function (page) {
                this.comments = [];
                this.pagination = {};
                axios.post(`/axios/get-comment?page=${page}`,{
                    manga_id:this.manga.id
                }).then(response=>{
                    this.comments = response.data.data;
                    this.pagination = response.data
                }).catch(error=>{
                   console.log(error.response.data.message)
                });
            },
            getTotalComments:function () {
                axios.post('/axios/get-total-comments',{
                    manga_id:this.manga.id
                }).then(response=>{
                    this.totalComments = response.data;
                })
            }
        },
        components:{
            'list-comment': ListComment,
            'pagination': Pagination,
            'write-comment': WriteComment
        }
    }
</script>