<template>
    <nav class="col-12 text-center">
        <ul class="pagination">
            <li class="page-item" v-if="pagination.current_page > 3">
                <a class="page-link" href="" @click.prevent="changePage(1)"><<</a>
            </li>
            <li class="page-item" v-if="pagination.current_page > 2">
                <a class="page-link" href="" @click.prevent="changePage(pagination.current_page-1)"><</a>
            </li>
            <li class="page-item" v-for="n in pagesNumber" :class="pagination.current_page == n? 'active':''"><a class="page-link" href="" @click.prevent="changePage(n)">{{ n }}</a></li>
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="" @click.prevent="changePage(pagination.current_page+1)">></a>
            </li>
            <li class="page-item" v-if="pagination.last_page - pagination.current_page > 3">
                <a class="page-link" href="" @click.prevent="changePage(pagination.last_page)">>></a>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        props:{
            pagination:{
                type:Object,
                require:true
            },
            offset:{
                type:Number,
                default:5
            }
        },
        computed:{
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = this.pagination.current_page + this.offset;
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                for (var i = from; i <= to; i++) {
                    pagesArray.push(i);
                }
                return pagesArray;
            }
        },
        methods:{
            changePage: function (page) {
                this.pagination.current_page = page;
            }
        }
    }
</script>