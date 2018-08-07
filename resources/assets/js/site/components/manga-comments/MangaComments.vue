<template>
    <div class="post__comments">
        <list-comment></list-comment>
        <pagination></pagination>
        <write-comment></write-comment>
    </div>
</template>
<script>
    import ListComment from './ListComment';
    import Pagination from  './Pagination';
    import WriteComment from  './WriteComment'
    export default {
        components:{
            'list-comment': ListComment,
            'pagination': Pagination,
            'write-comment': WriteComment
        }
    }
</script>