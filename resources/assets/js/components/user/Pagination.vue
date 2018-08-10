<template>
    <nav class="text-right">
        <ul class="pagination">
            <li v-if="pagination.current_page > 3">
                <a href="#" aria-label="Previous" v-on:click.prevent="changePage(1)">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}">
                <a href="#" v-on:click.prevent="changePage(page)">{{ page }}</a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li v-if="pagination.last_page - pagination.current_page > 3">
                <a href="#" aria-label="Previous" v-on:click.prevent="changePage(pagination.last_page)">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props:{
            pagination:{
                type:Object,
                default:{}
            },
            offset:{
                type:Number,
                default:3
            }
        },
        computed:{
            pagesNumber:function () {
                var from = this.pagination.current_page - this.offset;

                if(this.pagination.current_page <= this.offset){
                    from = 1
                }
                var to = this.pagination.current_page + this.offset;

                if(this.pagination.current_page + this.offset >  this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pages = [];
                for(var i = from ;i <=to ;i++){
                    pages.push(i)
                }

                return pages;
            }
        },
        methods:{
            changePage:function (page) {
                this.$emit('page',page)
            }
        }
    }
</script>